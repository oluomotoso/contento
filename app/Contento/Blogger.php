<?php
/**
 * Created by PhpStorm.
 * User: OluOmotoso
 * Date: 09-Apr-17
 * Time: 2:36 PM
 */

namespace App\Contento;


use App\feed;
use App\Jobs\BloggerAction;
use App\Picasaphoto;
use App\Publishing_parameter;
use App\Subscription_domain;
use App\User_domain;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Blogger
{
    use DispatchesJobs;
    protected $client;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
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


    }

    public function GetMultipleImageUrl($content)
    {
        preg_match_all('/src="(.*?)"/', $content, $matches);
        return ($matches[1]);

    }

    function uploadPhoto($httpClient, $id, $image_path, $title = "")
    {
        $body = fopen($image_path, 'r');
        $data = [
            'body' => $body
        ];
        if ($title != "") {
            $data['headers'] = ['Slug' => $title];
        }
        $response = $httpClient->post("https://picasaweb.google.com/data/feed/api/user/default/albumid/" . $id, $data);
        $xml_response = simplexml_load_string($response->getBody());
        return $xml_response;

    }

    public function PublishPostTOBlogger($feed_id, $domain, $publish)
    {
        $sub_domain = Subscription_domain::find($domain);
        $data = $sub_domain->user_domain->api_data;
        $this->client->setAccessToken($data->token);
        $feed = feed::find($feed_id);
        //$this->UploadImageToPicasa($data->refresh_token);
        $httpClient = $this->client->authorize();
        $content = $feed->content;
        $photos = $this->GetMultipleImageUrl($content);
        foreach ($photos as $photo) {
            $mime = \GuzzleHttp\Psr7\mimetype_from_filename($photo);
            $supported = 'image/bmp image/gif image/jpeg image/png';
            if (str_contains($supported, $mime) !== false) {
                if (strpos($photo, 'blogspot') !== false) {
                    $new_photo = $photo;
                } else {
                    $db_photo = Picasaphoto::where('original_url', $photo)->where('api_data_id', $data->id)->first();
                    if (count($db_photo) > 0) {
                    } else {
                        $response = $this->uploadPhoto($httpClient, 'default', $photo, $photo);

                        $db_photo = Picasaphoto::updateOrCreate([
                            'original_url' => $photo,
                            'api_data_id' => $data->id], [
                            'picasa_id' => $response->id,
                            'picasa_link' => $response->content['src']

                        ]);
                    }
                    $new_photo = $db_photo->picasa_link;
                }

                $content = str_replace($photo, $new_photo, $content);

            }
        }
        $post = new \Google_Service_Blogger_Post();
        $post->setTitle($feed->title);
        $post->setContent($content);

        $service = new \Google_Service_Blogger($this->client);
        if ($publish == 1) {
            $service->posts->insert($sub_domain->user_domain->domain_id, $post);
        } elseif ($publish == 2) {
            $service->posts->insert($sub_domain->user_domain->domain_id, $post, ['isDraft' => true]);

        }
    }


    public function GetAllBlogsInAccount($user)
    {
        foreach ($user->api_data as $item) {

            $this->client->setAccessToken($item->token);
            if ($this->client->isAccessTokenExpired()) {
                $newtoken = $this->client->fetchAccessTokenWithRefreshToken($item->refresh_token);
                $this->client->setAccessToken($newtoken);
            }
            $service = new \Google_Service_Blogger($this->client);
            $blogs = $service->blogs->listByUser('self');
            $items = $blogs->getItems();
            foreach ($items as $me) {
                User_domain::updateOrCreate(['url' => $me->getURL(), 'user_id' => $user->id], ['domain_id' => $me->getId(), 'platform_id' => 2, 'api_data_id' => $item->id]);
            }


        }
    }

    public function AutoPublish() //Handles blogger autopublishing by iteration and pushing to queue
    {
        $parameters = Publishing_parameter::where('parameters', '!=', null)->orWhere('publish_all', '!=', false)->orderBy('updated_at', 'asc')->limit(10)->get();
        foreach ($parameters as $parameter) {
            $contentoRequest = new \App\Contento\Request();
            $feeds = $contentoRequest->SubscriptionFeedsWithinHour($parameter->subscription_domain->subscription_id, $parameter->subscription_domain->subscription, $parameter->subscription_domain_id, 100, $parameter->identifier_id);
            foreach ($feeds as $feed) {
                if ($parameter->publish_all == true) {
                    if ($parameter->is_draft == true) {
                        $this->dispatch(new BloggerAction($feed->id, $parameter->subscription_domain_id, 2));
                    } else {
                        $this->dispatch(new BloggerAction($feed->id, $parameter->subscription_domain_id, 1));
                    }
                } else {
                    $params = explode(',', $parameter->parameters);
                    $params = array_unique($params);
                    $params = array_filter($params);
                    $params = array_values($params);
                    $params = array_map('trim', $params);
                    foreach ($params as $param) {
                        if ($param !== null) {
                            if (stripos($feeds->title, $param) !== false) {
                                if ($parameter->is_draft == true) {
                                    $this->dispatch(new BloggerAction($feed->id, $parameter->subscription_domain_id, 2));
                                } else {
                                    $this->dispatch(new BloggerAction($feed->id, $parameter->subscription_domain_id, 1));
                                }
                            }
                        }
                    }

                }
            }
            Publishing_parameter::where('id', $parameter->id)->touch();
        }
        return 'done';
    }
}