<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Config;

class TestimonialsController extends Controller
{
         /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titles = ['title' => 'Manage Testimonials', 'subTitle' => 'Add Testimonials', 'listTitle' => 'Testimonials List'];
        $deleteRouteName = "testimonials.destroy";

        if (!auth()->user()->can('testimonials-view')) {
            return view('admin.abort', compact('titles'));
        }



        $testimonials = Testimonial::get();
        $noImage = asset(Config::get('constants.NO_IMG_ADMIN'));

        return view('admin.testimonials.index', compact('titles', 'testimonials', 'deleteRouteName', 'noImage' ));
    }

      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $titles = [
            'title' => "Testimonials",
            'subTitle' => "Add Testimonials",
        ];
        if (!auth()->user()->can('testimonials-add')) {
            return view('admin.abort',compact('titles'));
        }
        $services = Service::get();

        return view('admin.testimonials.create', compact('titles','services'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('testimonials-add')) {
            return view('admin.abort');
        }

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'image' => 'image|required|mimes:jpeg,png,jpg,svg,gif|max:2048',
            'service_id'=> 'required'
        ]);

        $data = array();
        $originalImage = $request->file('image');

        if ($originalImage != NULL) {
            $newFileName = time() . $originalImage->getClientOriginalName();

            $originalPath = Testimonial::$imagePath;

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

        $data['slug'] = unique_slug($request->name, 'Testimonial');
        $data['name'] = $request->name;
        $data['service_id'] = $request->service_id;
        $data['description'] = $request->description;
        $data['status'] = $request->status;
        
        Testimonial::create($data);
        return redirect()->route('testimonials.index')->with('success','Testimonial created Successfully');
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
        $titles = ['title' => 'Manage Testimonials', 'subTitle' => 'Edit Testimonials', 'listTitle' => 'Testimonials List'];
        if (!auth()->user()->can('testimonials-update')) {
            return view('admin.abort', compact('titles'));
        }

        $testimonial = Testimonial::find($id);
        $services = Service::get();

        return view('admin.testimonials.edit', compact('titles', 'testimonial' ,'services'));
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
        if (!auth()->user()->can('testimonials-update')) {
            return view('admin.abort');
        }

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,svg,gif|max:2048'
        ]);

        $data = array();

        $testimonial = Testimonial::find($id);

        $testimonialImage = $request->file('image');

        if ($testimonialImage != NULL) {
            // Delete the previous image
            deleteImage(Testimonial::$imagePath, $testimonial->image);


            $newFileName = time() . $testimonialImage->getClientOriginalName();
            $originalPath = Testimonial::$imagePath;

            // Image Upload Process
            $thumbnailImage = Image::make($testimonialImage);
            //$thumbnailImage->save($originalPath . $newFileName);
            $thumbnailImage->resize(601,511)->save($originalPath . $newFileName);
            $testimonial->image = $newFileName;
        }

        
        

        $testimonial->name = $request->name;
        $testimonial->slug = unique_slug($request->name, 'Service' , $testimonial->id);;
        $testimonial->status = $request->status;
        $testimonial->description = $request->description;

        $testimonial->save();

        return redirect()->route('testimonials.index')->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if (!auth()->user()->can('testimonials-delete')) {
            return view('admin.abort');
        }
        $deleteId = $request->delete_id;
        $testimonial = Testimonial::find($deleteId);

        if ($deleteId) {
            // Delete the previous image
            deleteImage(Testimonial::$imagePath, $testimonial->image);
            $testimonial->delete();

            return redirect()->route('testimonials.index')->with('success', 'Deleted Successfully');
        }
    }
}
