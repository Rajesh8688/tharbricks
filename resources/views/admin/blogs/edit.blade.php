@extends('admin.layouts.master')

@section('extrastyle')
    <!-- Drop Zone Styles -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin-assets/vendors/css/file-uploaders/dropzone.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-assets/css/plugins/file-uploaders/dropzone.css')}}">
@endsection

@section('content')

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <x-admin-breadcrumb :title="$titles['title']"></x-admin-breadcrumb>
            </div>
            <div class="content-body">

                <!-- Adding Form -->
                <section id="multiple-column-form" class="bootstrap-select">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Blog</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <hr>
                                        <x-admin-error-list-show></x-admin-error-list-show>

                                        <form class="form" action="{{route('blogs.update', $blog->id)}}"
                                              method="post"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-body">
                                                <div class="row">

                                                    <div class="col-md-6 col-12">
                                                        <label for="first-name-column"> Name </label>
                                                        <div class="form-label-group">
                                                            
                                                            <input type="text" id="name" class="form-control"
                                                                   placeholder="Name"
                                                                   name="name"
                                                                   value="{{$blog->name}}" autocomplete="off">
                                                            
                                                            @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <label for="first-name-column">Status</label>
                                                        <div class="form-label-group">
                                                        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                                            <option value = "" >Select Status</option>
                                                            <option value = "Active" {{$blog->status == 'Active' ? 'selected' : ''}}>Active</option>
                                                            <option value = "InActive"{{$blog->status == 'InActive' ? 'selected' : ''}} >InActive</option>
                                                        </select>
                                                        @error('status')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                  
                                                        </div>
                                                    </div>
                                                </div>    
                                                <div class="row">
                                                    <div class= "col-md-6 col-12">
                                                      
                                                            <label for="first-name-column">Image(836*446)</label>
                                                            <div class="form-label-group">
                                                                
                                                                <input type="file" id="image" class="form-control @error('image') is-invalid @enderror" placeholder="Image" name="image" value="{{old('image')}}">
                                                                {{-- @error('image')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror --}}
                                                                
                                                            </div>
                                                    
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <label for="first-name-column">Service</label>
                                                        <div class="form-label-group">
                                                        <select name="service_id" class="form-control @error('service_id') is-invalid @enderror" required>
                                                            <option value = "" >Select Service</option>
                                                            @foreach ($services as $service)
                                                            <option value = "{{$service->id}}" {{$blog->service_id == $service->id ? 'selected' : ''}}>{{$service->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('service_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    
                                                    <div class= "col-md-6 col-12">
                                                        <label for="first-name-column">Tags(plaese add with Comma (,))</label>
                                                        <div class="form-label-group">
                                                            <input type="text" id="tags" class="form-control " placeholder="Tags" name="tags" value="{{$blog->tags}}" autocomplete="off" required >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <label for="first-name-column">User Name</label>
                                                        <div class="form-label-group">
                                                            <input type="text" id="user_name" class="form-control @error('user_name') is-invalid @enderror" placeholder="User Name" name="user_name" value="{{$blog->user_name}}" autocomplete="off" required>
                                                            @error('user_name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                    <div class="row">
                                                        <div class= "col-12">
                                                        
                                                            <div class="form-group">
                                                                <label for="description">Description </label>
                                                                <textarea  class="form-control @error('description') is-invalid @enderror" rows="5" id= "ckeditor" placeholder="Description" name="description" required>{{$blog->description}}</textarea>
                                                                @error('description')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>  
                                                    

                                                <div>&nbsp;</div>
                                                <div class="col-md-8 offset-md-4">
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

                <!-- Adding Form Ends -->

            </div>
        </div>
    </div>

@endsection

@section('extrascript')
    <script>
        $('.zero-configuration').DataTable(
            {
                "displayLength": 50,
            }
        );

        @if(session('success'))
        toastr.success('{{session('success')}}', 'Success');
        @endif
        @if(session('error'))
        toastr.error('{{session('error')}}', 'Error');
        @endif

    </script>
@endsection
