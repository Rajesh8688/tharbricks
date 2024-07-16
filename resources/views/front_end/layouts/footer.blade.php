   <!-- FOOTER START -->
        <footer class="site-footer footer-light" >
            
            <!-- FOOTER NEWSLETTER START -->
            <div class="footer-top-newsletter">
                <div class="container">
                    <div class="sf-news-letter">
                        <span>{{__('lang.subscribe_our_newsletter')}}</span>
                        <form>
                            <div class="form-group sf-news-l-form">
                                <input type="text" class="form-control" placeholder="Enter Your Email">
                                <button type="submit" class="sf-sb-btn">{{__('lang.submit')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- FOOTER BLOCKES START -->  
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <!-- Footer col 1--> 
                        <div class="col-lg-3 col-md-6 col-sm-6  m-b30">
                            <div class="sf-site-link sf-widget-link">
                                <h4 class="sf-f-title">{{__('lang.site_links')}}</h4>
                                <ul>
                                    <li><a href="{{route('blogs')}}">{{__('lang.blog')}}</a></li>
                                    <li><a href="{{route('contactUs')}}">{{__('lang.contact_us')}}</a></li>
                                    <li><a href="{{route('service')}}">{{__('lang.services')}}</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Footer col 2-->
                        <div class="col-lg-3 col-md-6 col-sm-6  m-b30">
                            <div class="sf-site-link sf-widget-cities">
                                <h4 class="sf-f-title">Popular Cities</h4>
                                <ul>
                                    <li><a href="all-categories.html">Ballston Lake</a></li>
                                    <li><a href="all-categories.html">Batumi</a></li>
                                    <li><a href="all-categories.html">Brooklyn</a></li>
                                    <li><a href="all-categories.html">Cambridge</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Footer col 1-->
                        <div class="col-lg-3 col-md-6 col-sm-6  m-b30">
                            <div class="sf-site-link sf-widget-categories">
                                <h4 class="sf-f-title">Categories</h4>
                                <ul>
                                 
                                    @forEach($footerServices as $service)
                                        <li><a href="categories-detail.html">{{$service->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- Footer col 1-->
                        <div class="col-lg-3 col-md-6 col-sm-6  m-b30">
                            <div class="sf-site-link sf-widget-contact">
                                <h4 class="sf-f-title">Contact Info</h4>
                                <ul>
                                    <li>India</li>
                                    <li><a href="tel:+91 7624886912">+91 7624886912</a></li>
        
                                    <li> <a href="mailto:info@tharbricks.com">info@tharbricks.com</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- FOOTER COPYRIGHT -->
            <div class="footer-bottom">
                <div class="container">
                    <div class="sf-footer-bottom-section">
                        <div class="sf-f-logo"><a href="javascript:void(0);"><img src="{{ asset('frontEnd/images/logo-dark.png')}}" alt=""></a></div>
                    	<div class="sf-f-copyright">
                        	<span>Copyright {{ date('Y') }} | Tharbricks All Rights Reserved</span>
                        </div>
                       
                        <div class="sf-f-social">
                            <ul class="socila-box">
                                <li><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="javascript:void(0);"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                        
                    </div>
                </div>   
            </div>   
    
        </footer>
        <!-- FOOTER END -->