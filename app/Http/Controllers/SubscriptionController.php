<?php

namespace App\Http\Controllers;

use App\DataTables\SubscriptionsDataTable;
use App\Models\Plan;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    //
    public function index(SubscriptionsDataTable $dataTable, $id) {
        $nowDate = Carbon::now();
        $subscriptions = Subscription::where([
            'user_id' => $id,
            ['renewal_date', '>', $nowDate],
        ])->first();
        $expiryDate = null;
        if($subscriptions):
            $plan = Plan::find($subscriptions->plan_id);
            $expiryDate = Carbon::parse($subscriptions->renewal_date)->addDays($plan->duration_in_days);
        endif;
        
        return $dataTable->render('subscriptions.index', ['activeSubscription' => $subscriptions, 'expiryDate' => $expiryDate]);
    }

    public function edit($id, $subscription) {
        $selectedSubscription = Subscription::where([
            'user_id'=> $id,
            'id'=>$subscription
        ])->first();
        if(Carbon::parse($selectedSubscription->renewal_date)->lt(Carbon::now())):
            return redirect()->route('subscriptions.index', ['id' => $id])
        ->with('warning', 'Cannot ammend an already expired subscription');
        endif;
        $plans = Plan::all();
        return view('subscriptions.edit', [
            'subscription' => $selectedSubscription,
            'plans'=>$plans,
        ]);
    }

    public function update(Request $request, $id, $subscription) {
        $selectedSubscription = Subscription::where([
            'user_id'=> $id,
            'id'=>$subscription
            ])->first();
        $plan = Plan::find($request->input('plan_id'));
        $selectedSubscription->update([
            'plan_id' => $request->input('plan_id'),
            'renewal_date'=> Carbon::now()->addDays($plan->duration_in_days)
        ]);
        return redirect()->route('subscriptions.index', ['id' => $id]); 

    }
}
