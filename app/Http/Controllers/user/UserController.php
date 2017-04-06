<?php

namespace App\Http\Controllers\user;

use App\Contento\pricing;
use App\currency;
use App\datasource_feed;
use App\Plan;
use App\Subscription;
use App\User;
use App\User_profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $id = '';
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
        return view('member.user.finalize_order', ['actual_cost' => $actual_cost, 'final_cost' => $final_cost, 'sources' => $sources, 'feeds' => $id, 'currency' => $currency->id, 'total_discount' => $discount, 'subscription_name' => $request->name, 'domain_number' => $request->number_of_domain, 'currency_code' => $currency_code, 'plan' => $plan]);


    }
}
