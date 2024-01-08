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

            $iconPath = Category::$imageIconPath;
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

            $iconPath = Category::$imageIconPath;

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

        $data['slug'] = unique_slug($request->name, 'Category');
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['status'] = $request->status;
        
        Category::create($data);
        return redirect()->route('category.index')->with('success','Category created Successfully');
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
        $titles = ['title' => 'Manage Category', 'subTitle' => 'Edit Category', 'listTitle' => 'Category List'];
        if (!auth()->user()->can('category-update')) {
            return view('admin.abort', compact('titles'));
        }

        $category = Category::find($id);

        return view('admin.category.edit', compact('titles', 'category'));
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
        if (!auth()->user()->can('category-update')) {
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

        $category = Category::find($id);

        $categoryImage = $request->file('image');
        $categoryIcon = $request->file('icon');

        if ($categoryImage != NULL) {
            // Delete the previous image
            deleteImage(Category::$imagePath, $category->image);


            $newFileName = time() . $categoryImage->getClientOriginalName();
            $originalPath = Category::$imagePath;

            // Image Upload Process
            $thumbnailImage = Image::make($categoryImage);
            //$thumbnailImage->save($originalPath . $newFileName);
            $thumbnailImage->resize(601,511)->save($originalPath . $newFileName);
            $category->image = $newFileName;
        }

        
        if ($categoryIcon != NULL) {
            $newFileName = time() . $categoryIcon->getClientOriginalName();
            $originalPath = Category::$imageIconPath;
              // Delete the previous image
            deleteImage(Category::$imageIconPath, $category->icon);

            // Image Upload Process
            $thumbnailImage = Image::make($categoryIcon);
            //$thumbnailImage->save($originalPath . $newFileName);
            $thumbnailImage->resize(44,44)->save($originalPath . $newFileName);
            $category->icon = $newFileName;
        }

        $category->name = $request->name;
        $category->slug = unique_slug($request->name, 'Category' , $category->id);;
        $category->status = $request->status;
        $category->description = $request->description;

        $category->save();

        return redirect()->route('category.index')->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if (!auth()->user()->can('category-delete')) {
            return view('admin.abort');
        }
        $deleteId = $request->delete_id;
        $category = Category::find($deleteId);

        if ($deleteId) {
            // Delete the previous image
            deleteImage(Category::$imagePath, $category->image);
            deleteImage(Category::$imageIconPath, $category->icon);
            $category->delete();

            return redirect()->route('category.index')->with('success', 'Deleted Successfully');
        }
    }
}
