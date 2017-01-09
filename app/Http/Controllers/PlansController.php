<?php

namespace App\Http\Controllers;

use App\Plan;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    public function index()
    {
        return view('plans.index')->with(['plans' => Plan::get()]);
    }

    public function show(Request $request, Plan $plan)
    {
        if ($request->user()->subscribedToPlan($plan->braintree_plan, 'main')) {
            return redirect('home')->with('error', 'Unauthorised operation');
      }

      return view('plans.show')->with(['plan' => $plan]);
    }
}
