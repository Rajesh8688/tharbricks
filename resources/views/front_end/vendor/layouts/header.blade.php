<header id="header-admin-wrap" class="header-admin-fixed">
        
    <!-- Header Start -->
    <div id="header-admin">
        <div class="container">
            
            <!-- Left Side Content -->
            <div class="header-left">
                
                <div class="my-account-logo">
                    <a href="{{route('vendor-dashboard')}}"><img src="{{ asset('frontEnd/images/logo-dark.png')}}" alt=""></a>
                </div>
                
                {{-- <div class="header-widget aon-admin-search-box">
                    <div class="aon-admin-search ">
                        <input class="form-control sf-form-control" name="company_name" type="text" placeholder="Search">
                        <button class="admin-search-btn"><i class="fs-input-icon feather-search"></i></button>
                    </div>
                </div> --}}
                
            </div>
            <!-- Left Side Content End -->
            
            <!-- Right Side Content -->
            <div class="header-right">
                
                <div class="header-menu">
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
                            <li class="{{request()->route()->getName() == 'vendor-dashboard' ? 'current-menu-item' : '' }}"><a href="{{route('vendor-dashboard')}}">Dashboard</a></li>  
                            <li class="{{request()->route()->getName() == 'vendor-leads' ? 'current-menu-item' : '' }}"><a href="{{route('vendor-leads')}}">Leads</a></li>  
                            <li><a href="contact-us.html">My Response</a></li>  
                            <li><a href="contact-us.html">Settings</a></li>  
                            <li><a href="contact-us.html">help</a></li>  
                    
                        </ul>

                    </div>
                </div>
                
                <ul class="header-widget-wrap">
                    <li class="header-widget has-toltip">
                        <div class="aon-admin-notification sf-toogle-btn">
                            <i class="feather-bell"></i>
                            <span class="notification-animate">8</span>
                            <span class="header-toltip">Notification</span>
                        </div>

                        <div class="ws-toggle-popup popup-tabs-wrap-section popup-notifica-msg">
                            <div class="popup-tabs-wrap">

                                <div class="popup-tabs">

                                    <ul class="nav nav-tabs nav-justified">                                        
                                        <!--1-->
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#accepted1">
                                                Accepted
                                            </a>
                                        </li>
                                        <!--2-->
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#rejected1">
                                                Rejected
                                            </a>
                                        </li>
                                    </ul>                                       
                                    <div class="tab-content">
                                        <div id="accepted1" class="tab-pane active">
                                            <div class="ws-poptab-list-wrap">
                                                <!--list One-->
                                                <div class="ws-poptab-list">
                                                    <div class="ws-poptab-media">
                                                        <img src="images/testimonials2/pic1.jpg" alt="">
                                                    </div>
                                                    <div class="ws-poptab-info">
                                                        <strong>David Chua</strong>
                                                        <p>David wood requested to change.</p>
                                                        <span class="ws-time-duration">8 mins ago</span>
                                                    </div>
                                                </div>

                                                <!--list Two-->
                                                <div class="ws-poptab-list">
                                                    <div class="ws-poptab-media">
                                                        <img src="images/testimonials2/pic2.jpg" alt="">
                                                    </div>
                                                    <div class="ws-poptab-info">
                                                        <strong>Lussa Smith</strong>
                                                        <p>David wood requested to change.</p>
                                                        <span class="ws-time-duration">4 mins ago</span>
                                                    </div>
                                                </div>

                                                <!--list three-->
                                                <div class="ws-poptab-list">
                                                    <div class="ws-poptab-media">
                                                        <img src="images/testimonials2/pic3.jpg" alt="">
                                                    </div>
                                                    <div class="ws-poptab-info">
                                                        <strong>Zilia Wood</strong>
                                                        <p>David wood requested to change.</p>
                                                        <span class="ws-time-duration">2 mins ago</span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="ws-poptab-all text-center">
                                                <a href="#" class="btn-link-type">View All</a>
                                            </div>                                                    
                                            
                                        </div>

                                        <div id="rejected1" class="tab-pane">
                                            <div class="ws-poptab-list-wrap">
                                                <!--list One-->
                                                <div class="ws-poptab-list">
                                                    <div class="ws-poptab-media">
                                                        <img src="images/testimonials2/pic1.jpg" alt="">
                                                    </div>
                                                    <div class="ws-poptab-info">
                                                        <strong>Maria Smith</strong>
                                                        <p>David wood requested to change.</p>
                                                        <span class="ws-time-duration">8 mins ago</span>
                                                    </div>
                                                </div>

                                                <!--list Two-->
                                                <div class="ws-poptab-list">
                                                    <div class="ws-poptab-media">
                                                        <img src="images/testimonials2/pic2.jpg" alt="">
                                                    </div>
                                                    <div class="ws-poptab-info">
                                                        <strong>Zonsan Wood</strong>
                                                        <p>David wood requested to change.</p>
                                                        <span class="ws-time-duration">4 mins ago</span>
                                                    </div>
                                                </div>

                                                <!--list three-->
                                                <div class="ws-poptab-list">
                                                    <div class="ws-poptab-media">
                                                        <img src="images/testimonials2/pic3.jpg" alt="">
                                                    </div>
                                                    <div class="ws-poptab-info">
                                                        <strong>Denisa Wood</strong>
                                                        <p>David wood requested to change.</p>
                                                        <span class="ws-time-duration">2 mins ago</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ws-poptab-all text-center">
                                                <a href="#" class="btn-link-type">View All</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    {{-- <li class="header-widget has-toltip">
                        <div class="aon-admin-messange sf-toogle-btn">
                            <i class="feather-globe"></i>
                            <span class="header-toltip">Language</span>
                        </div>
                        <div class="ws-toggle-popup popup-tabs-wrap-section popup-curra-lang">
                            <ul class="popup-curra-lang-list">
                                <li>English</li>
                                <li>Franais</li>
                                <li>Espaol</li>
                                <li>Deutsch</li>
                            </ul>
                        </div>
                    </li> --}}
                    <li class="header-widget">
                        <div class="aon-admin-messange sf-toogle-btn">
                            <span class="feather-user-pic"><img src="images/user.jpg" alt=""/></span>
                        </div>
                        <div class="ws-toggle-popup popup-tabs-wrap-section user-welcome-area">
                            <ul class="user-welcome-list">
                                <li><strong>Welcome , <span class="site-text-primary">{{auth()->user()->name}}</span></strong></li>
                                <li><a href="{{route('vendor-dashboard')}}"><i class="feather-sliders"></i> Dashboard</a></li>
                                <li><a href="#"><i class="feather-file"></i> Add Listing</a></li>
                                <li><a href="{{route('home')}}"><i class="feather-repeat"></i> Switch to public</a></li>
                                <li><a href="#"><i class="feather-settings"></i> Setting</a></li>
                                <li>
                                    <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-in-alt"></i> Log Out</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                    

                </ul>
            </div>
            <!-- Right Side Content End -->

        </div>
    </div>
    <!-- Header End -->

</header>