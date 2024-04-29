@extends('front_end.vendor.layouts.master')
@section('content')
   <!-- Change Password Modal -->
   <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
            <div class="sf-custom-tabs sf-custom-new aon-logon-sign-area p-3">
                <div class="">
                    <!--Forgot Password Form-->
                    <h2>Change Password</h2>
                   
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div id="LoginForm" class="tab-pane active">
                        <div class="sf-tabs-content">
                            <form id="changePassword" method="post" action="{{ route('updatePassword') }}">
                                @csrf
                                <div class="row">
                                  <div class="col-md-12" style="margin-bottom:10px!important">
                                    <label class="form-label" for="newPassword">Existing Password</label>
                                    <input type="password" class="form-control @error('current-password') is-invalid @enderror" data-bv-field="existingpassword" id="newPassword" required placeholder="Existing Password" name="current-password">
                                    @error('current-password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                    <div class="col-md-12" style="margin-bottom:10px!important">
                                        <label class="form-label" for="newPassword">New Password</label>
                                        <input type="password" class="form-control @error('new-password') is-invalid @enderror" data-bv-field="newpassword" id="newPassword" required placeholder="New Password" name="new-password">
                                        @error('new-password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12" style="margin-bottom:10px!important">
                                        <label class="form-label" for="existingPassword">Confirm Password</label>
                                        <input type="password" class="form-control @error('new-password_confirmation') is-invalid @enderror" data-bv-field="confirmgpassword" id="confirmPassword" required placeholder="Confirm Password" name ="new-password_confirmation">
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