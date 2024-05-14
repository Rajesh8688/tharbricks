<?php
  
namespace App\Http\Controllers;

use Exception;
use App\Models\Plan;
use Razorpay\Api\Api;
use App\Models\Payments;
use Illuminate\Http\Request;
use App\Models\VendorDetails;
use Illuminate\Support\Facades\DB;
use App\Models\CreditTransactionLog;
use App\Models\RazorPayPaymentInvoice;
use Illuminate\Support\Facades\Session;
  
class RazorpayPaymentController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
      
        $input = $request->all();
  
        $api = new Api(env('RAZOR_PAY_KEY'), env('RAZOR_PAY_SECRET_KEY'));

  
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        $payments = new RazorPayPaymentInvoice();

        $payments->razorpay_payment_id = $input['razorpay_payment_id'];
        $payments->save();
        $payments->invoice_id = 'TI'.str_pad($payments->id, 8, '0', STR_PAD_LEFT);
        $payments->save();
  
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
             try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
                // and then you can get query log

                if( $response['status']!= 'failed'){
                    $payments->amount = $response['amount'];
                    $payments->razorpay_status = $response['status'];
                    $payments->method = $response['method'];
                    $payments->email = $response['email'];
                    $payments->contact = $response['contact'];
                    $payments->info = $response['description'];
                    $payments->acquirer_data = json_encode($response['acquirer_data']);
                    $payments->upi =  isset($response['upi']) ? json_encode($response['upi']) : null;
                    $payments->card_id = isset($response['card_id']) ? json_encode($response['card_id']) : null;
                    $payments->notes = isset($response['notes']) ? json_encode($response['notes']) : null;
                    $payments->save();
                    $userId = auth('web')->user()->id;
                    $planId = $response['description'];
    
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
                    $creditLogs->credits_description = $planDetails->no_of_credits." credits added ";
                    $creditLogs->razorpay_payment_id = $payments->id;
                    $creditLogs->date_of_transaction = now();
                    $creditLogs->save();
                    $creditLogs->unique_id = 'CT'.str_pad($creditLogs->id, 8, '0', STR_PAD_LEFT);
                    $creditLogs->save();

    
                    // dd(DB::getQueryLog());
                    $vendorDetails->credits = $planDetails->no_of_credits+$vendorDetails->credits;
                    $vendorDetails->save();

                }else{
                    $payments->error_code = ($response['error_code']);
                    $payments->error_description = ($response['error_description']);
                    $payments->error_source = ($response['error_source']);
                    $payments->error_step = ($response['error_step']);
                    $payments->error_reason = $response['error_reason'];
                    $payments->save();
                    return redirect()->route('my-credits')->with('error',$response['error_description']);
                }
            } catch (Exception $e) {
                return redirect()->route('my-credits')->with('error',$e->getMessage());
            }
        }
        return redirect()->route('my-credits')->with('success','payment Successfull '.$planDetails->no_of_credits.' credits added ');
      
    }
}