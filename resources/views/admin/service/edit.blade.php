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
                                    <h4 class="card-title">Edit Service</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <hr>
                                        <x-admin-error-list-show></x-admin-error-list-show>

                                        <form class="form" action="{{route('service.update', $service->id)}}"
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
                                                                   placeholder="Service Name"
                                                                   name="name"
                                                                   value="{{$service->name}}" autocomplete="off">
                                                            
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
                                                            <option value = "Active" {{$service->status == 'Active' ? 'selected' : ''}}>Active</option>
                                                            <option value = "InActive"{{$service->status == 'InActive' ? 'selected' : ''}} >InActive</option>
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
                                                        <label for="first-name-column">Icon(44*44)</label>
                                                        <div class="form-label-group">
                                                            <input type="file" id="icon" class="form-control @error('icon') is-invalid @enderror" placeholder="icon" name="icon" value="{{old('icon')}}">
                                                            {{-- @error('icon')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror --}}
                                                        </div>
                                                    </div>
                                                    <div class= "col-md-6 col-12">
                                                        <label for="first-name-column">Image(601*511)</label>
                                                        <div class="form-label-group">
                                                            
                                                            <input type="file" id="image" class="form-control @error('image') is-invalid @enderror" placeholder="Image" name="image" value="{{old('image')}}">
                                                            {{-- @error('image')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class= "col-md-6 col-12">
                                                        <label for="first-name-column">Order</label>
                                                        <div class="form-label-group">
                                                            <input type="number" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" placeholder="Order" name="sort_order" value="{{$service->sort_order}}">
                                                            @error('sort_order')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="description">Description </label>
                                                            <textarea id="ckeditor" class="form-control @error('description') is-invalid @enderror" rows="5" placeholder="Description" name="description" required>{{$service->description}}</textarea>
                                                            @error('description')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
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
