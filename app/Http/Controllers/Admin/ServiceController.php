<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class ServiceController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titles = ['title' => 'Manage Services', 'subTitle' => 'Add Service', 'listTitle' => 'Service List'];
        $deleteRouteName = "service.destroy";

        if (!auth()->user()->can('service-view')) {
            return view('admin.abort', compact('titles'));
        }

        $services = Service::get();
        $noImage = asset(Config::get('constants.NO_IMG_ADMIN'));

        return view('admin.service.index', compact('titles', 'services', 'deleteRouteName', 'noImage'));
    }

      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $titles = [
            'title' => "Service",
            'subTitle' => "Add service",
        ];
        if (!auth()->user()->can('service-add')) {
            return view('admin.abort',compact('titles'));
        }

        return view('admin.service.create', compact('titles'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('service-add')) {
            return view('admin.abort');
        }

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'image' => 'image|required|mimes:jpeg,png,jpg,svg,gif|max:2048',
            'icon' => 'image|required|mimes:jpeg,png,jpg,svg,gif|max:2048',
        ]);

        $data = array();
        $originalImage = $request->file('image');

        if ($originalImage != NULL) {
            $newFileName = time() . $originalImage->getClientOriginalName();

            $iconPath = Service::$imageIconPath;
            $originalPath = Service::$imagePath;

            if($originalImage->getClientOriginalExtension() == 'svg')
            {
                $newFileName = time().$originalImage->getClientOriginalName();
                $destinationPath = env('SVG_IMAGE_UPLOAD_PATH' , public_path()).$originalPath;
                $originalImage->move($destinationPath, $newFileName);
            }
            else{
                // Image Upload Process
                $thumbnailImage = Image::make($originalImage);
                //$thumbnailImage->save($originalPath . $newFileName);
                // $thumbnailImage->resize(150, null, function ($constraint) {
                //     $constraint->aspectRatio();
                //     })->save($thumbnailPath . $newFileName);
                $thumbnailImage->resize(601,511)->save($originalPath . $newFileName);
          
            }


            $data['image'] = $newFileName;
        }

        $iconImage = $request->file('icon');

        if ($iconImage != NULL) {
            $newFileName = time() . $iconImage->getClientOriginalName();

            $iconPath = Service::$imageIconPath;

            if($iconImage->getClientOriginalExtension() == 'svg')
            {
                $newFileName = time().$iconImage->getClientOriginalName();
                $destinationPath = env('SVG_IMAGE_UPLOAD_PATH' , public_path()).$originalPath;
                $iconImage->move($destinationPath, $newFileName);
            }
            else{
                // Image Upload Process
                $thumbnailImage = Image::make($iconImage);
                //$thumbnailImage->save($originalPath . $newFileName);
                // $thumbnailImage->resize(150, null, function ($constraint) {
                //     $constraint->aspectRatio();
                //     })->save($thumbnailPath . $newFileName);
                $thumbnailImage->resize(44,44)->save($iconPath . $newFileName);
            }

            $data['icon'] = $newFileName;
        }

        $data['slug'] = unique_slug($request->name, 'Service');
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['status'] = $request->status;
        
        Service::create($data);
        return redirect()->route('service.index')->with('success','Service created Successfully');
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
    {
        $titles = ['title' => 'Manage Service', 'subTitle' => 'Edit Service', 'listTitle' => 'Service List'];
        if (!auth()->user()->can('service-update')) {
            return view('admin.abort', compact('titles'));
        }

        $service = Service::find($id);

        return view('admin.service.edit', compact('titles', 'service'));
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param \Illuminate\Http\Request $request
    //  * @param int $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('service-update')) {
            return view('admin.abort');
        }

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,svg,gif|max:2048',
            'icon' => 'image|mimes:jpeg,png,jpg,svg,gif|max:2048',
        ]);

        $data = array();

        $service = Service::find($id);

        $serviceImage = $request->file('image');
        $serviceIcon = $request->file('icon');

        if ($serviceImage != NULL) {
            // Delete the previous image
            deleteImage(Service::$imagePath, $service->image);


            $newFileName = time() . $serviceImage->getClientOriginalName();
            $originalPath = Service::$imagePath;

            // Image Upload Process
            $thumbnailImage = Image::make($serviceImage);
            //$thumbnailImage->save($originalPath . $newFileName);
            $thumbnailImage->resize(601,511)->save($originalPath . $newFileName);
            $service->image = $newFileName;
        }

        
        if ($serviceIcon != NULL) {
            $newFileName = time() . $serviceIcon->getClientOriginalName();
            $originalPath = Service::$imageIconPath;
              // Delete the previous image
            deleteImage(Service::$imageIconPath, $service->icon);

            // Image Upload Process
            $thumbnailImage = Image::make($serviceIcon);
            //$thumbnailImage->save($originalPath . $newFileName);
            $thumbnailImage->resize(44,44)->save($originalPath . $newFileName);
            $service->icon = $newFileName;
        }

        $service->name = $request->name;
        $service->slug = unique_slug($request->name, 'Service' , $service->id);;
        $service->status = $request->status;
        $service->description = $request->description;

        $service->save();

        return redirect()->route('service.index')->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if (!auth()->user()->can('service-delete')) {
            return view('admin.abort');
        }
        $deleteId = $request->delete_id;
        $service = Service::find($deleteId);

        if ($deleteId) {
            // Delete the previous image
            deleteImage(Service::$imagePath, $service->image);
            deleteImage(Service::$imageIconPath, $service->icon);
            $service->delete();

            return redirect()->route('service.index')->with('success', 'Deleted Successfully');
        }
    }
}
