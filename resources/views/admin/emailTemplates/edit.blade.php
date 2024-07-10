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
                                    <h4 class="card-title">Edit Email Template</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <hr>
                                        <x-admin-error-list-show></x-admin-error-list-show>

                                        <form class="form" action="{{route('email-template.update', $emailTemplate->id)}}"
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
                                                                   value="{{$emailTemplate->name}}" autocomplete="off">
                                                            
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
                                                            <option value = "Active" {{$emailTemplate->status == 'Active' ? 'selected' : ''}}>Active</option>
                                                            <option value = "InActive"{{$emailTemplate->status == 'InActive' ? 'selected' : ''}} >InActive</option>
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
                                                    <div class= "col-12">
                                                    
                                                        <div class="form-group">
                                                            <label for="subject">Subject </label>
                                                            <input type ="text"  class="form-control @error('subject') is-invalid @enderror"  placeholder="Subject" name="subject" required value ="{{$emailTemplate->subject}}">
                                                            @error('subject')
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
                                                            <label for="template">Template </label>
                                                            <textarea  class="form-control @error('template') is-invalid @enderror" rows="5" id= "ckeditor" placeholder="Template" name="template" required>{{$emailTemplate->template}}</textarea>
                                                            @error('template')
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
