@extends('front_end.layouts.master')
@section('content')
  <!-- Login Sign Up Modal -->
  <div style="text-align:center;padding: 15px 0px ">
    <h3>{{__('lang.some_details_about_you')}}</h3>
    <p>{{__('lang.youre_just_a_few_steps_away_from_viewing_our_graphic_design_leads')}}</p>
</div>
  <div class="card aon-card" id="aon-contact-panel" style="max-width: 900px;margin-left: auto;margin-right: auto;">
    {{-- <div class="card-header aon-card-header"><h4><i class="fa fa-envelope"></i> Contact Detail</h4></div> --}}
    
    <div class="card-body aon-card-body">
        <form method ="POST" action="{{route('vendor-store')}}" autocomplete="off">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{__('lang.your_name')}}</label>
                        <div class="aon-inputicon-box"> 
                            <input class="form-control sf-form-control  @error('name') is-invalid @enderror" name="name" type="text" required value="{{old('name')}}">
                            <i class="aon-input-icon fa fa-user"></i>
                        </div>
                        @error('name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{__('lang.company_name')}}</label>
                        <div class="aon-inputicon-box"> 
                            <input class="form-control sf-form-control" name="company_name" type="text" value="{{old('company_name')}}">
                            <i class="aon-input-icon fa fa-building"></i>
                        </div>
                        <span>{{__('lang.If_you_arent_a_business_or_dont_have_this_information_you_can_leave_this_blank')}}</span>
                    </div>
                
                </div>

                
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{__('lang.company_size')}}</label>
                        <div class="aon-inputicon-box"> 
                            <div class="radio-inline-box sf-radio-check-row">
                                <div class="checkbox sf-radio-checkbox sf-radio-check-2 sf-raChe-6 " style="width: calc(50% - 200px)" >
                                    <input id="any111" name="company_size" value="1" type="radio" {{ old('company_size') == '1' ? 'checked' : '' }} required class="@error('company_size') is-invalid @enderror" checked>
                                    <label for="any111">{{__('lang.selfemployed_soletrader')}}</label>
                                </div>
                                <div class="checkbox sf-radio-checkbox sf-radio-check-2 sf-raChe-6 " style="width: calc(50% - 200px)" >
                                    <input id="body111" name="company_size" value="2" type="radio" {{ old('company_size') == '2' ? 'checked' : '' }} required class="@error('company_size') is-invalid @enderror">
                                    <label for="body111">2-10</label>
                                </div>
                                <div class="checkbox sf-radio-checkbox sf-radio-check-2 sf-raChe-6 " style="width: calc(50% - 200px)" >
                                    <input id="body3" name="company_size" value="3" type="radio" {{ old('company_size') == '3' ? 'checked' : '' }} required class="@error('company_size') is-invalid @enderror">
                                    <label for="body3">11-50</label>
                                </div>
                                <div class="checkbox sf-radio-checkbox sf-radio-check-2 sf-raChe-6 " style="width: calc(50% - 200px)" >
                                    <input id="body4" name="company_size" value="4" type="radio" {{ old('company_size') == '4' ? 'checked' : '' }} required class="@error('company_size') is-invalid @enderror">
                                    <label for="body4">51-200</label>
                                </div>
                                <div class="checkbox sf-radio-checkbox sf-radio-check-2 sf-raChe-6 " style="width: calc(50% - 200px)" >
                                    <input id="body5" name="company_size" value="5" type="radio" {{ old('company_size') == '5' ? 'checked' : '' }} required class="@error('company_size') is-invalid @enderror">
                                    <label for="body5">200+</label>
                                </div>

                                @error('company_size')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                        </div>
                    </div>
                </div>
                <input type="hidden" name ="servicesSlug" value = {{$servicesSlug}}>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{__('lang.where_would_you_like_to_see_leads_from')}}</label>
                        <div class="aon-inputicon-box"> 
                            <div class="radio-inline-box sf-radio-check-row">
                                <div class="checkbox sf-radio-checkbox sf-radio-check-2 sf-raChe-6 @error('see_leads_from') is-invalid @enderror" required >
                                    <input id="nationwide11" name="see_leads_from" value="nationwide" type="radio" checked {{ old('see_leads_from') == 'nationwide' ? 'checked' : '' }}>
                                    <label for="nationwide11">{{__('lang.i_serve_customers_nationwide')}}</label>
                                </div>
                                <div class="checkbox sf-radio-checkbox sf-radio-check-2 sf-raChe-6 @error('see_leads_from') is-invalid @enderror" required {{ old('see_leads_from') == 'custom' ? 'checked' : '' }}>
                                    <input id="custom11" name="see_leads_from" value="custom" type="radio">
                                    <label for="custom11">{{__('lang.i_serve_customers_within')}}</label>
                                </div>
                                @error('see_leads_from')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror  @error('see_leads_from')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class ="col-12" style= "display: none" id ="customleads">
                    <div class="row">
                        <div class="col-md-5"> 
                            <div class="form-group">
                                <select class="form-control sf-form-control @error('serve_customer_with_in') is-invalid @enderror" name="serve_customer_with_in" title="" id = "serve_customer_with_in">
                                    <option value="1" {{ old('serve_customer_with_in') == '1' ? 'selected' : '' }}>1 mile</option>
                                    <option value="2" {{ old('serve_customer_with_in') == '2' ? 'selected' : '' }}>2 miles</option>
                                    <option value="5" {{ old('serve_customer_with_in') == '5' ? 'selected' : '' }}>5 miles</option>
                                    <option value="10" {{ old('serve_customer_with_in') == '10' ? 'selected' : '' }}>10 miles</option>
                                    <option value="15" {{ old('serve_customer_with_in') == '15' ? 'selected' : '' }}>15 miles</option>
                                    <option value="20" {{ old('serve_customer_with_in') == '20' ? 'selected' : '' }}>20 miles</option>
                                    <option value="30" {{ old('serve_customer_with_in') == '30' ? 'selected' : '' }}>30 miles</option>
                                    <option value="40" {{ old('serve_customer_with_in') == '40' ? 'selected' : '' }}>40 miles</option>
                                    <option value="50" {{ old('serve_customer_with_in') == '50' ? 'selected' : '' }}>50 miles</option>
                                </select>
                                @error('serve_customer_with_in')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2 pt-2 pl-5">
                            <p>{{__('lang.from')}}</p>
                        </div> 
                        <div class="col-md-5"> 
                            <div class="form-group">
                                <div class="aon-inputicon-box"> 
                                    <input class="form-control sf-form-control @error('pin_code') is-invalid @enderror" name="pin_code" type="text" placeholder="Enter your postcode" id = "pin_code" value="{{ old('pin_code')}}">
                                    <i class="aon-input-icon fa fa-map-marker"></i>
                                    @error('pin_code')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{__('lang.email_address')}}</label>
                        <div class="aon-inputicon-box"> 
                            <input class="form-control sf-form-control  @error('email') is-invalid @enderror" name="email" type="email" required value="{{ old('email')}}">
                            <i class="aon-input-icon fa fa-envelope"></i>
                        </div>
                        @error('email')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label> {{__('lang.website_optional')}}</label>
                        <div class="aon-inputicon-box"> 
                            <input class="form-control sf-form-control" name="website" type="text" value="{{ old('website')}}">
                            <i class="aon-input-icon fa fa-globe"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{__('lang.phone_number')}}</label>
                        <div class="aon-inputicon-box"> 
                            <input class="form-control sf-form-control" name="mobile" type="number" pattern="[0-9]{10}" required value="{{ old('mobile')}}">
                            <i class="aon-input-icon fa fa-phone"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{__('lang.password')}}</label>
                        <div class="aon-inputicon-box"> 
                            <input class="form-control sf-form-control" name="password" type="password"  required value="{{ old('password')}}"  id ="password" autocomplete="new-password">
                            <i class="aon-input-icon fa fa-lock " ></i>
                            <i class="aon-input-icon-right fa fa-eye-slash " id = "toggle-password"></i>
                        </div>
                        @error('password')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{__('lang.confirm_password')}}</label>
                        <div class="aon-inputicon-box" > 
                            <input class="form-control sf-form-control" name="password_confirmation" type="password"  required value="{{ old('password_confirmation')}}" id ="password_confirmation">
                            <i class="aon-input-icon fa fa-lock " ></i>
                            <i class="aon-input-icon-right fa fa-eye-slash " id = "toggle-password-confirmation"></i>
                        </div>
                        
                        @error('password_confirmation')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        
                        @enderror
                    </div>
                </div>
            
            
                
            </div>
            <div class="center" style="display: flex;justify-content: center;"><button type="submit" class="site-button aon-btn-login">{{__('lang.next')}}</button></div>
        </form>    
    </div>
</div>  
<!-- Login Sign Up Modal --> 

@endsection
@section('extraScripts')
<script>
         $(document).ready(function () {
            $('input[name="see_leads_from"]').on('change', function () {
                var selectedValue = $('input[name="see_leads_from"]:checked').val();
                if (selectedValue === 'nationwide') {
                    $('#customleads').css("display" , "none");
                    $('#serve_customer_with_in').prop('required', false);
                    $('#pin_code').prop('required', false);
                } else if (selectedValue === 'custom') {
                    $('#customleads').css("display" , "block");
                    $('#serve_customer_with_in').prop('required', true);
                    $('#pin_code').prop('required', true);
                }
            });
            $('#toggle-password-confirmation').click(function () {
                var passwordInput = $('#password_confirmation');

                // Toggle the type attribute
                var passwordFieldType = passwordInput.attr('type');
                passwordInput.attr('type', passwordFieldType === 'password' ? 'text' : 'password');

                // Toggle the eye icon class
                $(this).toggleClass('fa-eye fa-eye-slash');
            });
            $('#toggle-password').click(function () {
                var passwordInput = $('#password');

                // Toggle the type attribute
                var passwordFieldType = passwordInput.attr('type');
                passwordInput.attr('type', passwordFieldType === 'password' ? 'text' : 'password');

                // Toggle the eye icon class
                $(this).toggleClass('fa-eye fa-eye-slash');
            });
        });
       
    </script>
@endsection