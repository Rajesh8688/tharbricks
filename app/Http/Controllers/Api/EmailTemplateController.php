<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EmailTemplateController extends BaseApiController
{
    public function index()
    {
        $userId  = auth('api')->user()->id;
        $emailTemplates = EmailTemplate::where(['user_id' => $userId , 'module' => 'user' ,'status' => 'Active'])->get();

        $response['data'] = $emailTemplates;
        $response['status'] = true;
        $response['message'] = 'Email Templates';
        return response($response, 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'template' => 'required',
            'subject' => 'required',
            'template_name' => 'required'
        ]);
        if ($validator->fails()) {
            $errorMessages = $validator->messages()->all();
            return response()->json([
                'status' => false,
                "message" => $errorMessages[0]
            ], 200);
        }

        $userId  = auth('api')->user()->id;
        $emailTemplate = new EmailTemplate();
        $emailTemplate->user_id = $userId;
        $emailTemplate->module = 'user';
        $emailTemplate->template = $request->input('template');
        $emailTemplate->subject = $request->input('subject');
        $emailTemplate->template_name = $request->input('template_name');
        $slug = unique_slug($request->input('template_name'), 'EmailTemplate');
        $emailTemplate->template_slug = $slug;
        $emailTemplate->template_key = $slug;
    
        $emailTemplate->save();

        $response['data'] = $emailTemplate;
        $response['status'] = true;
        $response['message'] = 'Email Template added successfully';
        return response($response, 200);

    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'template' => 'required',
            'subject' => 'required',
            'id' => 'required',
            'template_name' => 'required'
        ]);
        if ($validator->fails()) {
            $errorMessages = $validator->messages()->all();
            return response()->json([
                'status' => false,
                "message" => $errorMessages[0]
            ], 200);
        }

        $emailTemplateid = $request->input('id');
        $emailTemplate = EmailTemplate::find($emailTemplateid);
        $emailTemplate->template = $request->input('template');
        $emailTemplate->subject = $request->input('subject');
        $emailTemplate->template_name = $request->input('template_name');
        $slug = unique_slug($request->input('template_name'), 'EmailTemplate' , $emailTemplateid);
        $emailTemplate->slug = $slug;
        $emailTemplate->template_key = $slug;
        $emailTemplate->save();
        $response['data'] = $emailTemplate;
        $response['status'] = true;
        $response['message'] = "Email Template updated successfully";
        return response($response, 200);
    }

    public function delete(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            $errorMessages = $validator->messages()->all();
            return response()->json([
                'status' => false,
                "message" => $errorMessages[0]
            ], 200);
        }
        $emailTemplateid = $request->input('id');
        $emailTemplate = EmailTemplate::find($emailTemplateid);
        $emailTemplate->update(['status' => 'Inactive']);
        $response['data'] = [];
        $response['status'] = true;
        $response['message'] = "Email Template deleted successfully";
        return response($response, 200);
    }
}
