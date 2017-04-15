<?php

namespace App\Http\Controllers\user;

use App\Contento\Blogger;
use App\Contento\contento;
use App\Contento\pricing;
use App\currency;
use App\datasource_feed;
use App\Notifications\NotifySubscription;
use App\Plan;
use App\Published_feed;
use App\Subscription;
use App\Subscription_domain;
use App\Subscription_feed;
use App\Transaction;
use App\User;
use App\User_domain;
use App\User_profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('member.user.default');
    }

    public function Pricing()
    {
        return view('member.user.pricing');
    }

    public function CreateSubscription()
    {
        $subscriptions = datasource_feed::where('status', true)->get();
        return view('member.user.subscription', ['datas' => $subscriptions]);
    }

    public function ViewManageSubscriptions()
    {
        $user = Auth::user();
        $subscriptions = Subscription::where('user_id', $user->id)->get();
        return view('member.user.managesubscriptions', ['subscriptions' => $subscriptions]);
    }

    public function ViewCreateSubscription()
    {
        $user = Auth::user();
        $profile = User_profile::where('user_id', $user->id)->count();
        if ($profile > 0) {
            $sources = datasource_feed::where('status', true)->get();
            $plans = Plan::all();
            return view('member.user.subscription', ['datas' => $sources, 'plans' => $plans]);
        } else {
            return redirect('/user/user-settings')->withErrors('You must update your profile to continue');
        }
    }

    public function GetUserSettings()
    {
        $user = User::find(Auth::id());
        $currency = currency::all();
        return view('member.user.user_settings', ['user' => $user, 'currencies' => $currency]);
    }

    public function PostUserSettings(Request $request)
    {
        $user = Auth::user();
        $profile = User_profile::where('user_id', $user->id)->count();
        if ($profile > 0) {
            return redirect($request->path())->with('message', 'profile updated successfully');
        }
        User_profile::create([
            'user_id' => $user->id,
            'currency_id' => $request->currency,
            'country' => $request->country

        ]);
        return redirect($request->path())->with('message', 'profile updated successfully');

    }

    public function PostSubscription(Request $request)
    {
        $user = Auth::user();
        if (count($request->id) == 0) {
            return redirect($request->path())->withErrors('invalid parameters');
        }
        $profile_count = User_profile::where('user_id', $user->id)->count();
        if ($profile_count == 0) {
            return redirect('/user/user-settings')->withErrors('You must update your profile before you can continue');
        }
        $profile = User_profile::where('user_id', $user->id)->first();
        $currency = $profile->currency;
        $feeds = $request->id;
        $cost = '';
        foreach ($feeds as $feed) {
            $datasource_feed = datasource_feed::find($feed);
            $cost += $datasource_feed->cost;
        }
        $cost = $cost * $currency->rate_to_usd;
        $plan = Plan::find($request->duration);

        $count = count($feeds);
        $pricing = new pricing();

        $discounted_cost_for_feed = $pricing->GetCostforFeedQuantity($count) * $cost;
        $discounted_cost_for_duration = $pricing->GetPriceperDuration($plan->month) * $discounted_cost_for_feed * $plan->month;
        $final_cost = $pricing->DiscountforDomain($request->number_of_domain) * $discounted_cost_for_duration * $request->number_of_domain;
        $actual_cost = $cost * $plan->month * $request->number_of_domain;
        $discount = (($actual_cost - $final_cost) / $actual_cost) * 100;
        $sources = datasource_feed::find($feeds);
        $currency_code = country($currency->country)->getCurrency()['iso_4217_code'];
        return view('member.user.finalize_order', ['actual_cost' => $actual_cost, 'final_cost' => $final_cost, 'sources' => $sources, 'feeds' => $feeds, 'currency' => $currency->id, 'total_discount' => $discount, 'subscription_name' => $request->name, 'domain_number' => $request->number_of_domain, 'currency_code' => $currency_code, 'plan' => $plan]);


    }

    public function FinalizeSubscription(Request $request)
    {
        $user = Auth::user();
        $feeds = $request->feeds;
        DB::beginTransaction();

        /*$subscri = subscription::where('users_id', $user->id)->where('user_websites_id', $website->id)->where('status', false)->get();
        if (count($subscri) > 0) {
            $sub = subscription::with(['feeds.feed.Datasource', 'transaction' => function ($query) {
                $query->where('status', false);
            }, 'transaction.currency', 'plan'])->find($subscri[0]->id);
            $pricing = table_pricing::where('is_default', true)->get();

            return view('theaggregator::panel.invoice', ['subscription' => $sub, 'price' => $pricing])->with('message', 'You have an existing order with this domain name. Kindly click on edit to continue');
        }*/
        $subscription = Subscription::create([
            'name' => $request->subscription_name,
            'user_id' => $user->id,
            'plan_id' => $request->plan,
            'number_of_domains' => $request->allowed_domains
        ]);
        foreach ($feeds as $feed) {
            Subscription_feed::create([
                'feed_id' => $feed,
                'subscription_id' => $subscription->id
            ]);
        }
        Transaction::create([
            'subscription_id' => $subscription->id,
            'amount' => $request->final_cost,
            'actual_cost' => $request->actual_cost,
            'discount' => $request->discount,
            'currency_id' => $request->currency
        ]);
        DB::commit();
        $user->notify(new NotifySubscription());
        $sub = Subscription::with(['feeds.feed.Datasource', 'transaction' => function ($query) {
            $query->where('status', false);
        }, 'transaction.currency', 'plan'])->find($subscription->id);
        return view('member.user.invoice', ['subscription' => $sub])->with('message', 'please make payment to confirm your order');
    }

    public function GetInvoice(Request $request)
    {
        if (isset($request->subscription)) {
            $sub = Subscription::with(['feeds.feed.Datasource', 'transaction' => function ($query) {
                $query->where('status', false);
            }, 'transaction.currency', 'plan'])->find($request->subscription);
            return view('member.user.invoice', ['subscription' => $sub]);
        } else {
            return redirect('/user/subscriptions')->with('message', 'please select subscription below or add a new subscription');
        }
    }

    public function BuyOnline(Request $request)
    {
        $contento = new contento();
        return redirect()->away($contento->RedirectPaystack($request));
    }

    public function ManageDomains(Request $request)
    {
        $user = Auth::user();
        if (isset($_POST['submit_new'])) {
            $subscription = Subscription::find($request->subscription);
            if (count($subscription->domain) >= $subscription->number_of_domains) {
                return redirect('user/manage-subscriptions')->with('message', 'Maximum allowed domains reached');
            }
            $domain = User_domain::updateOrCreate(['url' => $request->url, 'user_id' => $user->id, 'platform_id' => 1, 'api_data_id']);
            Subscription_domain::updateOrCreate(['subscription_id' => $request->subscription, 'user_domain_id' => $domain->id], ['platform_id' => 2]);
            return redirect('user/manage-subscriptions')->with('message', 'Domain added successfully, click domain to manage content');
        } elseif (isset($_POST['submit_blogger'])) {
            $subscription = Subscription::find($request->subscription);
            if (count($subscription->domain) >= $subscription->number_of_domains) {
                return redirect('user/manage-subscriptions')->with('message', 'Maximum allowed domains reached');
            }
            Subscription_domain::updateOrCreate(['subscription_id' => $request->subscription, 'user_domain_id' => $request->domain], ['platform_id' => 2]);
            return redirect('user/manage-subscriptions')->with('message', 'Domain added successfully, click domain to manage content');
        } elseif (isset($_POST['manage_domain'])) {
            $subscription = Subscription::with(['domain' => function ($query) use ($request) {
                $query->where('id', $request->domain);
            }])->find($request->subscription);
            if (date("Y m d H:i:s") > $subscription->ends_at) {
                return redirect('user/manage-subscriptions')->withErrors('Your subscription has expired, please renew.');
            }
            return view('member.user.managedomain', ['subscription' => $subscription]);
        } else {
            $type = null;
            if (isset($_POST['type'])) {
                $type = $request->type;
            }
            $subscription = Subscription::find($request->subscription);
            if (count($user->api_data) > 0) {
                $blogs = User_domain::where('user_id', $user->id)->where('platform_id', 2)->get();
                return view('member.user.manage_domains', ['subscription' => $subscription, 'type' => $type, 'user' => $user, 'blogs' => $blogs]);
            }
            return view('member.user.manage_domains', ['subscription' => $subscription, 'type' => $type, 'user' => $user]);

        }
    }

    public function SubscriptionDomain($sub, $d)
    {
        $user = Auth::user();
        //$domain = User_domain::where('url', $domain)->where('user_id', $user->id)->first();
        $subscription = Subscription::with(['domain' => function ($query) use ($d, $sub) {
            $query->where('id', $d);
        }, 'feeds.feed.feed.published' => function ($query2) use ($d, $sub) {
            $query2->where('subscription_id', $sub)->where('domain_id', $d);
        }])->find($sub);
        if ($subscription->user_id !== $user->id) {
            return redirect('user/manage-subscriptions');
        }
        if (date("Y m d H:i:s") > $subscription->ends_at) {
            return redirect('user/manage-subscriptions')->withErrors('Your subscription has expired, please renew.');
        }
        return view('member.user.managedomain', ['subscription' => $subscription]);
    }


}
