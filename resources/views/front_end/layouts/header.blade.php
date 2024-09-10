  <!-- HEADER START -->

        <header class="site-header header-style-2 mobile-sider-drawer-menu header-full-width">
          <div class="sticky-header main-bar-wraper  navbar-expand-lg">
            <div class="main-bar">  

            <div class="container clearfix"> 
                <!--Logo section start-->
                <div class="logo-header">
                    <div class="logo-header-inner logo-header-one"> 
                      <a href="{{url('/')}}">
                      <img src="{{ asset('frontEnd/images/logo-dark.png')}}" alt="">
                      </a>
                    </div>
                </div>  
                <!--Logo section End-->

                <!-- NAV Toggle Button -->
                <button id="mobile-side-drawer" data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggler collapsed">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar icon-bar-first"></span>
                    <span class="icon-bar icon-bar-two"></span>
                    <span class="icon-bar icon-bar-three"></span>
                </button> 

                <!-- MAIN Vav -->
                <div class="nav-animation header-nav navbar-collapse collapse d-flex justify-content-start">

                    <ul class=" nav navbar-nav">
                      <li class="{{Request::segment(1) == '' ? 'current-menu-item' : '' }}" ><a href="{{url('/')}}">{{__('lang.home')}}</a></li>
                      <li class="{{Request::segment(1) == 'service' ? 'current-menu-item' : '' }}" ><a href="{{route('service')}}">{{__('lang.services')}}</a></li>
                      <li class="{{Request::segment(1) == 'blogs' ? 'current-menu-item' : '' }}" ><a href="{{route('blogs')}}">{{__('lang.blogs')}}</a></li>
                      <li class="has-child"><a href="javascript:;">{{__('lang.language')}}</a>
                          <ul class="sub-menu">
                              <li><a href="{{route('changelang',['lang'=>'en'])}}">English</a></li>
                              <li><a href="{{route('changelang',['lang'=>'hi'])}}">हिंदी</a></li>
                              <li><a href="{{route('changelang',['lang'=>'kn'])}}">ಕನ್ನಡ</a></li>
                          </ul>                                                                 
                      </li>
                      <li class="{{Request::segment(1) == 'contact-us' ? 'current-menu-item' : '' }}" ><a href="{{url('/contact-us')}}">{{__('lang.contact_us')}}</a></li>
                    </ul>
                </div>

                @if(Auth::guard('web')->check())
                <div class="header-widget">
                    <div class="aon-admin-messange sf-toogle-btn" style="border-bottom: 1px solid #fff">
                        @if(empty(auth()->user()->profile_pic))
                        <div class="default-avatar user-letter default-avatar-40  site-bg-orange d-inline-flex text-white ml-3 mr-1 justify-content-center align-items-center" >
                            <div class="site-text-primary font-bolder">
                                {{ucfirst(substr(auth()->user()->name,0,1))}}
                            </div>
                        </div>
                        @else
                        <span class="feather-user-pic"><img src="{{asset('uploads/users/'.auth()->user()->profile_pic)}}" alt=""/></span> 
                        @endif
                    </div>
                    <div class="ws-toggle-popup popup-tabs-wrap-section user-welcome-area">
                        <ul class="user-welcome-list">
                            <li><strong>Welcome , <span class="site-text-primary">{{auth()->user()->name}}</span></strong></li>
                            {{-- <li><a href="{{route('vendor-dashboard')}}"><i class="feather-sliders"></i> Dashboard</a></li> --}}
                            <li><a href="#"><i class="feather-file"></i>{{__('lang.add_listing')}}</a></li>
                            <li><a href="{{route('vendor-dashboard')}}"><i class="feather-repeat"></i> {{__('lang.switch_to_seller')}}</a></li>
                            <li><a href="#"><i class="feather-settings"></i> {{__('lang.settings')}}</a></li>
                            <li>
                                <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-in-alt"></i>{{__('lang.logout')}}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                   
                @else
                <div class="extra-nav header-2-nav">
                    <div class="extra-cell">
                        <!--Login-->
                        <a href="{{url('/login')}}" class="site-button aon-btn-login">
                            <i class="fa fa-user"></i> {{__('lang.login')}}
                        </a>
                        <!--Sign up-->
                        <a href="{{route('signup')}}" class="site-button aon-btn-login">
                            <i class="fa fa-plus"></i> {{__('lang.join_as_a_professional')}}
                        </a>
                    </div>
                </div>  

                @endif

                         
            </div>    

            </div>
          </div>
        </header>
        <!-- HEADER END -->