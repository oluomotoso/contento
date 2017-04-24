<?php

namespace App\Http\Controllers\Api;

use App\feed;
use App\Published_feed;
use App\Subscription;
use App\Subscription_domain;
use App\Subscription_feed;
use App\User_domain;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{
    public function UserSubscriptions(Request $request)
    {
        try {
            $user = $request->user();
            $subscription = Subscription::where('user_id', $user->id)->where('status', 1)->get();
            if (count($subscription) < 1) {
                return response('You do not have any subscription on contento', 405);
            }
            return $subscription;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function UserUpdateSubscription(Request $request)
    {
        //$url = $request->;
        $subscription = Subscription::find($request->subscription);
        if (count($subscription->domain) >= $subscription->number_of_domains) {
            return response('Maximum allowed domains reached', 405);
        }
        //$referrer = $_SERVER['HTTP_REFERER'];
        $user = $request->user();
        if (isset($_POST['subscription'])) {
            $subscription = $_POST['subscription'];
            $url = $_POST['url'];
            $domain = User_domain::updateOrCreate(['url' => $url, 'user_id' => $user->id, 'platform_id' => 2]);
            $sub_id = Subscription_domain::updateOrCreate(['subscription_id' => $subscription, 'user_domain_id' => $domain->id], ['platform_id' => 2]);
            return $sub_id->id;
        }
        return response('Invalid request', 407);
    }


    public function GetSubsriptionFeeds(Request $request)
    {
        //$url = $request->;
        //$referrer = $_SERVER['HTTP_REFERER'];
        $user = $request->user();
        if (isset($_POST['subscription'])) {
            $feeds = Subscription_feed::with('feed.Datasource')->where('subscription_id', $_POST['subscription'])->select('id', 'feed_id')->get();
            return $feeds;
        }
        return response('Invalid request', 407);
    }

    public function UserSubscriptionFeeds(Request $request)
    {
        //$url = $request->;
        $user = $request->user();
        if (Auth::user() == $user) {

            if (isset($_POST['subscription']) && isset($_POST['hook'])) {
                $sub = $_POST['subscription'];
                $url = $_POST['hook'];
                //$domain = User_domain::where('url', $url)->where('user_id', $user->id)->first();
                $domain = Subscription_domain::where('subscription_id', $sub)->where('user_domain_id', $url)->first();
                if (count($domain) == 0) {
                    return response('This URL is not valid for the subscription', 406);
                }

                $subscription = Subscription::find($sub);
                if ($subscription->user_id !== $user->id) {
                    return response('You are not authorized to view this information', 401);
                }
                if (date("Y m d H:i:s") > $subscription->ends_at) {
                    return response('Your subsciption have expired, please renew', 402);
                }

                $subscription_feed = Subscription_feed::select('feed_id')->get();
                $subscription_feed_array = [];
                foreach ($subscription_feed as $item) {
                    $subscription_feed_array[] = $item->feed_id;
                }
                $published = Published_feed::where('subscription_id', $sub)->where('domain_id', $url)->select('feed_id')->get();
                $published_feed_array = [];
                foreach ($published as $value) {
                    $published_feed_array[] = $value->feed_id;
                }
                $feeds = feed::with('datasources_feed.Datasource')->select('id', 'description', 'title', 'link', 'updated_at', 'datasource_feed_id')->whereIn('datasource_feed_id', $subscription_feed_array)->whereNotIn('id', $published_feed_array)->orderBy('updated_at', 'desc')->limit(200)->get();

                return $feeds;
            }
            return response('Invalid request', 403);
        }
    }

    public function GetFeedsbySource(Request $request)
    {
        //$url = $request->;
        $user = $request->user();
        if (Auth::user() == $user) {

            if (isset($_POST['subscription']) && isset($_POST['hook'])) {
                $sub = $_POST['subscription'];
                $source = $_POST['source'];
                $url = $_POST['hook'];
                //$domain = User_domain::where('url', $url)->where('user_id', $user->id)->first();
                $domain = Subscription_domain::where('subscription_id', $sub)->where('user_domain_id', $url)->first();
                if (count($domain) == 0) {
                    return response('This URL is not valid for the subscription', 406);
                }

                $subscription = Subscription::find($sub);
                if (date("Y m d H:i:s") > $subscription->ends_at) {
                    return response('Your subsciption have expired, please renew', 402);
                }

                $published = Published_feed::where('subscription_id', $sub)->where('domain_id', $url)->select('feed_id')->get();
                $published_feed_array = [];
                foreach ($published as $value) {
                    $published_feed_array[] = $value->feed_id;
                }
                $today = new \DateTime();
                $feeds = feed::with('datasources_feed.Datasource')->select('id', 'description', 'title', 'link', 'updated_at', 'datasource_feed_id', 'content')->where('created_at', '>', $today->modify('-1 days'))->whereIn('datasource_feed_id', $source)->whereNotIn('id', $published_feed_array)->orderBy('updated_at', 'desc')->limit(10)->get();
                return $feeds;
            }
            return response('Invalid request', 403);
        }
    }

    public function GetContent($id)
    {
        $feed = feed::select('id', 'title', 'content')->find($id);
        if (count($feed) > 0) {
            return $feed;
        }
        return response('Invalid Request', 403);
    }

    public function InformPublish(Request $request)
    {
        if (Auth::user() == $request->user()) {
            if (isset($_POST['feed']) && isset($_POST['hook'])) {
                if ($_POST['hook'] == 0) {
                    return response('Unsupported Domain', 402);
                }
                $feed = $_POST['feed'];
                $domain = $_POST['hook'];
                $subscription = $_POST['subscription'];
                Published_feed::firstOrCreate(['feed_id' => $feed, 'domain_id' => $domain, 'subscription_id' => $subscription]);
                return 'OK';
            }
            return response('Invalid Request', 403);
        } else {
            return response('Unauthorized request', 402);
        }

    }
}