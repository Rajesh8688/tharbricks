<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;


class EmailTemplateController extends Controller
{
    
            /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titles = ['title' => 'Manage Email Template', 'subTitle' => 'Add Email Template', 'listTitle' => 'Email Template List'];
        $deleteRouteName = "email-template.destroy";

        if (!auth()->user()->can('email-template-view')) {
            return view('admin.abort', compact('titles'));
        }

        $email_templates = EmailTemplate::where(['module' => 'admin'])->get();
        

        return view('admin.emailTemplates.index', compact('titles', 'email_templates', 'deleteRouteName' ));
    }

   
    public function edit($id)
    {
        $titles = ['title' => 'Manage Email Template', 'subTitle' => 'Edit Email Template', 'listTitle' => 'Email Template List'];
        if (!auth()->user()->can('email-template-update')) {
            return view('admin.abort', compact('titles'));
        }

        $emailTemplate = EmailTemplate::find($id);


        return view('admin.emailTemplates.edit', compact('titles', 'emailTemplate'));
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
        $blog->slug = unique_slug($request->name, 'Blog' , $blog->id);;
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
