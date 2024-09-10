@extends('admin.layouts.master')

@section('content')

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <x-admin-breadcrumb :title="$title"></x-admin-breadcrumb>
            </div>
            <div class="content-body">


                <!-- Form Starts -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">General Info</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" method="post" action="{{route('admin.settings.update')}}">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="sitename" class="form-control"
                                                                   placeholder="Website Name"
                                                                   name="sitename"
                                                                   value="{{$settings->sitename}}">
                                                            <label for="first-name-column">Website Name
                                                                </label>
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <div class="custom-control custom-switch mr-2 mb-1">
                                                                <p class="mb-0">Website Status</p>
                                                                <input type="checkbox" class="custom-control-input"
                                                                       id="customSwitch3"
                                                                       value="1" {{$settings->web_status ? 'checked' : ''}}>
                                                                <label class="custom-control-label"
                                                                       for="customSwitch3"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12"> 
                                                        <div class="form-label-group">
                                                            <div class="custom-control custom-switch mr-2 mb-1">
                                                                <p class="mb-0">Maintenance</p>
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="customSwitch4"
                                                                    name="maintenance"
                                                                    value="1" {{$settings->maintenance ? 'checked' : ''}}>
                                                                <label class="custom-control-label"
                                                                    for="customSwitch4"></label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="app_ios_url" class="form-control"
                                                                   name="app_ios_url" placeholder="App store Link"
                                                                   value="{{$settings->app_ios_url}}">
                                                            <label for="company-column">App store Link (iOS)</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="app_android_url" class="form-control"
                                                                   name="app_android_url" placeholder="Play store Link"
                                                                   value="{{$settings->app_android_url}}">
                                                            <label for="company-column">Play store Link
                                                                (Android)</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="app_ios_version" class="form-control"
                                                                   name="app_ios_version" placeholder="App store Version"
                                                                   value="{{$settings->app_ios_version}}">
                                                            <label for="company-column">App store Version (iOS)</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="app_android_version" class="form-control"
                                                                   name="app_android_version" placeholder="Play store App Version"
                                                                   value="{{$settings->app_android_version}}">
                                                            <label for="company-column">Play store Version
                                                                (Android)</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="port" class="form-control"
                                                                   name="email" placeholder="Email"
                                                                   value="{{$settings->email}}">
                                                            <label for="Email">Email</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="port" class="form-control"
                                                                   name="x_url" placeholder="X Url"
                                                                   value="{{$settings->x_url}}">
                                                            <label for="x_url">X Url</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="number" id="port" class="form-control"
                                                                   name="whatsapp_number" placeholder="Whatsapp Number"
                                                                   value="{{$settings->whatsapp_number}}">
                                                            <label for="whatsapp_number">Whatsapp Number</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="port" class="form-control"
                                                                   name="facebook_url" placeholder="Facebook Url"
                                                                   value="{{$settings->facebook_url}}">
                                                            <label for="facebook_url">Facebook Url</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="port" class="form-control"
                                                                   name="instagram_url" placeholder="Instagram Url"
                                                                   value="{{$settings->instagram_url}}">
                                                            <label for="instagram_url">Instagram Url</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="number" id="port" class="form-control"
                                                                   name="phone_number" placeholder="Phone number"
                                                                   value="{{$settings->phone_number}}">
                                                            <label for="host">Phone Number</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="number" id="port" class="form-control"
                                                                   name="linked_in_url" placeholder="LinkedIn Url"
                                                                   value="{{$settings->linked_in_url}}">
                                                            <label for="host">LinkedIn Url</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                            
                                                        <div class="form-group">
                                                            <label for="address">Address </label>
                                                            <textarea class="form-control " rows="5" placeholder="Address" name="address" required="" >{{$settings->address}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                               

                                                <p>
                                                <!-- <h3>Email Configuration</h3></p>

                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="host" class="form-control"
                                                                   name="host" placeholder="Host"
                                                                   value="{{$settings->host}}">
                                                            <label for="host">Host</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="port" class="form-control"
                                                                   name="port" placeholder="Port"
                                                                   value="{{$settings->port}}">
                                                            <label for="host">Port</label>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="from_name" class="form-control"
                                                                   name="from_name" placeholder="Email From Name"
                                                                   value="{{$settings->from_name}}">
                                                            <label for="host">Email From Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="smtp_password" class="form-control"
                                                                   name="smtp_password" placeholder="SMTP Password"
                                                                   value="{{$settings->smtp_password}}">
                                                            <label for="host">SMTP Password</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="smtp_encryption" class="form-control"
                                                                   name="smtp_encryption" placeholder="SMTP Encryption"
                                                                   value="{{$settings->smtp_encryption}}">
                                                            <label for="host">SMTP Encryption</label>
                                                        </div>
                                                    </div>
                                                </div> -->

                                                <div>&nbsp;</div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Save
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Form Ends -->

            </div>
        </div>
    </div>

@endsection


@section('scripts')
    <script>
        @if(session('success'))
        toastr.success('{{session('success')}}', 'Success');
        @endif
    </script>
@endsection
