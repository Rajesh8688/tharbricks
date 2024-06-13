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
    {{-- <link rel="icon" href="{{asset('frontEnd/images/favicon_io/favicon32.png')}}" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontEnd/images/favicon_io/favicon32.png')}}" /> --}}

    <link rel="icon" href="{{asset('frontEnd/images/transperent-favion.png')}}" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontEnd/images/transperent-favion.png')}}" />
    
    <!-- PAGE TITLE HERE -->
    <title>{{ env('APP_NAME') }} - {{ isset($titles['title']) && !empty($titles['title']) ? $titles['title'] : '' }}</title>
    
    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    
    <!-- BOOTSTRAP STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/bootstrap.min.css')}}">
    <!-- Bootstrap toggle -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/bootstrap4-toggle.min.css')}}">
    <!-- Bootstrap seclect -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/bootstrap-select.min.css')}}" /> 
    <!-- Price Range Slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/bootstrap-slider.min.css')}}" />
    <!-- Bootstrap data table -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/dataTables.bootstrap4.min.css')}}">
    <!-- Dropzone -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/dropzone.css')}}">
    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/font.css')}}" />    
    <!-- Feather icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/feather.css')}}" />  
    <!-- Fontawesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/font-awesome.min.css')}}" />
    <!-- Lc light box popup -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/lc_lightbox.css')}}" />     
    <!-- Magnific Popup -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/magnific-popup.min.css')}}">
    <!-- Custom Scrollbar -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/m-custom-scrollbar.min.css')}}" />
    <!-- Owl Carousel -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/owl.carousel.min.css')}}">
    <!-- Slick Carousel -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/slick.min.css')}}">
    <!-- Slick Theme -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/slick-theme.css')}}">  
    <!-- Main STyle Sheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-assets/css/plugins/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-assets/vendors/css/extensions/toastr.css')}}">
    <style>
        #loader-container {
            position: relative;
        }

        #loader {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }

        #loader:before {
            content: "";
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
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

        @include('front_end/vendor/layouts/header')
    
                
        <!-- Page Content Holder -->
        <div id="content" class="active">

            @yield('content')

            
            
    	</div>

    </div>   
   
 
  
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
    
<!-- DevExtreme library -->
{{-- <script src="https://cdn3.devexpress.com/jslib/21.2.3/js/dx.all.js"></script> --}}

<script  src="{{ asset('frontEnd/js/custom.js')}}"></script><!-- CUSTOM FUCTIONS  -->
<script src="{{ asset('frontEnd/js/lc_lightbox.lite.js')}}"></script><!-- IMAGE POPUP -->
<script  src="{{ asset('frontEnd/js/bootstrap-slider.min.js')}}"></script><!-- Form js -->
<script src="{{asset('admin-assets/vendors/js/extensions/toastr.min.js')}}"></script>

@yield('extraScripts')
    
<script>
// jQuery(() => {
//   const source = new DevExpress.data.DataSource({
//     load() {
//       return $.getJSON('https://js.devexpress.com/Demos/WidgetsGallery/JSDemos/data/monthWeather.json');
//     },
//     loadMode: 'raw',
//     filter: ['t', '>', '2'],
//     paginate: false,
//   });

//   const palette = ['#022279', '#a2b5e7', '#ffb600'];
//   let paletteIndex = 0;

//   jQuery('#chart').dxChart({
//     dataSource: source,
//     title: '',
//     size: {
//       height: 420,
//     },
//     series: {
//       argumentField: 'day',
//       valueField: 't',
//       type: 'bar',
//     },
//     customizePoint() {
//       const color = palette[paletteIndex];
//       paletteIndex = paletteIndex === 2 ? 0 : paletteIndex + 1;

//       return {
//         color,
//       };
//     },
//     legend: {
//       visible: false,
//     },
//     export: {
//       enabled: false,
//     },
//     valueAxis: {
//       label: {
//         customizeText() {
//           return `${this.valueText}`;
//         },
//       },
//     },
//     loadingIndicator: {
//       enabled: true,
//     },
//   });

//   jQuery('#choose-temperature').dxSelectBox({
//     dataSource: [2, 4, 6, 8, 9, 10, 11],
//     value: 2,
//     onValueChanged(data) {
//       source.filter(['t', '>', data.value]);
//       source.load();
//     },
//   });
// });

    
</script><!-- Form js -->      

</body>
</html>
