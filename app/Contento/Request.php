<?php
/**
 * Created by PhpStorm.
 * User: OluOmotoso
 * Date: 25-Apr-17
 * Time: 2:10 PM
 */

namespace App\Contento;


use App\feed;
use App\feed_category;
use App\Published_feed;
use App\Subscription_category;
use App\Subscription_feed;

class Request
{
    public function SubscriptionFeeds($sub, $subscription, $url,$limit)
    {
        $published = Published_feed::where('subscription_id', $sub)->where('domain_id', $url)->select('feed_id')->get();
        $published_feed_array = [];
        foreach ($published as $value) {
            $published_feed_array[] = $value->feed_id;
        }
        if ($subscription->is_category == false) {
            $subscription_feed = Subscription_feed::where('subscription_id', $subscription->id)->select('feed_id')->get();
            $subscription_feed_array = [];
            foreach ($subscription_feed as $item) {
                $subscription_feed_array[] = $item->feed_id;
            }

            $feeds = feed::with('datasources_feed.Datasource')->select('id', 'description', 'title', 'link', 'updated_at', 'datasource_feed_id')->whereIn('datasource_feed_id', $subscription_feed_array)->whereNotIn('id', $published_feed_array)->orderBy('updated_at', 'desc')->limit($limit)->get();
        } else {
            $subscription_feed = Subscription_category::where('subscription_id', $subscription->id)->select('category_id')->get();
            $subscription_feed_array = [];
            foreach ($subscription_feed as $item) {
                $subscription_feed_array[] = $item->feed_id;
            }
            $feed_category = feed_category::whereIn('category_id', $subscription_feed_array)->whereNotIn($published_feed_array)->orderBy('id', 'desc')->groupBy('feed_id')->limit($limit)->get();
            $feedscat = [];
            foreach ($feed_category as $item) {
                $feedscat[] = $item->feed_id;
            }
            $feeds = feed::with('datasources_feed.Datasource')->select('id', 'description', 'title', 'link', 'updated_at', 'datasource_feed_id')->whereIn('id', $feedscat)->orderBy('updated_at', 'desc')->limit($limit)->get();

        }
        return $feeds;
    }
}