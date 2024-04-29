<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PlanDetails;

class PlanController extends Controller
{
    public function index(Request $request)
    {
        $titles = ['title' => 'Manage Plans', 'subTitle' => 'Add Plan', 'listTitle' => 'Plan List'];
        $deleteRouteName = "plan.destroy";

        if (!auth()->user()->can('plan-view')) {
            return view('admin.abort', compact('titles'));
        }

        $plans = Plan::get();
        return view('admin.plan.index', compact('titles', 'plans', 'deleteRouteName'));
    }

    public function create()
    {
               
        $titles = [
            'title' => "Plan",
            'subTitle' => "Add Plan",
        ];
        if (!auth()->user()->can('plan-add')) {
            return view('admin.abort',compact('titles'));
        }

        return view('admin.plan.create', compact('titles'));

    }

    public function store(Request $request)
    {
        if (!auth()->user()->can('plan-add')) {
            return view('admin.abort');
        }

        $this->validate($request, [
            'name' => 'required',
            'status' => 'required',
            'order' => 'required',
            'amount' => 'required',
            'no_of_credits' => 'required'
        ]);

        $plan = new plan();

        $plan->name = $request->input('name');
        $plan->status = $request->input('status');
        $plan->order = $request->input('order');
        $plan->amount = $request->input('amount');
        $plan->no_of_credits = $request->input('no_of_credits');
        //$plan->no_of_responses = $request->input('no_of_responses');
        $plan->discount = !empty($request->input('discount')) ? $request->input('discount') : 0;
        $plan->slug =  unique_slug($request->input('name'), 'Plan');

        $plan->save();
        return redirect()->route('plan.index')->with('success','Question created Successfully');
    }

    public function edit($id)
    {
        $titles = ['title' => 'Manage Plan', 'subTitle' => 'Edit Plan', 'listTitle' => 'Plan List'];
        if (!auth()->user()->can('plan-update')) {
            return view('admin.abort', compact('titles'));
        }

        $plan = Plan::find($id);

        //$planDetails = PlanDetails::where('plan_id' , $id)->orderBy('id', 'ASC')->get();


        return view('admin.plan.edit', compact('titles','plan'));

    }

    public function update(Request $request, $id)
    {

        if (!auth()->user()->can('plan-update')) {
            return view('admin.abort');
        }
        $this->validate($request, [
            'name' => 'required',
            'status' => 'required',
            'order' => 'required',
            'amount' => 'required',
            'no_of_credits' => 'required'
        ]);
        
        $plan = Plan::find($id);
        $plan->name = $request->input('name');
        $plan->status = $request->input('status');
        $plan->order = $request->input('order');
        $plan->amount = $request->input('amount');
        $plan->no_of_credits = $request->input('no_of_credits');
        //$plan->no_of_responses = $request->input('no_of_responses');
        $plan->discount = !empty($request->input('discount')) ? $request->input('discount') : 0;
        $plan->slug = unique_slug($request->input('plan_text'), 'plan' , $plan->id);
        $plan->save();

        // $planDetailsId = [];
     
        // $plan_details_id = $request->input('plan_details_id');
        // $plan_details = $request->input('plan_details');
        // $plan_details_order = $request->input('plan_details_order');

        // foreach($plan_details as $nrk => $nrv){
        //     if(!empty($plan_details_id[$nrk])){
        //         //update
        //         $planDetails = PlanDetails::find($plan_details_id[$nrk]);
        //     }else{
        //         //add
        //         $planDetails = new PlanDetails();
        //     }


        //     $planDetails->plan_id = $plan->id;
        //     $planDetails->title = $plan_details[$nrk];
        //     $planDetails->order = $plan_details_order[$nrk];
        //     $planDetails->status = 'Active';
        //     $planDetails->save();
        //     $planDetailsId[] = $planDetails->id;
        // }
       
        // $qq = PlanDetails::whereNotIn('id' , $planDetailsId)->where("plan_id" , $plan->id)->delete();


        return redirect()->route('plan.index')->with('success', 'Updated Successfully');

    }


}
