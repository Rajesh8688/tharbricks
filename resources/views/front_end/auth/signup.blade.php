@extends('front_end.layouts.master')
@section('content')
    <section class="section-full " style="padding: 90px 0px">
        <div class="container">
            <!--Title Section Start-->
            <div class="section-head">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <span class="aon-sub-title">SignUp</span>
                        <h2 class="sf-title">Win local jobs and grow your business</h2>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <p>Hundreds of thousands of small businesses have found new customers on TharBricks</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8 widget rounded-sidebar-widget" >
                <div class="form-group">
                    <label>Services</label>
                    <form method="get" action="{{route('vendor-create')}}">
                        <div class= "row">
                            <div class ="col-8">
                                @csrf
                                <select class="selectpicker" multiple data-live-search="true" style="height: 10px" name="serviceId[]" required>
                                    @foreach ($services as $service)
                                    <option value ="{{$service->slug}}">{{$service->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class ="">
                                <button class="site-button aon-btn-login" type="submit"> Get Started</button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <label>Popular Service</label>
                    <div class="widget widget_tag_cloud ">                   
                        <div class="tagcloud">
                            @foreach ($services as $service)
                                <a onclick="addService('{{$service->slug}}')">{{$service->name}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
@endsection
@section('extraScripts')
<script  src="{{ asset('frontEnd/js/customAddons.js')}}"></script>
@endsection