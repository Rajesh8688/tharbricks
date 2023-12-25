@extends('admin.layouts.master')

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- page users view start -->
                <section class="page-users-view">
                    <div class="row">
                      
                        <!-- information start -->
                        <div class="col-12 ">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title mb-2">Information</div>
                                </div>
                                <div class="card-body">
                                    <table>
                                        <tr>
                                            <td class="font-weight-bold">Birth Date </td>
                                            <td>28 January 1998
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Mobile</td>
                                            <td>+65958951757</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Website</td>
                                            <td>https://rowboat.com/insititious/Angelo
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Languages</td>
                                            <td>English, Arabic
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Gender</td>
                                            <td>female</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Contact</td>
                                            <td>email, message, phone
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- information start -->
                       
                
                    </div>
                </section>
                <!-- page users view end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection

@section('extrascript')

<script src="{{asset('admin-assets/js/scripts/pages/app-user.js')}}"></script>

@endsection


