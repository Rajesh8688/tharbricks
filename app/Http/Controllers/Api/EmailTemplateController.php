<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseApiController;

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
      
        $slug = unique_slug(Str::random(30), 'EmailTemplate');

        $emailTemplate->slug = $slug;
        $emailTemplate->template_key = $slug;
    
        $emailTemplate->save();

        $response['data'] = $emailTemplate;
        $response['status'] = true;
        $response['message'] = __('lang.email_template_added_successfully');
        return response($response, 200);

    }

    public function update(Request $request, $id){
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

        $emailTemplateid = $id;
        $emailTemplate = EmailTemplate::find($emailTemplateid);
        $emailTemplate->template = $request->input('template');
        $emailTemplate->subject = $request->input('subject');
        $emailTemplate->template_name = $request->input('template_name');
        $slug = unique_slug(Str::random(30), 'EmailTemplate' , $emailTemplateid);
        $emailTemplate->slug = $slug;
        $emailTemplate->template_key = $slug;
        $emailTemplate->save();
        $response['data'] = $emailTemplate;
        $response['status'] = true;
        $response['message'] = __('lang.email_template_updated_successfully');
        return response($response, 200);
    }

    public function destroy($id){
        $emailTemplateid = $id;
        $emailTemplate = EmailTemplate::find($emailTemplateid);
        $emailTemplate->update(['status' => 'InActive']);
        $response['data'] = [];
        $response['status'] = true;
        $response['message'] = __('lang.email_eemplate_deleted_successfully');
        return response($response, 200);
    }
}
