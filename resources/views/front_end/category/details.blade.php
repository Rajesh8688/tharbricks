@extends('front_end.layouts.master')
@section('content')
   <!-- Content -->
   <div class="page-content">
            
        <div class="section-content sf-allCaty-info-wrap">
            <div class="container">
                <!--Category Detail Section Start-->
                <div class="row">
                    <!--Category Detail Left-->
                    <div class="col-md-6">
                        <?php $image = asset('uploads/categories').'/'.$category->image ;?>
                        <div class="sf-caty-pic" style="background-image: url({{$image}})">
                            <div class="sf-caty-btn">View Category</div>
                            <div class="sf-caty-cirle"><i class="fa fa-arrow-circle-down"></i></div>
                        </div>
                    </div>
                    <!--Category Detail Right-->
                    <div class="col-md-6">
                        <div class="sf-caty-info">
                            <div class="m-b10"><strong> Category</strong> / {{$category->name}}</div>
                            <h3>{{$category->name}}</h3>
                            <div class="sf-caty-text">
                                {!!$category->description!!}
                            </div>
                        </div>
                    </div>
                </div>
                <!--Category Detail Section End-->
            </div>
        </div>
        
        <div class="section-content sf-allCaty-grid-wrap sf-owl-arrow">
            <div class="container">
                <!--Title Section Start-->
                <div class="section-head">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="sf-title text-white">All Categories</h2>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                </div>
                <!--Title Section End-->

                <div class="section-content">
                    <div class="owl-carousel owl-caty-carousel sf-owl-arrow">
                        <!-- COLUMNS 1 -->
                        @foreach ($categories as $item)
                        <div class="item sf-caty-item-col">
                            <div class="sf-catyitem-box">
                                <?php $image = asset('uploads/categories').'/'.$item->image ;?>
                                <div class="sf-catyitem-pic" style="background-image: url({{$image}})">
                                    <span class="sf-caty-num"></span>
                                    <a href="{{route('categoryDetails',['slug'=>$item->slug])}}" class="sf-caty-link"></a>
                                </div>
                                <h5 class="sf-catyitem-title"><a href="{{route('categoryDetails',['slug'=>$item->slug])}}">{{$item->name}}</a></h5>
                            </div>
                            
                           
                        </div>

                        @endforeach
                        
                       
                    </div>
                </div>                       
                
            </div>
        </div>
        
        <div class="section-content sf-caty-listResult-wrap">
            <div class="container">

                <div class="section-content">
                    <!--Showing results topbar Start-->
                    <div class="sf-search-result-top flex-wrap d-flex justify-content-between">
                        <div class="sf-search-result-title"> <h5>Showing 1 – 10 of 16 results</h5></div>
                        <div class="sf-search-result-option">
                            <ul class="sf-search-sortby">
                            <li class="sf-select-sort-by">
                                <select class="sf-select-box form-control sf-form-control bs-select-hidden" title="SORT BY" name="setorderby" id="setorderby">
                                <option class="bs-title-option" value="">SORT BY</option>
                                <option value="rating">Rating</option>
                                <option value="title">Title</option>
                                <option value="distance">Distance</option>
                                </select>
                            </li>
                            <li>
                                <select class="sf-select-box form-control sf-form-control bs-select-hidden" title="DESC" name="setorder" id="setorder">
                                <option class="bs-title-option" value="">DESC</option>
                                <option value="asc">ASC</option>
                                <option value="desc">DESC</option>
                                </select>
                            </li>
                            <li>
                                <select class="sf-select-box form-control sf-form-control bs-select-hidden" title="9" name="numberofpages" id="numberofpages">
                                <option class="bs-title-option" value="">9</option>
                                <option value="9">9</option>
                                <option value="12">12</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="30">30</option>
                                </select>
                            </li>
                            </ul>
                            <ul class="sf-search-grid-option" id="viewTypes">
                            <li data-view="grid-3">
                                <button type="button" class="btn btn-border btn-icon"><i class="fa fa-th"></i></button>
                            </li>
                            <li data-view="listview" class="active">
                                <button type="button" class="btn btn-border btn-icon"><i class="fa fa-th-list"></i></button>
                            </li>
                            </ul>
                        </div>
                    </div>
                    <!--Showing results topbar End-->
                    <div class="row">
                        <!--BLock 1-->
                        <div class="col-md-6">
                            <div class="sf-vender-list-wrap">
                                <div class="sf-vender-list-box d-flex">
                                    <div class="sf-vender-list-pic" style="background-image:url(images/categories/pic1.jpg)">
                                        <a class="sf-vender-pic-link" href="profile-full.html"></a>
                                    </div>
                                    <div class="sf-vender-list-info">
                                        <h4 class="sf-venders-title"><a href="profile-full.html">Colin Farrell</a></h4>
                                        <span class="sf-venders-address"><i class="fa fa-map-marker"></i>Queens, United States</span>
                                        <div class="sf-ow-pro-rating">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star text-gray"></span>
                                        </div>
                                        <p>Through our expertise, technological knowledge, global presence and bespoke.</p>
                                        <div class="sf-pro-check"><span><i class="fa fa-check"></i></span></div>
                                        <div class="sf-pro-favorite"><a href="#"><i class="fa fa-heart-o"></i></a></div>

                                        <div class="dropdown action-dropdown dropdown-left">
                                            <button class="action-button gray dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-ellipsis-v"></i></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="javascript:;"><i class="feather-sliders"></i> Display Services</a></li>
                                                <li><a href="javascript:;"><i class="feather-save"></i> 0 Review Comments</a></li>
                                                <li><a href="javascript:;"><i class="feather-trash"></i> Request A Quote</a></li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--BLock 2-->
                        <div class="col-md-6">
                            <div class="sf-vender-list-wrap">
                                <div class="sf-vender-list-box d-flex">
                                    <div class="sf-vender-list-pic" style="background-image:url(images/categories/pic2.jpg)">
                                        <a class="sf-vender-pic-link" href="profile-full.html"></a>
                                    </div>
                                    <div class="sf-vender-list-info">
                                        <h4 class="sf-venders-title"><a href="profile-full.html">Edward Luise</a></h4>
                                        <span class="sf-venders-address"><i class="fa fa-map-marker"></i>Queens, United States</span>
                                        <div class="sf-ow-pro-rating">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star text-gray"></span>
                                        </div>
                                        <p>Through our expertise, technological knowledge, global presence and bespoke.</p>
                                        <div class="sf-pro-check"><span><i class="fa fa-check"></i></span></div>
                                        <div class="sf-pro-favorite"><a href="#"><i class="fa fa-heart-o"></i></a></div>

                                        <div class="dropdown action-dropdown dropdown-left">
                                            <button class="action-button gray dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-ellipsis-v"></i></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="javascript:;"><i class="feather-sliders"></i> Display Services</a></li>
                                                <li><a href="javascript:;"><i class="feather-save"></i> 0 Review Comments</a></li>
                                                <li><a href="javascript:;"><i class="feather-trash"></i> Request A Quote</a></li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--BLock 3-->
                        <div class="col-md-6">
                            <div class="sf-vender-list-wrap">
                                <div class="sf-vender-list-box d-flex">
                                    <div class="sf-vender-list-pic" style="background-image:url(images/categories/pic3.jpg)">
                                        <a class="sf-vender-pic-link" href="profile-full.html"></a>
                                    </div>
                                    <div class="sf-vender-list-info">
                                        <h4 class="sf-venders-title"><a href="profile-full.html">Colin Farrell</a></h4>
                                        <span class="sf-venders-address"><i class="fa fa-map-marker"></i>Queens, United States</span>
                                        <div class="sf-ow-pro-rating">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star text-gray"></span>
                                        </div>
                                        <p>Through our expertise, technological knowledge, global presence and bespoke.</p>
                                        <div class="sf-pro-check"><span><i class="fa fa-check"></i></span></div>
                                        <div class="sf-pro-favorite"><a href="#"><i class="fa fa-heart-o"></i></a></div>

                                        <div class="dropdown action-dropdown dropdown-left">
                                            <button class="action-button gray dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-ellipsis-v"></i></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="javascript:;"><i class="feather-sliders"></i> Display Services</a></li>
                                                <li><a href="javascript:;"><i class="feather-save"></i> 0 Review Comments</a></li>
                                                <li><a href="javascript:;"><i class="feather-trash"></i> Request A Quote</a></li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--BLock 4-->
                        <div class="col-md-6">
                            <div class="sf-vender-list-wrap">
                                <div class="sf-vender-list-box d-flex">
                                    <div class="sf-vender-list-pic" style="background-image:url(images/categories/pic4.jpg)">
                                        <a class="sf-vender-pic-link" href="profile-full.html"></a>
                                    </div>
                                    <div class="sf-vender-list-info">
                                        <h4 class="sf-venders-title"><a href="profile-full.html">Jackie Chan</a></h4>
                                        <span class="sf-venders-address"><i class="fa fa-map-marker"></i>Queens, United States</span>
                                        <div class="sf-ow-pro-rating">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star text-gray"></span>
                                        </div>
                                        <p>Through our expertise, technological knowledge, global presence and bespoke.</p>
                                        <div class="sf-pro-check"><span><i class="fa fa-check"></i></span></div>
                                        <div class="sf-pro-favorite"><a href="#"><i class="fa fa-heart-o"></i></a></div>

                                        <div class="dropdown action-dropdown dropdown-left">
                                            <button class="action-button gray dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-ellipsis-v"></i></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="javascript:;"><i class="feather-sliders"></i> Display Services</a></li>
                                                <li><a href="javascript:;"><i class="feather-save"></i> 0 Review Comments</a></li>
                                                <li><a href="javascript:;"><i class="feather-trash"></i> Request A Quote</a></li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--BLock 5-->
                        <div class="col-md-6">
                            <div class="sf-vender-list-wrap">
                                <div class="sf-vender-list-box d-flex">
                                    <div class="sf-vender-list-pic" style="background-image:url(images/categories/pic5.jpg)">
                                        <a class="sf-vender-pic-link" href="profile-full.html"></a>
                                    </div>
                                    <div class="sf-vender-list-info">
                                        <h4 class="sf-venders-title"><a href="profile-full.html">James McAvoy</a></h4>
                                        <span class="sf-venders-address"><i class="fa fa-map-marker"></i>Queens, United States</span>
                                        <div class="sf-ow-pro-rating">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star text-gray"></span>
                                        </div>
                                        <p>Through our expertise, technological knowledge, global presence and bespoke.</p>
                                        <div class="sf-pro-check"><span><i class="fa fa-check"></i></span></div>
                                        <div class="sf-pro-favorite"><a href="#"><i class="fa fa-heart-o"></i></a></div>

                                        <div class="dropdown action-dropdown dropdown-left">
                                            <button class="action-button gray dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-ellipsis-v"></i></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="javascript:;"><i class="feather-sliders"></i> Display Services</a></li>
                                                <li><a href="javascript:;"><i class="feather-save"></i> 0 Review Comments</a></li>
                                                <li><a href="javascript:;"><i class="feather-trash"></i> Request A Quote</a></li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--BLock 6-->
                        <div class="col-md-6">
                            <div class="sf-vender-list-wrap">
                                <div class="sf-vender-list-box d-flex">
                                    <div class="sf-vender-list-pic" style="background-image:url(images/categories/pic6.jpg)">
                                        <a class="sf-vender-pic-link" href="profile-full.html"></a>
                                    </div>
                                    <div class="sf-vender-list-info">
                                        <h4 class="sf-venders-title"><a href="profile-full.html">Edward Luise</a></h4>
                                        <span class="sf-venders-address"><i class="fa fa-map-marker"></i>Queens, United States</span>
                                        <div class="sf-ow-pro-rating">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star text-gray"></span>
                                        </div>
                                        <p>Through our expertise, technological knowledge, global presence and bespoke.</p>
                                        <div class="sf-pro-check"><span><i class="fa fa-check"></i></span></div>
                                        <div class="sf-pro-favorite"><a href="#"><i class="fa fa-heart-o"></i></a></div>

                                        <div class="dropdown action-dropdown dropdown-left">
                                            <button class="action-button gray dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-ellipsis-v"></i></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="javascript:;"><i class="feather-sliders"></i> Display Services</a></li>
                                                <li><a href="javascript:;"><i class="feather-save"></i> 0 Review Comments</a></li>
                                                <li><a href="javascript:;"><i class="feather-trash"></i> Request A Quote</a></li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--BLock 7-->
                        <div class="col-md-6">
                            <div class="sf-vender-list-wrap">
                                <div class="sf-vender-list-box d-flex">
                                    <div class="sf-vender-list-pic" style="background-image:url(images/categories/pic7.jpg)">
                                        <a class="sf-vender-pic-link" href="profile-full.html"></a>
                                    </div>
                                    <div class="sf-vender-list-info">
                                        <h4 class="sf-venders-title"><a href="profile-full.html">Mila Kunis</a></h4>
                                        <span class="sf-venders-address"><i class="fa fa-map-marker"></i>Queens, United States</span>
                                        <div class="sf-ow-pro-rating">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star text-gray"></span>
                                        </div>
                                        <p>Through our expertise, technological knowledge, global presence and bespoke.</p>
                                        <div class="sf-pro-check"><span><i class="fa fa-check"></i></span></div>
                                        <div class="sf-pro-favorite"><a href="#"><i class="fa fa-heart-o"></i></a></div>

                                        <div class="dropdown action-dropdown dropdown-left">
                                            <button class="action-button gray dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-ellipsis-v"></i></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="javascript:;"><i class="feather-sliders"></i> Display Services</a></li>
                                                <li><a href="javascript:;"><i class="feather-save"></i> 0 Review Comments</a></li>
                                                <li><a href="javascript:;"><i class="feather-trash"></i> Request A Quote</a></li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--BLock 8-->
                        <div class="col-md-6">
                            <div class="sf-vender-list-wrap">
                                <div class="sf-vender-list-box d-flex">
                                    <div class="sf-vender-list-pic" style="background-image:url(images/categories/pic8.jpg)">
                                        <a class="sf-vender-pic-link" href="profile-full.html"></a>
                                    </div>
                                    <div class="sf-vender-list-info">
                                        <h4 class="sf-venders-title"><a href="profile-full.html">Javier Bardem</a></h4>
                                        <span class="sf-venders-address"><i class="fa fa-map-marker"></i>Queens, United States</span>
                                        <div class="sf-ow-pro-rating">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star text-gray"></span>
                                        </div>
                                        <p>Through our expertise, technological knowledge, global presence and bespoke.</p>
                                        <div class="sf-pro-check"><span><i class="fa fa-check"></i></span></div>
                                        <div class="sf-pro-favorite"><a href="#"><i class="fa fa-heart-o"></i></a></div>

                                        <div class="dropdown action-dropdown dropdown-left">
                                            <button class="action-button gray dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-ellipsis-v"></i></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="javascript:;"><i class="feather-sliders"></i> Display Services</a></li>
                                                <li><a href="javascript:;"><i class="feather-save"></i> 0 Review Comments</a></li>
                                                <li><a href="javascript:;"><i class="feather-trash"></i> Request A Quote</a></li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Pagination Start-->
                        <div class="site-pagination s-p-center">
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
                        </div>  
                        <!--Pagination End-->

                    </div>
                </div>                       
                
            </div>
        </div>
        
    </div>
    <!-- Content END-->
@endsection    