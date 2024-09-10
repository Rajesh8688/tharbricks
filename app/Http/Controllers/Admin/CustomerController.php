<?php

namespace App\Http\Controllers\Admin;

use App\Models\Lead;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        $titles = ['title' => 'Manage Customer', 'subTitle' => '', 'listTitle' => 'Customer List'];
        $deleteRouteName = "customer.destroy";
        if (!auth()->user()->can('customer-view')) {
            return view('admin.abort', compact('titles'));
        }
        $customers = Lead::orderBy('id','DESC')->get();

        return view('admin.customer.index', compact('titles', 'customers', 'deleteRouteName' ));
    }
    
      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param int $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param int $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function edit($id)
    {}

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param \Illuminate\Http\Request $request
    //  * @param int $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function update(Request $request, $id)
    {}

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if (!auth()->user()->can('vendor-delete')) {
            return view('admin.abort');
        }
        $deleteId = $request->delete_id;
        $user = User::find($deleteId);

        if ($deleteId) {

            $user->where('status', 'InActive')->save();

            return redirect()->route('vendor.index')->with('success', 'Vendor InActivated Successfully');
        }
    }
}
