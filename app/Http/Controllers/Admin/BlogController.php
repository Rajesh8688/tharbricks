<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Config;

class BlogController extends Controller
{
            /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titles = ['title' => 'Manage Blogs', 'subTitle' => 'Add Blogs', 'listTitle' => 'Blogs List'];
        $deleteRouteName = "blogs.destroy";

        if (!auth()->user()->can('blogs-view')) {
            return view('admin.abort', compact('titles'));
        }



        $blogs = Blog::get();
        $noImage = asset(Config::get('constants.NO_IMG_ADMIN'));

        return view('admin.blogs.index', compact('titles', 'blogs', 'deleteRouteName', 'noImage' ));
    }

      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $titles = [
            'title' => "Blogs",
            'subTitle' => "Add Blogs",
        ];
        if (!auth()->user()->can('blogs-add')) {
            return view('admin.abort',compact('titles'));
        }
        $services = Service::get();

        return view('admin.blogs.create', compact('titles','services'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('blogs-add')) {
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

            $originalPath = Blog::$imagePath;

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
                // $thumbnailImage->resize(836,446)->save($originalPath . $newFileName);
                $thumbnailImage->save($originalPath . $newFileName);
          
            }


            $data['image'] = $newFileName;
        }

        $data['slug'] = unique_slug($request->name, 'Blog');
        $data['name'] = $request->name;
        $data['service_id'] = $request->service_id;
        $data['description'] = $request->description;
        $data['status'] = $request->status;
        $data['tags'] = $request->tags ?? null;
        $data['user_name'] = $request->user_name ?? null;
        
        
        Blog::create($data);
        return redirect()->route('blogs.index')->with('success','Blogs created Successfully');
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
        $titles = ['title' => 'Manage Blogs', 'subTitle' => 'Edit Blogs', 'listTitle' => 'Blogs List'];
        if (!auth()->user()->can('blogs-update')) {
            return view('admin.abort', compact('titles'));
        }

        $blog = Blog::find($id);
        $services = Service::get();

        return view('admin.blogs.edit', compact('titles', 'blog' ,'services'));
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
        if (!auth()->user()->can('blogs-update')) {
            return view('admin.abort');
        }

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,svg,gif|max:2048',
            'service_id'=> 'required'
        ]); 

        $data = array();

        $blog = Blog::find($id);

        $blogImage = $request->file('image');

        if ($blogImage != NULL) {
            // Delete the previous image
            deleteImage(Blog::$imagePath, $blog->image);


            $newFileName = time() . $blogImage->getClientOriginalName();
            $originalPath = Blog::$imagePath;

            // Image Upload Process
            $thumbnailImage = Image::make($blogImage);
            //$thumbnailImage->save($originalPath . $newFileName);
            $thumbnailImage->save($originalPath . $newFileName);
            $blog->image = $newFileName;
        }

        $blog->name = $request->name;
        $blog->slug = unique_slug($request->name, 'Blog' , $blog->id);
        $blog->status = $request->status;
        $blog->description = $request->description;
        $blog->service_id = $request->service_id;
        $blog->tags = $request->tags ?? Null;
        $blog->user_name = $request->user_name ?? Null;
        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if (!auth()->user()->can('blogs-delete')) {
            return view('admin.abort');
        }
        $deleteId = $request->delete_id;
        $testimonial = Blog::find($deleteId);

        if ($deleteId) {
            // Delete the previous image
            deleteImage(Blog::$imagePath, $testimonial->image);
            $testimonial->delete();

            return redirect()->route('blogs.index')->with('success', 'Deleted Successfully');
        }
    }
}
