<?php

namespace App\Http\Controllers\admin;

use App\currency;
use App\datasource;
use App\datasource_feed;
use App\Jobs\FindFeeds;
use App\Plan;
use App\Subscription;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        return view('member.admin.managesources', ['sources' => $sources, 'feeds' => $feeds]);
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
                    'status' => false
                ]);
            }
            $datas = datasource_feed::where('datasource_id', $request->datasource_id)->get();
            return view('member.admin.managefeeds', ['datas' => $datas]);
        }
    }

    public function ManageFeedsView()
    {
        $datas = datasource_feed::orderBy('name', 'asc')->get();
        return view('member.admin.managefeeds', ['datas' => $datas]);
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

        return redirect($request->path())->with('message', 'Subscription have been approved successfully');


    }


    public function LiveSubscriptions()
    {
        $subscriptions = Subscription::where('status', true)->get();
        return view('member.admin.livesubscriptions', ['subscriptions' => $subscriptions]);
    }
}
