<?php

namespace App\Http\Controllers\Api;

use App\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function UserSubscriptions(Request $request)
    {
        try {
            $user = $request->user();
            $subscription = Subscription::where('user_id', $user->id)->get();
            if (count($subscription) < 1) {
                return 'You do not have any subscription on contento';
            }
            return $subscription;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
