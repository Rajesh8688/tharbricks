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
                      <li class="{{Request::segment(1) == '' ? 'current-menu-item' : '' }}" ><a href="{{url('/')}}">Home</a></li>
                      <li class="{{Request::segment(1) == 'service' ? 'current-menu-item' : '' }}" ><a href="{{route('service')}}">Service</a></li>
                      <li class="{{Request::segment(1) == 'blogs' ? 'current-menu-item' : '' }}" ><a href="{{route('blogs')}}">Blog</a></li>

                      {{-- <li class="has-child">
                          <a href="javascript:;">Pages</a>
                          <ul class="sub-menu">
                              <li><a href="about-us.html">About us</a></li>
                              <li><a href="javascript:;">Categories</a>
                                  <ul class="sub-menu">
                                      <li><a href="all-categories.html">All Categories</a></li>
                                      <li><a href="categories-detail.html">Categories Detail</a></li>
                                      <li><a href="categories-detail-2.html">Categories Detail 2</a></li>
                                  </ul>
                              </li>

                              <li><a href="javascript:;">Search</a>
                                  <ul class="sub-menu">
                                      <li><a href="search-list.html">Search List</a></li>
                                      <li><a href="new-search-list-2.html">Search List 2</a></li>
                                      <li><a href="search-list-map.html">Search List Map</a></li>
                                      <li><a href="search-list-map2.html">Search List Map 2</a></li>
                                      <li><a href="search-grid.html">Search-grid</a></li>
                                      <li><a href="search-grids-map.html">Search-grid-map</a></li>
                                      <li><a href="search-grid-map2.html">Search-grid-map2</a></li>
                                  </ul>
                              </li>
                              <li><a href="error-404.html">Error 404</a></li>
                          </ul>                                
                      </li>

                      <li class="has-child"><a href="javascript:;">Profile</a>
                          <ul class="sub-menu">
                              <li><a href="profile-full.html">Profile</a></li>
                              <li><a href="profile-sidebar.html">Profile Sidebar</a></li>
                          </ul>                                                                 
                      </li>

                      <li class="has-child"><a href="javascript:;">Jobs</a>
                          <ul class="sub-menu">
                              <li><a href="job-listing.html">Job listing</a></li>                                        
                              <li><a href="job-grid.html">Job grid</a></li>
                              <li><a href="job-detail.html">Job detail</a></li>                                        
                          </ul>                                
                      </li>

                      <li class="has-child"><a href="javascript:;">Blog</a>
                          <ul class="sub-menu">
                              <li><a href="blog-grid.html">Blog Grid</a></li>                                        
                              <li><a href="blog-grid-2.html">Blog Grid 2</a></li>
                              <li><a href="blog-list.html">Blog list</a></li>
                              <li><a href="blog-list-2.html">Blog list 2</a></li>
                              <li><a href="blog-list-3.html">Blog list 3</a></li>
                              <li><a href="blog-list-4.html">Blog list 4</a></li>
                              <li><a href="blog-detail.html">Blog detail</a></li>
                          </ul>                                
                      </li> --}}
                      <li class="{{Request::segment(1) == 'contact-us' ? 'current-menu-item' : '' }}" ><a href="{{url('/contact-us')}}">Contact</a></li>
                      
                    </ul>
                </div>
               
                    
                    
                
                <div class="header-widget">
                    <div class="aon-admin-messange sf-toogle-btn">
                        <i class="feather-globe"></i>
                        <span class="header-toltip">Language</span>
                    </div>
                    <div class="ws-toggle-popup popup-tabs-wrap-section " style ="width: revert-layer">
                        <ul class="popup-curra-lang-list">
                            <li> <a  href="{{route('changelang',['lang'=>'en'])}}">English</a></li>
                            <li> <a  href="{{route('changelang',['lang'=>'hi'])}}">Hindi</a></li>
                            <li> <a  href="{{route('changelang',['lang'=>'kn'])}}">Kannada</a></li>
                        </ul>
                    </div>
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
                            <li><a href="#"><i class="feather-file"></i> Add Listing</a></li>
                            <li><a href="{{route('vendor-dashboard')}}"><i class="feather-repeat"></i> Switch to seller</a></li>
                            <li><a href="#"><i class="feather-settings"></i> Setting</a></li>
                            <li>
                                <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-in-alt"></i> Log Out</a>
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
                            <i class="fa fa-user"></i> Login
                        </a>
                        <!--Sign up-->
                        <a href="{{route('signup')}}" class="site-button aon-btn-login">
                            <i class="fa fa-plus"></i> Join as a Professional
                        </a>
                    </div>
                </div>  

                @endif

                         
            </div>    

            </div>
          </div>
        </header>
        <!-- HEADER END -->