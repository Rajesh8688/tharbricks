@extends('front_end.layouts.master')
@section('content')
<!-- Content -->
<div class="page-content">
    <!-- Left & right section -->
    <div class="aon-blog-page-wrap">
        <div class="container">
            <div class="row">
                <!-- Left part start -->
                <div class="col-lg-8 col-md-12">
                        
                    <div id="grid">
                      
                          @forelse ($blogs as $blog)
                          <div class="aon-blog-list3">
                            <div class="post-bx">
                                <div class="post-thum"> 
                                  <img title="title" src="{{asset('uploads/blogs')."/".$blog->image}}" alt="">
                                </div>
                                <div class="post-date-position">
                                    <div class="post-share">
                                        
                                        <a href="{{route('blogDetails',['slug'=>$blog->slug])}}" class="post-share-icon feather-share-2"></a>
                                    </div>
                                    <div class="post-date">
                                        <span>{{  Carbon\Carbon::parse($blog->created_at)->format('M d,Y')}}</span>
                                    </div>
                                    {{-- MAR 18,  2022 --}}
                                </div>
                                <div class="post-info">
                                  

                                    <div class="post-meta1">
                                        <ul>
                                            
                                            <li class="post-author"><i class="feather-user"></i>{{__('lang.by')}}
                                                <a href="#" title="Posts by admin" rel="author">{{$blog->user_name}}</a>
                                            </li>
                                        </ul>
                                    </div>
                                                                        
                                    <div class="post-text">
                                        <h4 class="post-title">
                                            <a href="{{route('blogDetails',['slug'=>$blog->slug])}}">{{$blog->name}} </a>
                                        </h4>
                                        <?php $htmlDesc = strip_tags($blog->description);?>
                                        <p>{{ substr($htmlDesc, 0,120)}} {{strlen($htmlDesc) > 120 ? "...":""}} </p>
                                    </div>

                                    <div class="post-categories">
                                        @foreach(explode(",",$blog->tags) as $tag)
                                        <a href="#">{{$tag}}</a>
                                        @endforeach
                                     </div>
                                  
                                </div>
                                
                            </div>
                          </div>
                          @empty
                          <div>
                            <h1>{{__('lang.no_blog_found')}}</h1>
                          </div>
                              
                          @endforelse
                          
                          
                      
                    </div>                        
                      
                    {{-- <div class="site-pagination s-p-center">
                        <ul class="pagination">
                          <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1"><i class="fa fa-chevron-left"></i></a>
                          </li>
                          <li class="page-item"><a class="page-link" href="#">1</a></li>
                          <li class="page-item active">
                            <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                          </li>
                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                          <li class="page-item"><a class="page-link" href="#"><i class="fa fa-ellipsis-h"></i></a></li>
                          <li class="page-item"><a class="page-link" href="#">11</a></li>
                          <li class="page-item">
                            <a class="page-link" href="#"><i class="fa fa-chevron-right"></i></a>
                          </li>
                        </ul>
                    </div>                                  --}}
                    <div class="site-pagination s-p-center">
                    {{ $blogs->links() }}
                </div>  

                          
                </div>
                <!-- Left part END -->   
                
                <!-- Side bar start -->
                <div class="col-lg-4 col-md-12">

                    <aside class="side-bar ">
                            
                        <!-- SEARCH -->
                        <div class="widget rounded-sidebar-widget">
                             <div class="widget_search_bx">
                                <div class="text-left m-b30">
                                    <h3 class="widget-title">{{__('lang.search')}}</h3>
                                </div> 
                                 <form role="search" method="get" action="{{route('blogs')}}">
                                     <div class="input-group">
                                         <input name="search" type="text" class="form-control" placeholder="Write your text">
                                         <span class="input-group-btn">
                                             <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                                         </span>
                                     </div>
                                 </form>
                             </div>
                         </div>

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