<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserRequest;
use Illuminate\Http\Request;

class UserRequestController extends Controller
{
    public function index()
    {
        $titles = ['title' => 'Manage User Requests', 'subTitle' => '', 'listTitle' => 'User Requests List'];
        $deleteRouteName = "userRequest.destroy";

        if (!auth()->user()->can('user-request-view')) {
            return view('admin.abort', compact('titles'));
        }

        $userRequests = UserRequest::get();


        return view('admin.user_request.index', compact('titles', 'userRequests', 'deleteRouteName'));
    }

    public function destroy($id, Request $request)
    {
        if (!auth()->user()->can('user-request-delete')) {
            return view('admin.abort');
        }
        $deleteId = $request->delete_id;
        $userRequest = UserRequest::find($deleteId);

        if ($deleteId) {

            $userRequest->delete();

            return redirect()->route('user_request.index')->with('success', 'Deleted Successfully');
        }
    }

    public function show($id)
    {
        if (!auth()->user()->can('user-request-view')) {
            return view('admin.abort');
        }
        $titles = ['title' => 'Manage User Requests', 'subTitle' => 'View User Requests'];

        $showUserRequest = UserRequest::find($id);

        return view('admin.user_request.edit', compact('titles', 'showUserRequest'));
    }
}
