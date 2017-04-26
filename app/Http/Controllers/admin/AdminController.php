<?php

namespace App\Http\Controllers\admin;

use App\category;
use App\currency;
use App\datasource;
use App\datasource_feed;
use App\Jobs\FindFeeds;
use App\Notifications\ApprovedSubscriptionNotification;
use App\Plan;
use App\Subscription;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PicoFeed\Reader\Reader;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('member.admin.default');
    }

    public function AddDatasourceView()
    {
        $sources = datasource::all();
        $feeds = datasource_feed::all();
        $today = new \DateTime();
        $activated_feeds = datasource_feed::where('status', true)->get();
        $categories = category::withCount(['feed_category' => function ($query) use ($today) {
            $query->where('updated_at', '>', $today->modify('-7 days'));
        }])->orderBy('feed_category_count', 'desc')->limit(200)->get();
        return view('member.admin.managesources', ['sources' => $sources, 'feeds' => $feeds, 'categories' => $categories, 'activated_feeds' => $activated_feeds]);
    }

    public function AddDatasource(Request $request)
    {
        $user = Auth::user();
        if (isset($_POST['add'])) {
            try {
                $setting = datasource::where('url', $request->url)->count();
                if ($setting > 0) {
                    $source = datasource::where('url', $request->url)->get();
                    $this->dispatch(new FindFeeds($request->url, $source[0]->id));
                } else {
                    $source = datasource::create([
                        'url' => $request->url,
                        'user_id' => $user->id
                    ]);
                    $this->dispatch(new FindFeeds($request->url, $source->id));

                }
                return redirect($request->path())->with('message', 'datasource saved successfully');
            } catch (\Exception $e) {
                return redirect($request->path())->withErrors($e->getMessage())->withInput();
            }
        } elseif (isset($_POST['manage_feeds'])) {
            $datas = datasource_feed::where('datasource_id', $request->datasource_id)->get();
            return view('member.admin.managefeeds', ['datas' => $datas]);
        } elseif (isset($_POST['toggle_feed_status'])) {
            if ($request->feed_status == 0) {
                datasource_feed::where('id', $request->feed_id)->update([
                    'status' => true
                ]);
            } elseif ($request->feed_status == 1) {
                datasource_feed::where('id', $request->feed_id)->update([
                    'status' => false,
                    'do_grab' => false
                ]);
            }
        } elseif (isset($_POST['activate_grab'])) {
            datasource_feed::where('id', $request->feed_id)->update([
                'do_grab' => true
            ]);
        }
        //$datas = datasource_feed::where('datasource_id', $request->datasource_id)->get();
        return redirect('admin/manage-feeds');

    }

    public function UpdateCost(Request $request)
    {
        $user = Auth::user();
        $datas = $request->data;
        $cost = $request->cost;
        if ($request->type == 'source') {

            foreach ($datas as $data) {
                datasource_feed::where('id', $data)
                    ->update(['cost' => $cost]);
            }
        } elseif ($request->type == 'category') {
            foreach ($datas as $data) {
                category::where('id', $data)
                    ->update(['cost' => $cost]);
            }
        } else {

        }
        return redirect('admin/manage-sources')->with('message', 'Costs updated successfully');
        //$datas = datasource_feed::where('datasource_id', $request->datasource_id)->get();

    }

    public function ManageFeedsView()
    {
        $datas = datasource_feed::orderBy('name', 'asc')->get();
        return view('member.admin.managefeeds', ['datas' => $datas]);
    }

    public function ManageFeeds(Request $request)
    {

        try {
            $reader = new Reader();
            $resource = $reader->download($request->url);

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
            datasource_feed::firstOrCreate([
                'name' => $feed_title,
                'description' => $feed_description,
                'datasource_id' => $request->datasource_id,
                'url' => $request->url
            ]);
            return redirect($request->path())->with('message', 'feeds saved successfully');

        } catch (\Exception $e) {
            return redirect($request->path())->withErrors($e->getMessage())->withInput();

        }
    }

    public function GetSiteSettings()
    {
        $currencies = currency::all();
        $plans = Plan::all();
        return view('member.admin.site_settings', ['currencies' => $currencies, 'plans' => $plans]);
    }

    public function PostSiteSettings(Request $request)
    {
        if (isset($_POST['currency'])) {
            if (isset($request->remove) == true) {
                currency::where('country', $request->country)->delete();
            } else {
                currency::updateOrCreate(['country' => $request->country], ['rate_to_usd' => $request->value]);
            }
        } elseif (isset($_POST['plans'])) {
            if (isset($request->remove) == true) {
                Plan::where('name', $request->name)->delete();
            } else {
                Plan::updateOrCreate(['name' => $request->name], ['days' => $request->days, 'discount' => $request->discount, 'month' => $request->month]);
            }
        }

        return redirect($request->path())->with('message', 'settings updated successfully');
    }

    public function PendingSubscriptions()
    {
        $subscriptions = Subscription::where('status', false)->get();
        return view('member.admin.pendingsubscriptions', ['subscriptions' => $subscriptions]);
    }

    public function PostPendingSubscriptions(Request $request)
    {
        $subscription = Subscription::with(['transaction' => function ($query) {
            $query->where('status', false);
        }])->find($request->subscription);
        $plan = $subscription->plan;
        $approved = date('Y-m-d H:i:s');
        $time = strtotime($approved);
        $expiry = $time + ($plan->days * 24 * 60 * 60);
        $expiry_date = date('Y-m-d H:i:s', $expiry);
        DB::beginTransaction();
        $user = $subscription->user;
        $key = uniqid('', true);
        Subscription::where('id', $request->subscription)->update([
            'status' => true,
            'ends_at' => $expiry_date,
            'subscription_key' => $key
        ]);
        Transaction::where('id', $subscription->transaction->id)->where('subscription_id', $request->subscription)->update([
            'status' => true
        ]);
        DB::commit();
        $user->notify(new ApprovedSubscriptionNotification($subscription->name));

        return redirect($request->path())->with('message', 'Subscription have been approved successfully');


    }


    public function LiveSubscriptions()
    {
        $subscriptions = Subscription::where('status', true)->get();
        return view('member.admin.livesubscriptions', ['subscriptions' => $subscriptions]);
    }
}
