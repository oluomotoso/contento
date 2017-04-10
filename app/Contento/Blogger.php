<?php
/**
 * Created by PhpStorm.
 * User: OluOmotoso
 * Date: 09-Apr-17
 * Time: 2:36 PM
 */

namespace App\Contento;


use App\User_domain;
use Illuminate\Support\Facades\Auth;

class Blogger
{

    protected $client;

    public function __construct()
    {
        session_start();
        $client_id = '465529800621-4vstv6illt2r65c30f0qa71fn53m73ha.apps.googleusercontent.com';
        $client_secret = 'Rrp2BuDcuZCEIhu8n_ehiHtF';
        $redirect_uri = 'http://localhost/contento/public/user/link-to-google';
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
}