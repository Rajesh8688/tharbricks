@extends('admin.layouts.master')


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
                                    <h4 class="card-title">User Request</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <hr>
                                        <x-admin-error-list-show></x-admin-error-list-show>

                                        <form class="form"
                                              method="post"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <label for="first-name-column"> Name </label>
                                                        <div class="form-label-group">
                                                            <input type="text" id="name" class="form-control" placeholder="Name" name="name" value="{{$showUserRequest->name}}" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <label for="first-name-column"> Phone </label>
                                                        <div class="form-label-group">
                                                            <input type="text" id="name" class="form-control" placeholder=" Email" name="name" value="{{$showUserRequest->phone}}" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class= " col-12">
                                                        <label for="first-name-column">Email</label>
                                                        <div class="form-label-group">
                                                            <input type="text" id="icon" class="form-control " placeholder="icon" name="icon" value="{{$showUserRequest->email}}">
                                                        </div>
                                                    </div>
                                                    <div class= " col-12">
                                                        <label for="first-name-column">Subject</label>
                                                        <div class="form-label-group">
                                                            <input type="text" id="icon" class="form-control " placeholder="icon" name="icon" value="{{$showUserRequest->subject}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="description">Message </label>
                                                            <textarea  class="form-control" rows="8" placeholder="Description" name="description" required>{{$showUserRequest->message}}</textarea>
                                                        </div>
                                                    </div>
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
