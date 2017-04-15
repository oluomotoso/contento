<?php

namespace App\Http\Controllers\user;

use App\Api_data;
use App\feed;
use App\Jobs\BloggerAction;
use App\Jobs\UpdateBlogListForUser;
use App\Picasaphoto;
use App\Published_feed;
use App\Subscription_domain;
use App\User_domain;
use Doctrine\Common\Cache\ArrayCache;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Doctrine\Common\Cache\FilesystemCache;
use EasyRequest;
use RemoteImageUploader\Factory;
use RemoteImageUploader\Helper;

class BloggerController extends Controller
{
    protected $client;
    protected $cacher = null;

    public function __construct()
    {
        $this->middleware('auth');
        session_start();
        $client_id = '465529800621-4vstv6illt2r65c30f0qa71fn53m73ha.apps.googleusercontent.com';
        $client_secret = 'Rrp2BuDcuZCEIhu8n_ehiHtF';
        $redirect_uri = 'http://www.contento.com.ng/user/link-to-google';
        $this->client = new \Google_Client();
        $this->client->setClientId($client_id);
        $this->client->setClientSecret($client_secret);
        $this->client->setRedirectUri($redirect_uri);
        $this->client->setIncludeGrantedScopes(true);
        $this->client->addScope('profile');
        $this->client->addScope('email');
        $this->client->addScope('openid');
        $this->client->setAccessType('offline');
        $this->client->addScope(\Google_Service_Blogger::BLOGGER);
        $this->client->addScope('https://picasaweb.google.com/data');
        //$this->client->addScope(Google_Photo)

    }


    public function RedirectToGoogle()
    {
        if (isset($_GET['oauth'])) {
            // Start auth flow by redirecting to Google's auth server
            $auth_url = $this->client->createAuthUrl();
            //echo($auth_url);
            return redirect(filter_var($auth_url, FILTER_SANITIZE_URL));
        } else if (isset($_GET['code'])) {
            // Receive auth code from Google, exchange it for an access token, and
            // redirect to your base URL
            $this->client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $this->client->getAccessToken();
            $redirect_uri = '/user/link-to-google';
            return redirect(filter_var($redirect_uri, FILTER_SANITIZE_URL));
        } else if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            // You have an access token; use it to call the People API
            $this->client->setAccessToken($_SESSION['access_token']);
            if ($this->client->isAccessTokenExpired()) {
                $redirect_uri = '/user/link-to-google/?oauth';
                //echo($redirect_uri);
                return redirect($redirect_uri);
            }
            $people_service = new \Google_Service_People($this->client);
            $me = $people_service->people->get('people/me');
            $authorized_email = $me->getEmailAddresses();
            $user = Auth::user();
            $refreshToken = $this->client->getRefreshToken();
            if ($refreshToken == null) {
                $apiData = Api_data::updateOrCreate(['user_id' => $user->id, 'email' => $authorized_email[0]->value], [
                    'token' => json_encode($this->client->getAccessToken()),
                    'account_id' => $me['id']
                ]);
            } else {
                $apiData = Api_data::updateOrCreate(['user_id' => $user->id, 'email' => $authorized_email[0]->value], [
                    'token' => json_encode($this->client->getAccessToken()),
                    'refresh_token' => json_encode($this->client->getRefreshToken()),
                    'account_id' => $me['id']
                ]);
            }
            //$job = (new UpdateBlogListForUser($user));
            //dispatch($job);
            $this->GetAllBlogsInAccount($apiData, $user, $authorized_email[0]->value);
            //$dataauth = $this->getAuthSubUrl();
            //return redirect()->away($dataauth);
            return redirect('user/manage-subscriptions')->with('message', 'Your Blogs have been successfully updated');
            // TODO: Use service object to request People data
        } else {
            $redirect_uri = 'user/google/import-contacts/?oauth';
            //echo($redirect_uri);
            return redirect($redirect_uri);
        }
    }

    public function GetAllBlogsInAccount($item, $user, $email)
    {
        $this->client->setAccessToken($item->token);
        if ($this->client->isAccessTokenExpired()) {
            $this->client->refreshToken($item->refresh_token);
            $newtoken = $this->client->getAccessToken();
            Api_data::updateOrCreate(['user_id' => $user->id, 'email' => $email], [
                'token' => json_encode($newtoken)
            ]);
            $this->client->setAccessToken($newtoken);
        }
        $service = new \Google_Service_Blogger($this->client);
        $blogs = $service->blogs->listByUser('self');
        $items = $blogs->getItems();
        foreach ($items as $me) {
            User_domain::updateOrCreate(['url' => $me->getURL(), 'user_id' => $user->id], ['domain_id' => $me->getId(), 'platform_id' => 2, 'api_data_id' => $item->id]);
        }


    }


    public function PostSubscriptionDomain(Request $request)
    {
        $feed = $request->feed;
        $domain = $request->domain;
        Published_feed::firstOrCreate(['feed_id' => $feed, 'domain_id' => $domain, 'subscription_id' => $request->subscription]);
        $this->dispatch(new BloggerAction($feed, $domain, $request->publish));
        return redirect('user/manage-domain/' . $request->subscription . '/d/' . $request->domain . '')->with('message', 'published_successfully');

    }


}
