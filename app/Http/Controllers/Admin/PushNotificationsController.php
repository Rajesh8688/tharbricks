<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class PushNotificationsController extends Controller
{
            /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titles = ['title' => 'Manage Notifications', 'subTitle' => 'Add Notifications', 'listTitle' => 'Notifications List'];
        $deleteRouteName = "notifications.destroy";

        if (!auth()->user()->can('notifications-view')) {
            return view('admin.abort', compact('titles'));
        }



        $notifications = Notification::with('user')->get();
    

        return view('admin.notifications.index', compact('titles', 'notifications', 'deleteRouteName'));
    }

      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $titles = [
            'title' => "Notifications",
            'subTitle' => "Add Notifications",
        ];
        if (!auth()->user()->can('notifications-add')) {
            return view('admin.abort',compact('titles'));
        }
    
        return view('admin.notifications.create', compact('titles'));
        
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
            'title' => 'required',
            'message' => 'required'
        ]);

        $data = array();
        
        $data['title'] = $request->title;
        $data['message'] = $request->message;
        $data['to_all'] = 1;
       
        Notification::create($data);
        sendNotificationFcm('/topics/general_updates', $request->title,$request->message);
        return redirect()->route('notifications.index')->with('success','Notifictions created Successfully');
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
    //     $titles = ['title' => 'Manage Blogs', 'subTitle' => 'Edit Blogs', 'listTitle' => 'Blogs List'];
    //     if (!auth()->user()->can('blogs-update')) {
    //         return view('admin.abort', compact('titles'));
    //     }

    //     $blog = Blog::find($id);
    //     $services = Service::get();

    //     return view('admin.blogs.edit', compact('titles', 'blog' ,'services'));
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
    //     if (!auth()->user()->can('blogs-update')) {
    //         return view('admin.abort');
    //     }

    //     $this->validate($request, [
    //         'name' => 'required',
    //         'description' => 'required',
    //         'status' => 'required',
    //         'image' => 'image|mimes:jpeg,png,jpg,svg,gif|max:2048',
    //         'service_id'=> 'required'
    //     ]); 

    //     $data = array();

    //     $blog = Blog::find($id);

    //     $blogImage = $request->file('image');

    //     if ($blogImage != NULL) {
    //         // Delete the previous image
    //         deleteImage(Blog::$imagePath, $blog->image);


    //         $newFileName = time() . $blogImage->getClientOriginalName();
    //         $originalPath = Blog::$imagePath;

    //         // Image Upload Process
    //         $thumbnailImage = Image::make($blogImage);
    //         //$thumbnailImage->save($originalPath . $newFileName);
    //         $thumbnailImage->save($originalPath . $newFileName);
    //         $blog->image = $newFileName;
    //     }

    //     $blog->name = $request->name;
    //     $blog->slug = unique_slug($request->name, 'Blog' , $blog->id);;
    //     $blog->status = $request->status;
    //     $blog->description = $request->description;
    //     $blog->service_id = $request->service_id;
    //     $blog->tags = $request->tags ?? Null;
    //     $blog->user_name = $request->user_name ?? Null;
    //     $blog->save();

    //     return redirect()->route('blogs.index')->with('success', 'Updated Successfully');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if (!auth()->user()->can('notifications-delete')) {
            return view('admin.abort');
        }
        $deleteId = $request->delete_id;
        $notifications = Notification::find($deleteId);
        $notifications->delete();
        return redirect()->route('notifications.index')->with('success', 'Deleted Successfully');
    }
}
