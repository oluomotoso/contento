<?php
namespace App\Contento;

use App\category;
use App\datasource_feed;
use App\feed;
use App\feed_category;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PicoFeed\Config\Config;
use PicoFeed\PicoFeedException;
use PicoFeed\Reader\Reader;
use Yabacon\Paystack;

/**
 * Created by PhpStorm.
 * User: OluOmotoso
 * Date: 05-Apr-17
 * Time: 12:43 PM
 */
class contento
{

    public function Aggregate()
    {

    }

    public function FindFeedsFromWebsites($website, $datasource_id)
    {
        try {
            $reader = new Reader();
            $resource = $reader->download($website);
            $feeds = $reader->find(
                $resource->getUrl(),
                $resource->getContent()
            );
            foreach ($feeds as $feed) {
                $resource = $reader->download($feed);

                // Return the right parser instance according to the feed format
                $parser = $reader->getParser(
                    $resource->getUrl(),
                    $resource->getContent(),
                    $resource->getEncoding()
                );
                $feed2 = $parser->execute();

                // Print the feed properties with the magic method __toString()
                $feed_title = $feed2->getTitle();
                $feed_description = $feed2->getDescription();
                datasource_feed::updateOrCreate(['datasource_id' => $datasource_id,
                    'url' => $feed], ['name' => $feed_title, 'description' => $feed_description]);


            }
        } catch (PicoFeedException $e) {

            return $e->getMessage();
            // Do something...

        }
    }

    public function FetchFeedPosts()
    {
        ini_set('max_execution_time', 1300);


        $reader = new Reader();
        $sources = datasource_feed::where('status', true)->orderBy('updated_at', 'asc')->get();
        foreach ($sources as $source) {

            try {

                $resource = $reader->download($source->url, $source->last_modified, $source->etag);
                if ($resource->isModified()) {
                    // Return the right parser instance according to the feed format
                    $parser = $reader->getParser(
                        $resource->getUrl(),
                        $resource->getContent(),
                        $resource->getEncoding()
                    );

                    if ($source->do_grab == true) {
                        $config = new Config();
                        $config->setGrabberRulesFolder('pico/rules');
                        $parser->enableContentGrabber();
                        $parser->setConfig($config);

                    }
                    // Return a Feed object
                    $feed = $parser->execute();
                    $etag = $resource->getEtag();
                    $last_modified = $resource->getLastModified();
                    $feed_items = $feed->getItems();
                    foreach ($feed_items as $items) {
                        $title = $items->getTitle();
                        $contents = $items->getContent();
                        $url = $items->getUrl();
                        $published_date = $items->getPublishedDate()->format('Y-m-d H:i:s');
                        $category = $items->getTag('category');
                        if (feed::where('link', $url)->count() > 0) {
                            $item = feed::where('link', $url)->get();
                            if ($item[0]->published_date < $published_date) {
                                $this->UpdateFeed($title, $url, $published_date, $category, $contents);

                            }
                        } else {
                            $this->CreateFeed($title, $url, $published_date, $source->id, $category, $contents);
                        }
                    }
                    datasource_feed::where('id', $source->id)->update([
                        'last_modified' => $last_modified,
                        'etag' => $etag
                    ]);
                }
            } catch (\Exception $e) {

                echo $e->getMessage();
            }
        }
        return 'Feeds have been aggregated successfully';

    }

    public
    function FetchErroredFeeds()
    {
        $sources = datasources_feed::where('id', 5)->orderBy('updated_at', 'desc')->get();
        $aggregate = new CustomAggregator();
        try {
            foreach ($sources as $source) {
                $items = $aggregate->getItems($source->url);
                foreach ($items as $feed) {
                    $title = $feed->title;
                    $url = $feed->guid;
                    if (isset($feed->category)) {
                        $category = $feed->category;
                        if (count($category) == 0) {
                            $category = $feed->getTag('category', 'term');
                        }
                    } else {
                        $category = $feed->getTag('category', 'term');
                    }

                    $published_date = $feed->pubDate->format('Y-m-d H:i:s');
                    $description = $feed->description;

                    $content = $aggregate->getContent($feed);
                    if (feed::where('link', $url)->count() > 0) {
                    } else {
                        $this->CreateFeed($title, $description, $url, $published_date, $source->id, $category, $content);
                    }

                }
                datasources_feed::where('id', $source->id)->touch();
            }
            return 'Feeds have been aggregated successfully';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public
    function CreateFeed($title, $link, $publish, $datasource, $categories, $content)
    {

        $feed = feed::create([
            'title' => $title,
            'link' => $link, 'published_date' => $publish,
            'datasource_feed_id' => $datasource,
            'content' => $content
        ]);

        foreach ($categories as $category) {
            $category2 = explode(',', $category);
            $category2 = array_unique($category2);
            $category2 = array_filter($category2);
            $category2 = array_values($category2);


            foreach ($category2 as $cate) {
                $cat = category::firstOrCreate([
                    'category' => $cate
                ]);


                feed_category::firstOrCreate([
                    'feed_id' => $feed->id,
                    'category_id' => $cat->id]);
            }
        }


    }

    public
    function UpdateFeed($title, $link, $publish, $categories, $content)
    {
        $feed = feed::where('link', $link)->update([
            'title' => $title,
            'published_date' => $publish,
            'content' => $content
        ]);

        foreach ($categories as $category) {
            $category2 = explode(',', $category);
            $category2 = array_unique($category2);
            $category2 = array_filter($category2);
            $category2 = array_values($category2);


            foreach ($category2 as $cate) {
                $cat = category::updateOrCreate([
                    'category' => $cate
                ]);


                feed_category::firstOrCreate([
                    'feeds_id' => $feed->id,
                    'categories_id' => $cat->id]);
            }
        }


    }

    public function RedirectPaystack(Request $request)
    {
        $user = Auth::user();
        $transaction = Transaction::find($request->transaction_id);
        $paystack = new Paystack('sk_test_bfd640ea5e3ad1610c783b3f47b4a7079373c881');
        $amount = $transaction->amount * 100;
        try {
            $tranx = $paystack->transaction->initialize([
                'amount' => $amount,       // in kobo
                'email' => $user->email,         // unique to customers
                'reference' => $transaction->id, // unique to transactions
            ]);
        } catch (\Yabacon\Paystack\Exception\ApiException $e) {
            print_r($e->getResponseObject());
            die($e->getMessage());
        }

// store transaction reference so we can query in case user never comes back
// perhaps due to network issue
        // redirect to page so User can pay
        return $tranx->data->authorization_url;
    }


}