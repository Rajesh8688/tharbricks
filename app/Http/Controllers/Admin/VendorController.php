<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\ServiceUser;
use Illuminate\Http\Request;
use App\Models\UserServiceLocation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class VendorController extends Controller
{
    public function index()
    {
        $titles = ['title' => 'Manage vendor', 'subTitle' => 'Add vendor', 'listTitle' => 'vendor List'];
        $deleteRouteName = "vendor.destroy";
        if (!auth()->user()->can('vendor-view')) {
            return view('admin.abort', compact('titles'));
        }
        $vendors = User::with('vendorDetails')->where('is_vendor', '1')->orderBy('id','DESC')->get();
        $noImage = asset(Config::get('constants.NO_IMG_ADMIN'));
        // dd($vendors);

        return view('admin.vendor.index', compact('titles', 'vendors', 'deleteRouteName', 'noImage' ));
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

    public function view($id)
    {
        $titles = ['title' => 'Manage vendor', 'subTitle' => 'Add vendor', 'listTitle' => 'vendor List'];
        $noImage = asset(Config::get('constants.NO_IMG_ADMIN'));
        $deleteRouteName = "vendor.destroy";
        if (!auth()->user()->can('vendor-view')) {
            return view('admin.abort', compact('titles'));
        }
        $vendor = User::with('vendorDetails')->find($id);
        $myservices = ServiceUser::with('service')->where(['user_id' => $id , 'status' => "Active"])->get();
        foreach($myservices as $m=>$service){
            $myservices[$m]['locations'] = UserServiceLocation::with('location')->where(['service_id' => $service->id ])->get();
        }

        return view('admin.vendor.view', compact('titles' , 'vendor' , 'deleteRouteName' ,'noImage' ,'myservices'));
    }
}
