<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class WebLoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate form data
     
       
   
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string|min:8'
        ]);
       
        $remember = $request->has('remember') ? true : false; 
        // Attempt to login as web
       
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password,'status' => 'Active' ,'back_end_user' => 0], $remember)) {
       
            return redirect()->route('vendor-dashboard');
        }
        else{
            return redirect()->back()->withErrors(['email' => 'You entered an incorrect email or password'])->withInput();
        }

      

        // If unsuccessful then redirect back to login page with email and remember fields
        //return redirect()->back()->withInput($request->only('email', 'remember'));

    }
}
