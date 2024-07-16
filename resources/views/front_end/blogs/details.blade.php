@extends('front_end.layouts.master')
@section('content')
   <!-- Content -->
   <div class="page-content">
            
    <!-- Banner Area -->
    <div class="aon-page-benner-area">
      <div class="aon-page-banner-row" style="background-image: url({{url('frontEnd/images/banner/job-banner.jpg')}})">
        <div class="sf-overlay-main" style="opacity:0.8; background-color:#022279;"></div>
        <div class="sf-banner-heading-wrap">
          <div class="sf-banner-heading-area">
            <div class="sf-banner-heading-large">{{__('lang.blog_detail')}}</div>
            <div class="sf-banner-breadcrumbs-nav">
              <ul class="list-inline">
                <li><a href="{{url('/')}}"> {{__('lang.home')}} </a></li>
                <li>{{__('lang.blog_detail')}}</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Area End -->
    
    <!-- Left & right section -->
    <div class="aon-page-jobs-wrap" style="padding-bottom: 10px">
        <div class="container">
            <div class="row">
                <!-- Left part start -->
                <div class="col-lg-8 col-md-12">
                    @if(!empty($blog))
                    <div class="sf-post-detail">

                        <div class="post blog-post blog-detail sf-blog-style-1">
                          <div class="post-bx">
                              <!-- Content section for blogs start -->
                              <div class="post-thum"> 
                                <img title="title" alt="" src="{{asset('uploads/blogs')."/".$blog->image}}">
                              </div>
                              <div class="post-info">
                                <div class="post-meta sf-icon-post-meta">
                                  <ul>
                                    <li class="post-author"><i class="feather-user"></i>{{__('lang.by')}}
                                      <a href="#" title="" rel="">{{$blog->user_name}}</a>
                                    </li>
                                    <li class="post-comment">
                                      <a href="#" title="" rel=""><i class="feather-message-square"></i>Comments</a>
                                    </li>
                                    <li class="post-views">
                                      <a href="#" title="" rel=""><i class="feather-eye"></i>85 Views</a>
                                    </li>
                                    
                                  </ul>
                                </div>
                                                                      
                                <div class="post-text">
                                  <h4 class="post-title">
                                    {{$blog->name}}
                                  </h4>
                                  {!! $blog->description !!}

                                 <div class="sf-con-social-wrap">
                                    <h4>{{__('lang.share_this_post')}}</h4>
                                    <ul class="sf-con-social">
                                        <li><a href="#" class="sf-fb"><img src="images/contact-us/facebook.png" alt="">Facebook</a></li>
                                        <li><a href="#" class="sf-twitter"><img src="images/contact-us/twitter.png" alt="">Twitter</a></li>
                                        <li><a href="#" class="sf-pinterest"><img src="images/contact-us/pinterest.png" alt="">Pinterest</a></li>
                                    </ul>
                                </div>

                               
                                <?php $tags = explode("," , $blog->tags); ?>

                                @if(count($tags) > 0)

                                    <div class="sf-post-tags">
                                        <h4>Tags</h4>
                                        <ul>
                                            @forEach($tags as $tag)
                                            <li><a href="#">{{$tag}}</a></li>
                                            @endforeach
                                        
                                      
                                        </ul>
                                    </div>
                                @endif

                                {{-- <div class="sf-pd-sm-media">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 m-b30">
                                            <div class="sf-pd-img">
                                                <img src="images/sf-blog-detail/thumb1.jpg" alt="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 m-b30">
                                            <div class="sf-pd-img">
                                                <img src="images/sf-blog-detail/thumb2.jpg" alt="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 m-b30">
                                            <div class="sf-pd-img">
                                                <img src="images/sf-blog-detail/thumb3.jpg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                </div>
                                
                              </div>
                              <!-- Content section for blogs end -->
                          </div>
                        </div>
                        <!-- Comment section for blogs start -->
                        {{-- <div class="clear sf-blog-comment-wrap" id="comment-list">
                            <div class="comments-area" id="comments">
                                <h2 class="comments-title m-t0"><span>02</span> Comments</h2>
                                <div>
                                    <!-- COMMENT LIST START -->
                                    <ol class="comment-list">
                                        <li class="comment">
                                            <!-- COMMENT BLOCK -->
                                            <div class="comment-body">
                                                <div class="comment-author vcard">
                                                    <img  class="avatar photo" src="images/sf-post-coment/1.jpg" alt="">
                                                    <cite class="fn">Janice Brown</cite>
                                                    <span class="says">says:</span>
                                                </div>                                                
                                                <div class="comment-meta">
                                                    <a href="javascript:void(0);">MAR 18,2022 AT 2:14pm</a>
                                                </div>                                        
                                                <p>Qui officia deserunt mollit anim id est labrum. Duis aute iruret dolor in prehenderit in voludptate velit esse cillum toret eu giat enerit in volptate.</p>
                                                <div class="reply">
                                                    <a href="javscript:;" class="comment-reply-link">Reply</a>
                                                </div>
                                            </div>
                                            
                                        </li>

                                        <li class="comment">
                                            <!-- COMMENT BLOCK -->
                                            <div class="comment-body">
                                                <div class="comment-author vcard">
                                                    <img  class="avatar photo" src="images/sf-post-coment/2.jpg" alt="">
                                                    <cite class="fn">Janice Brown</cite>
                                                    <span class="says">says:</span>
                                                </div>                                                
                                                <div class="comment-meta">
                                                    <a href="javascript:void(0);">MAR 18,2022 AT 2:14pm</a>
                                                </div>                                        
                                                <p>Qui officia deserunt mollit anim id est labrum. Duis aute iruret dolor in prehenderit in voludptate velit esse cillum toret eu giat enerit in volptate.</p>
                                                <div class="reply">
                                                    <a href="javscript:;" class="comment-reply-link">Reply</a>
                                                </div>
                                            </div>
                                            
                                        </li>
                                    </ol>
                                    <!-- COMMENT LIST END -->
                                    
                                    <!-- LEAVE A REPLY START -->
                                    <div class="comment-respond m-t30" id="respond">
                                        <form class="comment-form" id="commentform" method="post" >
                                    
                                            <p class="comment-form-author">
                                                <label for="author">Name <span class="required">*</span></label>
                                                <input class="form-control" type="text" value="" name="user-comment"  placeholder="Name" id="author">
                                            </p>
                                            
                                            <p class="comment-form-email">
                                                <label>Email <span class="required">*</span></label>
                                                <input class="form-control" type="text" value="" name="email" placeholder="Email">
                                            </p>
                                            
                                            <p class="comment-form-url">
                                                <label for="url">Website</label>
                                                <input class="form-control" type="text"  value=""  name="url"   placeholder="Website" id="url">
                                            </p>
                                            
                                            <p class="comment-form-comment">
                                                <label for="comment">Comment</label>
                                                <textarea class="form-control" rows="8" name="comment" placeholder="Comment" id="comment"></textarea>
                                            </p>
                                            
                                            <p class="form-submit">
                                                <button class="sf-btn-large" type="button">Post Comment</button>
                                            </p>
                                            
                                        </form>
        
                                    </div>
                                    <!-- LEAVE A REPLY END -->
                               </div>
                            </div>
                        </div> --}}
                        <!-- Comment section for blogs start -->
                        
                    </div>
                    @else
                    <h4 class="post-title">
                        {{__('lang.no_blog_found')}}
                      </h4>
                    @endif

                  
                   
                                         
                    
                </div>
                <!-- Left part END -->   
                
                <!-- Side bar start -->
                <div class="col-lg-4 col-md-12">

                    <aside class="side-bar ">
                            
                        

                        <!-- Social -->
                        <div class="widget rounded-sidebar-widget">
                            <div class="text-left m-b30">
                                <h3 class="widget-title">{{__('lang.follow_us')}}</h3>
                            </div> 
                            <div class="widget_social_inks">
                                <ul class="social-icons social-square social-darkest social-md">
                                    <li><a href="javascript:void(0);" class="fb-1"><img src="{{asset('frontEnd/images/social-icon/fb-1.png')}}" alt=""></a></li>
                                    <li><a href="javascript:void(0);" class="tw-1"><img src="{{asset('frontEnd/images/social-icon/tw-1.png')}}" alt=""></a></li>
                                    <li><a href="javascript:void(0);" class="pint-1"><img src="{{asset('frontEnd/images/social-icon/pint-1.png')}}" alt=""></a></li>
                                    <li><a href="javascript:void(0);" class="in-1"><img src="{{asset('frontEnd/images/social-icon/in-1.png')}}" alt=""></a></li>
                                </ul>
                            </div>
                        </div> 

                        <!-- CATEGORY -->   
                        <div class="widget widget_services rounded-sidebar-widget">
                            <div class="text-left m-b30">
                                <h3 class="widget-title">{{__('lang.services')}}</h3>
                            </div>
                            <ul>
                                @forEach($services as $service)
                                <?php $url = ($service->blogCount > 0) ? route('blogs',['serviceId'=>$service->id]) : '#';?>
                                <li><a href="{{$url}}">{{$service->name}}</a><span class="badge">({{$service->blogCount}})</span></li>
                                @endforeach
                            </ul>
                        </div>   
                         
                        <!-- RECENT POSTS -->
                        <div class="widget recent-posts-entry rounded-sidebar-widget">
                             <div class="text-left m-b30">
                                 <h3 class="widget-title">{{__('lang.recent_blogs')}}</h3>
                             </div>                                    
                             
                             <div class="widget-post-bx">
                                @forEach($Recentblogs as $recent)
                                <div class="widget-post clearfix">
                                    <div class="wt-post-media">
                                        <img src="{{asset('uploads/blogs')."/".$recent->image}}" alt="">
                                    </div>
                                    <div class="wt-post-info">
                                        <div class="wt-post-header">
                                            <h5 class="post-title"> 
                                                <a href="{{route('blogDetails',['slug'=>$recent->slug])}}">{{$service->name}}</a></h5>
                                        </div>                                                    
                                        <div class="wt-post-meta">
                                            <ul>
                                                <li class="post-date">{{  Carbon\Carbon::parse($recent->created_at)->format('M d,Y')}}</li>
                                            </ul>
                                        </div>                                            
                                    </div>
                                </div>
                                @endforeach                                            
                            </div>
                         </div>
                    </aside>

                </div>
                <!-- Side bar END -->

            </div>
        </div>
    </div> 
    <!-- Left & right section  END -->
    
    </div>
    <!-- Content END-->
@endsection    