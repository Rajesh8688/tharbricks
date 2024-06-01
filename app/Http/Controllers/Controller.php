<?php

namespace App\Http\Controllers;

use App\Models\Sms;
use App\Models\Plan;
use App\Models\Role;
use Razorpay\Api\Api;
use App\Models\VendorDetails;
use App\Models\CreditTransactionLog;
use App\Models\RazorPayOrder;
use Illuminate\Support\Facades\Http;
use App\Models\RazorPayPaymentInvoice;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Exception;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // SMS Things
    public $smsClientUrl;
    public $smsApiUsername;
    public $smsApiPassword;
    public $smsApiSenderName;
    
    public function __construct()
    {
        $smsClientUrl = env('SMS_CLIENT_URL');
        $smsApiUsername = env('SMS_API_USER_NAME');
        $smsApiPassword = env('SMS_API_PASSWORD');
        $smsApiSenderName = env('SMS_API_SENDER_NAME');
    }

    public function detachRole($user)
    {
        // Grab all the Roles and detach first
        $allRoles = Role::all();
        $user->roles()->detach($allRoles);
        return true;
    }

    public function sendSms($smsContent, $numbers, $type = 'otp',$userId= null)
    {
        $res = [];
        $value = 0;

        $sendSmsUrl = $this->smsClientUrl . 'send/';

        if (!empty($numbers) && !empty($smsContent)) {

            $postValue = [
                'username' => $this->smsApiUsername,
                'password' => $this->smsApiPassword,
                'sender' => $this->smsApiSenderName,
                'mobile' => $numbers,
                'lang' => 1,
                'message' => $smsContent,
            ];

            $sms = new Sms();
            $sms->phone = $numbers;
            $sms->message = $smsContent;
            $sms->user_id = $userId ?? null;
            $sms->delivery_status = 0 ;
            $sms->save();

            $response = Http::get($sendSmsUrl, $postValue);
            $status = $response->status();

            if ($status == 200) {
                $value = 1;
                $sms->delivery_status = 1;
            }
        }
        $res['status'] = $status;
        $res['value'] = $value;

        return $res;
    }


    public function checkPaymentAndUpdate($data){

        $orderId = $data['order_id'] ?? null ;
        $razorPayPaymentId = $data['razorpay_payment_id'] ?? null ;
        $userId = $data['userId'];
        $from = $data['from'] ?? 'web';

        $api = new Api(env('RAZOR_PAY_KEY'), env('RAZOR_PAY_SECRET_KEY'));
        $payment = $api->payment->fetch($razorPayPaymentId);
  
       
        if(!empty($razorPayPaymentId)) {
             try {
                $updateCredits =false;
                
                if($payment['status'] == 'authorized'){
                    if($from == "web"){
                        $response = $api->payment->fetch($razorPayPaymentId)->capture(array('amount'=>$payment['amount']));
                        $updateCredits =true;
                    }
                } elseif($payment['status'] == 'pending'){
                    return ['status' => false , 'error' =>'Payment is in Pending'];
                }elseif($payment['status'] == 'created'){
                    return ['status' => false , 'error' =>'Payment Not Done'];
                }elseif($payment['status'] == 'failed'){
                    return ['status' => false , 'error' =>$payment['error_description']];
                }elseif($payment['status'] == 'captured'){
                    if($from == "mobile"){
                        $response = $api->payment->fetch($razorPayPaymentId);
                        $updateCredits =true;
                    }else{
                        return ['status' => false , 'error' =>'Already Payment Captured'];
                    }
                }
                if($updateCredits == true){
                    $razorPayInvoice = new RazorPayPaymentInvoice();
                    $razorPayInvoice->razorpay_payment_id = $razorPayPaymentId;
                    $razorPayInvoice->save();
                    $razorPayInvoice->invoice_id = 'TI'.str_pad($razorPayInvoice->id, 8, '0', STR_PAD_LEFT);
                    $razorPayInvoice->save();
                    $razorPayInvoice->amount = $response['amount'];
                    $razorPayInvoice->razorpay_status = $response['status'];
                    $razorPayInvoice->method = $response['method'];
                    $razorPayInvoice->email = $response['email'];
                    $razorPayInvoice->contact = $response['contact'];
                    $razorPayInvoice->info = $response['description'];
                    $razorPayInvoice->acquirer_data = json_encode($response['acquirer_data']);
                    $razorPayInvoice->upi =  isset($response['upi']) ? json_encode($response['upi']) : null;
                    $razorPayInvoice->card_id = isset($response['card_id']) ? json_encode($response['card_id']) : null;
                    $razorPayInvoice->notes = isset($response['notes']) ? json_encode($response['notes']) : null;
                    $razorPayInvoice->save();

                    if(isset($response['description']) && !empty($response['description'])){
                        $planId = $response['description'];
                    }else{
                        $razorpayOrderDetails =  RazorPayOrder::where('order_id' , $response['order_id'])->first();
                        if(!empty($razorpayOrderDetails)){
                            $planId = $razorpayOrderDetails->plan_id;
                        }
                    }

                    $planDetails = Plan::find($planId);
                    $vendorDetails = VendorDetails::where('user_id' , $userId)->first();
    
                    //credit logs
                    $creditLogs = new CreditTransactionLog();
                    //DB::enableQueryLog();
    
                    // and then you can get query log
                    $creditLogs->user_id = $userId;
                    $creditLogs->credits = $planDetails->no_of_credits;
                    $creditLogs->remaining_credits = $planDetails->no_of_credits+$vendorDetails->credits;
                    $creditLogs->action = "added";
                    $creditLogs->credits_description = $planDetails->no_of_credits." credits added through Razorpay #".$razorPayPaymentId;
                    $creditLogs->razorpay_payment_id = $razorPayPaymentId;
                    $creditLogs->razor_pay_payment_invoice_id = $razorPayInvoice->id;
                    $creditLogs->date_of_transaction = now();
                    $creditLogs->save();
                    $creditLogs->unique_id = 'CT'.str_pad($creditLogs->id, 8, '0', STR_PAD_LEFT);
                    $creditLogs->save();
                    $vendorDetails->credits = $planDetails->no_of_credits+$vendorDetails->credits;
                    $vendorDetails->save();

                    return ['status' => true , 'success' =>'payment Successfull '.$planDetails->no_of_credits.' credits added ' ,'data' =>$razorPayInvoice];
                }
               
          
                // and then you can get query log 
               

                // if( $response['status']!= 'failed'){
                    
                // }else{
                //     // $razorPayInvoice->error_code = ($response['error_code']);
                //     // $razorPayInvoice->error_description = ($response['error_description']);
                //     // $razorPayInvoice->error_source = ($response['error_source']);
                //     // $razorPayInvoice->error_step = ($response['error_step']);
                //     // $razorPayInvoice->error_reason = $response['error_reason'];
                //     // $razorPayInvoice->save();
                //     return ['status' => false , 'error' =>$response['error_description']];
                //     //return redirect()->route('my-credits')->with('error',$response['error_description']);
                // }
            } catch (Exception $e) {
                return ['status' => false , 'error' =>$e->getMessage()];
                //return redirect()->route('my-credits')->with('error',$e->getMessage());
            }
        }
        //return ['status' => true , 'success' =>'payment Successfull '.$planDetails->no_of_credits.' credits added ' ,'data' =>$razorPayInvoice];
        //return redirect()->route('my-credits')->with('success','payment Successfull '.$planDetails->no_of_credits.' credits added ');
    }
}
