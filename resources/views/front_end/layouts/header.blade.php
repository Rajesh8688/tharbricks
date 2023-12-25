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
                      <li class="{{Request::segment(1) == 'category' ? 'current-menu-item' : '' }}" ><a href="{{route('category')}}">Category</a></li>

                      <li class="has-child">
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
                      </li>
                      <li class="{{Request::segment(1) == 'contact-us' ? 'current-menu-item' : '' }}" ><a href="{{url('/contact-us')}}">Contact</a></li>
                    </ul>

                </div>

                <!-- Header Right Section-->
                <div class="extra-nav header-2-nav">
                            <div class="extra-cell">
                                <!--Login-->
                                <button type="button" class="site-button aon-btn-login" data-toggle="modal" data-target="#login-signup-model">
                                    <i class="fa fa-user"></i> Login
                                </button>
                                <!--Sign up-->
                                <a href="mc-profile.html" class="site-button aon-btn-signup m-l20">
                                    <i class="fa fa-plus"></i> Add Listing
                                </a>
                            </div>
                                
                            </div>                             
            </div>    

            </div>
          </div>
        </header>
        <!-- HEADER END -->