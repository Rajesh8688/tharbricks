@extends('front_end.layouts.master')
@section('content')
    <!-- Login Sign Up Modal -->
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="sf-custom-tabs sf-custom-new aon-logon-sign-area p-3">
                    <div class="">
                        <!--Login Form-->
                        <h1>Login</h1>
                        <div id="LoginForm" class="tab-pane active">
                            <div class="sf-tabs-content">
                                <form class="aon-login-form"  method="post" action ="{{ route('vendor-login') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label><b>Email</b></label>
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
                                            <label><b>Password</b></label>
                                            <div class="form-group">
                                                <div class="aon-inputicon-box"> 
                                                    <input class="form-control sf-form-control" name="password" type="password" placeholder="Password">
                                                    <i class="aon-input-icon fa fa-lock"></i>
                                                </div>
                                                @error('password')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group d-flex aon-login-option justify-content-between">
                                                <div class="aon-login-opleft">
                                                  
                                                    <div class="checkbox sf-radio-checkbox">
                                                        <input id="td2_2" name="remember" value="1" type="checkbox"  {{ old('remember') ? 'checked' : '' }}>
                                                        <label for="td2_2">Keep me logged</label>
                                                    </div>
                                                </div>
                                                <div class="aon-login-opright">
                                                    <a href="{{route('user-forget.password.get')}}">Forget Password</a>
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="col-md-12">
                                            <button type="submit" class="site-button w-100">Login <i class="feather-arrow-right"></i> </button>
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