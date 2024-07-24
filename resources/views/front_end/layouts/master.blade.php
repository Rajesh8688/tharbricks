<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>

	<!-- META -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="{{ isset($titles['keywords']) && !empty($titles['keywords']) ? $titles['keywords'] : 'TharBricks,Service Provider' }}" />
    <meta name="author" content="Creative Solutions" />
    <meta name="robots" content="" />    
    <meta name="description" content="{{ isset($titles['description']) && !empty($titles['description']) ? $titles['description'] : 'TharBricks | Service Provider' }}" />

    
    <!-- FAVICONS ICON -->
    <link rel="icon" href="{{asset('frontEnd/images/transperent-favion.png')}}" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontEnd/images/transperent-favion.png')}}" />
    
    <!-- PAGE TITLE HERE -->
    <title>{{ env('APP_NAME') }} - {{ isset($titles['title']) && !empty($titles['title']) ? $titles['title'] : '' }}</title>
    
    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <!-- BOOTSTRAP STYLE SHEET -->

    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/bootstrap.min.css')}}">
    <!-- Bootstrap toggle -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/bootstrap4-toggle.min.css')}}">
    <!-- Bootstrap seclect -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/bootstrap-select.min.css')}}"> 
    <!-- Price Range Slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/bootstrap-slider.min.css')}}">
    <!-- Bootstrap data table -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/dataTables.bootstrap4.min.css')}}">
    <!-- Dropzone -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/dropzone.css')}}">
    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/font.css')}}">    
    <!-- Feather icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/feather.css')}}">  
    <!-- Fontawesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/font-awesome.min.css')}}">
    <!-- Lc light box popup -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/lc_lightbox.css')}}">     
    <!-- Magnific Popup -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/magnific-popup.min.css')}}">
    <!-- Custom Scrollbar -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/m-custom-scrollbar.min.css')}}">
    <!-- Owl Carousel -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/owl.carousel.min.css')}}">
    <!-- Slick Carousel -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/slick.min.css')}}">
    <!-- Slick Theme -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/slick-theme.css')}}">  
    <!-- Main STyle Sheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/style.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('extrastyle')

    <style>
        .aon-admin-messange:hover { background-color:#fff;!important }
    </style>

</head>

<body>
   
    <!-- LOADING AREA START ===== -->
    <div class="loading-area">
        <div class="loading-box"></div>
        <div class="loading-pic">
            <div class="windows8">
                <div class="wBall" id="wBall_1">
                    <div class="wInnerBall"></div>
                </div>
                <div class="wBall" id="wBall_2">
                    <div class="wInnerBall"></div>
                </div>
                <div class="wBall" id="wBall_3">
                    <div class="wInnerBall"></div>
                </div>
                <div class="wBall" id="wBall_4">
                    <div class="wInnerBall"></div>
                </div>
                <div class="wBall" id="wBall_5">
                    <div class="wInnerBall"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- LOADING AREA  END ====== -->
	<div class="page-wraper">  
        
        @include('front_end.layouts.header')

        @yield('content')

        @include('front_end.layouts.footer')
        
        <!-- BUTTON TOP START -->
		<button class="scroltop"><span class="fa fa-angle-up  relative" id="btn-vibrate"></span></button>

 	</div>



    <!-- Login Sign Up Modal -->
    {{-- <div class="modal fade" id="login-signup-model">
      <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close aon-login-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="modal-body">

                <div class="sf-custom-tabs sf-custom-new aon-logon-sign-area p-3">

                    <!--Tabs-->
                    <ul class="nav nav-tabs nav-table-cell">
                        <li><a data-toggle="tab" href="#LoginForm" class="active">Login</a></li>
                        <li><a data-toggle="tab" href="#SignUpForm">Sign up</a></li>
                    </ul>
                    <!--Tabs Content--> 
                    <div class="tab-content">

                        <!--Login Form-->
                        <div id="LoginForm" class="tab-pane active">
                            <div class="sf-tabs-content">
                                <form class="aon-login-form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="aon-inputicon-box"> 
                                                    <input class="form-control sf-form-control" name="company_name" type="text" placeholder="User Name">
                                                    <i class="aon-input-icon fa fa-user"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="aon-inputicon-box"> 
                                                    <input class="form-control sf-form-control" name="company_name" type="password" placeholder="Password">
                                                    <i class="aon-input-icon fa fa-lock"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group d-flex aon-login-option justify-content-between">
                                                <div class="aon-login-opleft">
                                                     <div class="checkbox sf-radio-checkbox">
                                                        <input id="td2_2" name="abc" value="five" type="checkbox">
                                                        <label for="td2_2">Keep me logged</label>
                                                    </div>  
                                                </div>
                                                <div class="aon-login-opright">
                                                    <a href="#">Forget Password</a>
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="col-md-12">
                                            <button type="submit" class="site-button w-100">Submit <i class="feather-arrow-right"></i> </button>
                                        </div>                                          
                                        
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!--Sign up Form-->
                        <div id="SignUpForm" class="tab-pane">
                            <div class="sf-tabs-content">
                                <form class="aon-login-form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="aon-inputicon-box"> 
                                                    <input class="form-control sf-form-control" name="First_Name" type="text" placeholder="First Name">
                                                    <i class="aon-input-icon fa fa-user"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="aon-inputicon-box"> 
                                                    <input class="form-control sf-form-control" name="company_name" type="password" placeholder="Last Name">
                                                    <i class="aon-input-icon fa fa-user"></i>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="aon-inputicon-box"> 
                                                    <input class="form-control sf-form-control" name="Phone" type="password" placeholder="Phone">
                                                    <i class="aon-input-icon fa fa-phone"></i>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="aon-inputicon-box"> 
                                                    <input class="form-control sf-form-control" name="email" type="password" placeholder="Email">
                                                    <i class="aon-input-icon fa fa-envelope-o"></i>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="aon-inputicon-box"> 
                                                    <input class="form-control sf-form-control" name="password" type="password" placeholder="Password">
                                                    <i class="aon-input-icon fa fa-lock"></i>
                                                </div>
                                            </div>
                                        </div>
                                        
                                         <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="aon-inputicon-box"> 
                                                    <input class="form-control sf-form-control" name="password" type="password" placeholder="Confirm Password">
                                                    <i class="aon-input-icon fa fa-lock"></i>
                                                </div>
                                            </div>
                                        </div>                                        
                                        
                                        <div class="col-md-12">
                                            <div class="form-group sign-term-con">
                                                <div class="checkbox sf-radio-checkbox">
                                                    <input id="td33" name="abc" value="five" type="checkbox">
                                                    <label for="td33">I've read and agree with your <a href="#">Privacy Policy</a> and <a href="#">Terms & Conditions</a> </label>
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="col-md-12">
                                            <button type="submit" class="site-button w-100">Submit <i class="feather-arrow-right"></i> </button>
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
    </div> --}}
    <!-- Login Sign Up Modal --> 
    
<!-- JAVASCRIPT  FILES ========================================= --> 
<script  src="{{ asset('frontEnd/js/jquery-3.6.0.min.js')}}"></script><!-- JQUERY.MIN JS -->
<script  src="{{ asset('frontEnd/js/popper.min.js')}}"></script><!-- POPPER.MIN JS -->
<script  src="{{ asset('frontEnd/js/bootstrap.min.js')}}"></script><!-- BOOTSTRAP.MIN JS -->
<script  src="{{ asset('frontEnd/js/bootstrap-select.min.js')}}"></script><!-- BOOTSTRAP SELECT -->    
<script  src="{{ asset('frontEnd/js/jquery.bootstrap-touchspin.js')}}"></script><!-- FORM JS -->
<script  src="{{ asset('frontEnd/js/magnific-popup.min.js')}}"></script><!-- MAGNIFIC-POPUP JS -->
<script  src="{{ asset('frontEnd/js/waypoints.min.js')}}"></script><!-- WAYPOINTS JS -->
<script  src="{{ asset('frontEnd/js/counterup.min.js')}}"></script><!-- COUNTERUP JS -->
<script  src="{{ asset('frontEnd/js/waypoints-sticky.min.js')}}"></script><!-- STICKY HEADER -->
<script  src="{{ asset('frontEnd/js/isotope.pkgd.min.js')}}"></script><!-- MASONRY  -->
    
<script  src="{{ asset('frontEnd/js/owl.carousel.min.js')}}"></script><!-- OWL  SLIDER  -->
<script  src="{{ asset('frontEnd/js/slick.min.js')}}"></script><!-- OWL  SLIDER  -->
    
<script  src="{{ asset('frontEnd/js/theia-sticky-sidebar.js')}}"></script><!-- STICKY SIDEBAR  -->
<script src="{{ asset('frontEnd/js/m-custom-scrollbar.min.js')}}"></script><!-- my account left panel scroller -->
<script src="{{ asset('frontEnd/js/dropzone.js')}}"></script><!-- Images upload -->  

<script src="{{ asset('frontEnd/js/bootstrap4-toggle.min.js')}}"></script>
<script src="{{ asset('frontEnd/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('frontEnd/js/dataTables.bootstrap4.min.js')}}"></script>

<script  src="{{ asset('frontEnd/js/custom.js')}}"></script><!-- CUSTOM FUCTIONS  -->
<script src="{{ asset('frontEnd/js/lc_lightbox.lite.js')}}"></script><!-- IMAGE POPUP -->
<script  src="{{ asset('frontEnd/js/bootstrap-slider.min.js')}}"></script><!-- Form js -->

<script>
     
    $(document).ready(function() {
    $('#emailLetter').submit(function(event) {
        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: '{{ route('subscribe') }}',
            data: formData,
            success: function(response) {
                // Handle success
                console.log(response);
                let successMessage = response.message;
                Swal.fire({
                title: "Success",
                text: successMessage,
                type: "success",
                confirmButtonClass: 'site-button',
                buttonsStyling: false,
            });
            $('#emailLetter')[0].reset();
            },
         
            error: function(xhr, status, error) {
            if (xhr.status === 422) {
                // Handle validation errors
                let errors = $.parseJSON(xhr.responseText);
                let errorMes = errors.errors.email;
                Swal.fire({
                    title: "Error!",
                    text: errorMes,
                    type: "error",
                    confirmButtonClass: 'site-button',
                    buttonsStyling: false,
                });
                // Display errors to the user
            } else {
                // Handle other errors
                Swal.fire({
                    title: "Error!",
                    text: error,
                    type: "error",
                    confirmButtonClass: 'site-button',
                    buttonsStyling: false,
                });
            }
        }
        });
    });
});
</script>



@yield('extraScripts')

</body>

</html>
