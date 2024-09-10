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
                <!-- List Datatable Starts -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{$titles['listTitle']}}</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table zero-configuration">
                                                <thead>
                                                <tr>
                                                    <th>LeadId</th>
                                                    <th>Name</th>
                                                    {{-- <th>Image</th> --}}
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Status</th>
                                           
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @if(count($customers) > 0)
                                                    @foreach($customers as $customer)
                                                        <tr>
                                                            <td>{{$customer->unique_id}}</td>
                                                            <td>{{$customer->name}}</td>
                                                            {{-- <td class="product-img">
                                                                <img 
                                                                    src="{{$vendor->vendorDetails->company_logo ?  asset('uploads/company/'.$vendor->vendorDetails->company_logo) : $noImage}} "
                                                                    width="44"/>
                                                            </td> --}}
                                                            <td>{{$customer->email}}</td>
                                                            <td>{{$customer->phone}}</td>
                                                            <td>{{$customer->status}}</td>
                                                            
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr align="center" class="alert alert-danger">
                                                        <td colspan="5">No Record(s)</td>
                                                    </tr>
                                                @endif

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- List Datatable Ends -->
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
        toastr.success('{{session('success')}}', 'success');
        @endif
        @if(session('error'))
        toastr.error('{{session('error')}}', 'error');
        @endif

        // Functionality section
        // function destroy(delId) {
        //     let url = '{{ route("vendor.destroy", ":id") }}';
        //     url = url.replace(':id', delId);
        //     $("#deleteForm").attr('action', url);
        //     $("#delete_id").val(delId);
        // }
    </script>
@endsection
