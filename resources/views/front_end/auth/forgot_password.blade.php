@extends('front_end.layouts.master')
@section('content')
    <!-- Forgot Password Sign Up Modal -->
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="sf-custom-tabs sf-custom-new aon-logon-sign-area p-3">
                    <div class="">
                        <!--Forgot Password Form-->
                        <h2>Forgot Password</h2>
                        <label><b>Enter your Email and we’ll help you reset your password.</b></label>
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        <div id="LoginForm" class="tab-pane active">
                            <div class="sf-tabs-content">
                                <form id="forgotForm" class="form-border" method="post" action="{{route('user-forget.password.post')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                            
                                            <div class="form-group" style="margin-bottom:10px!important">
                                                <div class="aon-inputicon-box"> 
                                                    <input class="form-control sf-form-control" name="email" type="email" placeholder="Email" value={{ old('email') }}>
                                                    <i class="aon-input-icon fa fa-user"></i>
                                                </div>
                                                @error('email')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                              
                                     
                                        <div class="col-md-12">
                                            <button type="submit" class="site-button w-100">Continue <i class="feather-arrow-right"></i> </button>
                                        </div>                                          
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Sign Up Modal --> 
@endsection