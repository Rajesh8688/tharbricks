@extends('front_end.layouts.master')
@section('content')
    <!-- Content -->
    <div class="page-content">
                
        <!-- Banner Area -->
        {{-- <div class="aon-page-benner-area2">
        
            <div class="aon-banner-large2-title">
                Still not finding what you're looking for? View all Provider categories
            </div>
        
        </div> --}}
        <!-- Banner Area End -->
        
        <!-- All categories Block Section -->
        <div class="aon-all-categories-wrap2">
            <div class="container">
                <div class="aon-all-categories-block2">
                    <div class="row">
                        @foreach ($services as $service)
                            <div class="col-lg-4 col-md-6">
                                <?php $image = asset('uploads/services').'/'.$service->image;?>
                                <div class="aon-all-cat-block" style="background-image: url({{$image}});">
                                    <div class="aon-cat-quantity">
                                        <span><i>+</i>00</span>
                                    </div>
                                    <div class="aon-cat-name">
                                        <h3><a href="{{route('serviceDetails',['slug'=>$service->slug])}}">{{$service->name}}</a></h3>
                                    </div>
                                </div>
                            </div>
                            
                        @endforeach
                        <!--block-1-->
                       

                        
                    </div>
                </div>
            
            </div>
        </div> 
        <!-- All categories Block Section  END -->

        <!-- all cat list Section -->
        {{-- <div class="aon-all-cat-list1-wrap2">
            <div class="container">
                <div class="aon-all-cat-list1-section">
                    <div class="aon-cat-list1-title">Find Provider in Florida</div>
                    <div class="row">
                        <!--block-1-->
                        <div class="col-lg-3 col-md-6">
                            <div class="aon-all-cat-list1">
                                <ul>
                                    <li><a href="categories-detail.html">Plumber in Montgomery</a></li>
                                    <li><a href="categories-detail.html">Cleaners in Juneau</a></li>
                                    <li><a href="categories-detail.html">Machenic in Hartford</a></li>
                                    <li><a href="categories-detail.html">Yoga Teacher in Bridgeport</a></li>
                                    <li><a href="categories-detail.html">Gym Coach in Jacksonville</a></li>
                                </ul>
                            </div>
                        </div>

                        <!--block-2-->
                        <div class="col-lg-3 col-md-6">
                            <div class="aon-all-cat-list1">
                                <ul>
                                    <li><a href="categories-detail.html">Plumber in Montgomery</a></li>
                                    <li><a href="categories-detail.html">Cleaners in Juneau</a></li>
                                    <li><a href="categories-detail.html">Machenic in Hartford</a></li>
                                    <li><a href="categories-detail.html">Yoga Teacher in Bridgeport</a></li>
                                    <li><a href="categories-detail.html">Gym Coach in Jacksonville</a></li>
                                </ul>
                            </div>
                        </div>

                        <!--block-3-->
                        <div class="col-lg-3 col-md-6">
                            <div class="aon-all-cat-list1">
                                <ul>
                                    <li><a href="categories-detail.html">Plumber in Montgomery</a></li>
                                    <li><a href="categories-detail.html">Cleaners in Juneau</a></li>
                                    <li><a href="categories-detail.html">Machenic in Hartford</a></li>
                                    <li><a href="categories-detail.html">Yoga Teacher in Bridgeport</a></li>
                                    <li><a href="categories-detail.html">Gym Coach in Jacksonville</a></li>
                                </ul>
                            </div>
                        </div>

                        <!--block-4-->
                        <div class="col-lg-3 col-md-6">
                            <div class="aon-all-cat-list1">
                                <ul>
                                    <li><a href="categories-detail.html">Plumber in Montgomery</a></li>
                                    <li><a href="categories-detail.html">Cleaners in Juneau</a></li>
                                    <li><a href="categories-detail.html">Machenic in Hartford</a></li>
                                    <li><a href="categories-detail.html">Yoga Teacher in Bridgeport</a></li>
                                    <li><a href="categories-detail.html">Gym Coach in Jacksonville</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                
            </div>
        </div>  --}}
        <!-- all cat list Section  END -->

        <!-- all cat list Section -->
        {{-- <div class="aon-all-cat-list1-wrap2">
            <div class="container">
                <div class="aon-all-cat-list1-section">
                    <div class="aon-cat-list1-title">Find Provider in Australia </div>
                    <div class="row">
                        <!--block-1-->
                        <div class="col-lg-3 col-md-6">
                            <div class="aon-all-cat-list1">
                                <ul>
                                    <li><a href="categories-detail.html">Plumber in Montgomery</a></li>
                                    <li><a href="categories-detail.html">Cleaners in Juneau</a></li>
                                    <li><a href="categories-detail.html">Machenic in Hartford</a></li>
                                    <li><a href="categories-detail.html">Yoga Teacher in Bridgeport</a></li>
                                    <li><a href="categories-detail.html">Gym Coach in Jacksonville</a></li>
                                </ul>
                            </div>
                        </div>

                        <!--block-2-->
                        <div class="col-lg-3 col-md-6">
                            <div class="aon-all-cat-list1">
                                <ul>
                                    <li><a href="categories-detail.html">Plumber in Montgomery</a></li>
                                    <li><a href="categories-detail.html">Cleaners in Juneau</a></li>
                                    <li><a href="categories-detail.html">Machenic in Hartford</a></li>
                                    <li><a href="categories-detail.html">Yoga Teacher in Bridgeport</a></li>
                                    <li><a href="categories-detail.html">Gym Coach in Jacksonville</a></li>
                                </ul>
                            </div>
                        </div>

                        <!--block-3-->
                        <div class="col-lg-3 col-md-6">
                            <div class="aon-all-cat-list1">
                                <ul>
                                    <li><a href="categories-detail.html">Plumber in Montgomery</a></li>
                                    <li><a href="categories-detail.html">Cleaners in Juneau</a></li>
                                    <li><a href="categories-detail.html">Machenic in Hartford</a></li>
                                    <li><a href="categories-detail.html">Yoga Teacher in Bridgeport</a></li>
                                    <li><a href="categories-detail.html">Gym Coach in Jacksonville</a></li>
                                </ul>
                            </div>
                        </div>

                        <!--block-4-->
                        <div class="col-lg-3 col-md-6">
                            <div class="aon-all-cat-list1">
                                <ul>
                                    <li><a href="categories-detail.html">Plumber in Montgomery</a></li>
                                    <li><a href="categories-detail.html">Cleaners in Juneau</a></li>
                                    <li><a href="categories-detail.html">Machenic in Hartford</a></li>
                                    <li><a href="categories-detail.html">Yoga Teacher in Bridgeport</a></li>
                                    <li><a href="categories-detail.html">Gym Coach in Jacksonville</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                
            </div>
        </div>  --}}
        <!-- all cat list Section  END -->

        <!-- all cat list Section -->
        {{-- <div class="aon-all-cat-list1-wrap2 m-b30">
            <div class="container">
                <div class="aon-all-cat-list1-section">
                    <div class="aon-cat-list1-title">Find Provider in India</div>
                    <div class="row">
                        <!--block-1-->
                        <div class="col-lg-3 col-md-6">
                            <div class="aon-all-cat-list1">
                                <ul>
                                    <li><a href="categories-detail.html">Plumber in Montgomery</a></li>
                                    <li><a href="categories-detail.html">Cleaners in Juneau</a></li>
                                    <li><a href="categories-detail.html">Machenic in Hartford</a></li>
                                    <li><a href="categories-detail.html">Yoga Teacher in Bridgeport</a></li>
                                    <li><a href="categories-detail.html">Gym Coach in Jacksonville</a></li>
                                </ul>
                            </div>
                        </div>

                        <!--block-2-->
                        <div class="col-lg-3 col-md-6">
                            <div class="aon-all-cat-list1">
                                <ul>
                                    <li><a href="categories-detail.html">Plumber in Montgomery</a></li>
                                    <li><a href="categories-detail.html">Cleaners in Juneau</a></li>
                                    <li><a href="categories-detail.html">Machenic in Hartford</a></li>
                                    <li><a href="categories-detail.html">Yoga Teacher in Bridgeport</a></li>
                                    <li><a href="categories-detail.html">Gym Coach in Jacksonville</a></li>
                                </ul>
                            </div>
                        </div>

                        <!--block-3-->
                        <div class="col-lg-3 col-md-6">
                            <div class="aon-all-cat-list1">
                                <ul>
                                    <li><a href="categories-detail.html">Plumber in Montgomery</a></li>
                                    <li><a href="categories-detail.html">Cleaners in Juneau</a></li>
                                    <li><a href="categories-detail.html">Machenic in Hartford</a></li>
                                    <li><a href="categories-detail.html">Yoga Teacher in Bridgeport</a></li>
                                    <li><a href="categories-detail.html">Gym Coach in Jacksonville</a></li>
                                </ul>
                            </div>
                        </div>

                        <!--block-4-->
                        <div class="col-lg-3 col-md-6">
                            <div class="aon-all-cat-list1">
                                <ul>
                                    <li><a href="categories-detail.html">Plumber in Montgomery</a></li>
                                    <li><a href="categories-detail.html">Cleaners in Juneau</a></li>
                                    <li><a href="categories-detail.html">Machenic in Hartford</a></li>
                                    <li><a href="categories-detail.html">Yoga Teacher in Bridgeport</a></li>
                                    <li><a href="categories-detail.html">Gym Coach in Jacksonville</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                
            </div>
        </div>  --}}
        <!-- all cat list Section  END -->
        
    </div>
    <!-- Content END-->
@endsection