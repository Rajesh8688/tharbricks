<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Category;
use Illuminate\Support\Facades\Config;

class CategoryController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titles = ['title' => 'Manage Categories', 'subTitle' => 'Add Category', 'listTitle' => 'Category List'];
        $deleteRouteName = "category.destroy";

        if (!auth()->user()->can('category-view')) {
            return view('admin.abort', compact('titles'));
        }

        $categories = Category::get();
        $noImage = asset(Config::get('constants.NO_IMG_ADMIN'));

        return view('admin.category.index', compact('titles', 'categories', 'deleteRouteName', 'noImage'));
    }

      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $titles = [
            'title' => "Category",
            'subTitle' => "Add category",
        ];
        if (!auth()->user()->can('category-add')) {
            return view('admin.abort',compact('titles'));
        }

        return view('admin.category.create', compact('titles'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('category-add')) {
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

            $thumbnailPath = Category::$imageThumbPath;
            $originalPath = Category::$imagePath;

            if($originalImage->getClientOriginalExtension() == 'svg')
            {
                $newFileName = time().$originalImage->getClientOriginalName();
                $destinationPath = env('SVG_IMAGE_UPLOAD_PATH' , public_path()).$originalPath;
                $originalImage->move($destinationPath, $newFileName);
            }
            else{
                // Image Upload Process
                $thumbnailImage = Image::make($originalImage);
                $thumbnailImage->save($originalPath . $newFileName);
                $thumbnailImage->resize(150, null, function ($constraint) {
                    $constraint->aspectRatio();
                    })->save($thumbnailPath . $newFileName);
            }

            $data['image'] = $newFileName;
        }

        $originalImage = $request->file('icon');

        if ($originalImage != NULL) {
            $newFileName = time() . $originalImage->getClientOriginalName();

            $thumbnailPath = Category::$imageThumbPath;
            $originalPath = Category::$imagePath;

            if($originalImage->getClientOriginalExtension() == 'svg')
            {
                $newFileName = time().$originalImage->getClientOriginalName();
                $destinationPath = env('SVG_IMAGE_UPLOAD_PATH' , public_path()).$originalPath;
                $originalImage->move($destinationPath, $newFileName);
            }
            else{
                // Image Upload Process
                $thumbnailImage = Image::make($originalImage);
                $thumbnailImage->save($originalPath . $newFileName);
                $thumbnailImage->resize(150, null, function ($constraint) {
                    $constraint->aspectRatio();
                    })->save($thumbnailPath . $newFileName);
            }

            $data['icon'] = $newFileName;
        }

        $data['slug'] = unique_slug($request->name, 'Category');
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['status'] = $request->status;
        $data['valid_upto'] = $request->valid_upto;
        
        Category::create($data);
        return redirect()->route('Category.index')->with('success','Category created Successfully');
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
    // public function edit($id)
    // {
    //     $titles = ['title' => 'Manage Brand', 'subTitle' => 'Add Brand', 'listTitle' => 'Brand List'];
    //     if (!auth()->user()->can('category-update')) {
    //         return view('admin.abort', compact('titles'));
    //     }

    //     $brand = Brand::find($id);

    //     return view('admin.brand.edit', compact('titles', 'brand'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param \Illuminate\Http\Request $request
    //  * @param int $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     if (!auth()->user()->can('category-update')) {
    //         return view('admin.abort');
    //     }

    //     $this->validate($request, [
    //         'name_en' => 'required',
    //         'name_ar' => 'required',
    //     ]);

    //     $data = array();

    //     $brand = Brand::find($id);

    //     $brandImage = $request->file('image');

    //     if ($brandImage != NULL) {

    //         // Delete the previous image
    //         $this->deleteImageBuddy(Brand::$imagePath, $brand->image);

    //         $newFileName = time() . $brandImage->getClientOriginalName();
    //         $originalPath = Brand::$imagePath;

    //         // Image Upload Process
    //         $thumbnailImage = Image::make($brandImage);
    //         $thumbnailImage->save($originalPath . $newFileName);

    //         $brand->image = $newFileName;
    //     }

    //     $brand->name_en = $request->name_en;
    //     $brand->name_ar = $request->name_ar;

    //     $brand->save();

    //     return redirect()->route('brand.index')->with('success', 'Updated Successfully');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id, Request $request)
    // {
    //     if (!auth()->user()->can('category-delete')) {
    //         return view('admin.abort');
    //     }

    //     $deleteId = $request->delete_id;
    //     $brand = Brand::find($deleteId);

    //     if ($deleteId) {

    //         // Delete the previous image
    //         $this->deleteImageBuddy(Brand::$imagePath, $brand->image);
    //         $this->deleteImageBuddy(Brand::$imagePath, $brand->banner_image);
    //         $brand->delete();

    //         return redirect()->route('brand.index')->with('success', 'Deleted Successfully');

    //     }
    // }
}
