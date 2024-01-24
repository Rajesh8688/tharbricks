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
                <section class="invoice-print mb-1">
                    <div class="row">
                        <div class="col-12 col-md-12 d-flex flex-column flex-md-row justify-content-end">
                            <a href="{{route('service.create')}}" class="btn btn-primary btn-print mb-1 mb-md-0"><i
                                    class="feather icon-plus-circle"></i>&nbsp;Add Service</a>
                            </a>
                        </div>
                    </div>
                </section>

             

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
                                                    <th>Name</th>
                                                    <th>Icon</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @if(count($services) > 0)
                                                    @foreach($services as $service)
                                                        <tr>
                                                            <td>{{$service->name}}</td>
                                                            <td class="product-img">
                                                                <img
                                                                    src="{{$service->icon ?  asset('uploads/services/icons/'.$service->icon) : $noImage}} "
                                                                    width="44"/>
                                                            </td>
                                                            <td>{{$service->status}}</td>
                                                            <td>
                                                                @can('question-view')
                                                                <a href="{{ route('question.index', ['service_id' =>$service->id]) }}"><i
                                                                        class="feather icon-edit"></i> Question View</a> |
                                                                @endcan
                                                          
                                                                @can('service-update')
                                                                    <a href="{{ route('service.edit', $service->id) }}"><i
                                                                            class="feather icon-edit"></i> Edit</a> |
                                                                @endcan

                                                                @can('service-delete')
                                                                    <a href="javascript:" class="text-danger deleteBtn"
                                                                       onclick="destroy({{$service->id}})"
                                                                       data-id="{{$service->id}}"
                                                                       data-toggle="modal"
                                                                       data-target="#deleteModal" id="deleteBtn"><i
                                                                            class="feather icon-trash"></i> Delete</a>
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr align="center" class="alert alert-danger">
                                                        <td colspan="4">No Record(s)</td>
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
        function destroy(delId) {
            let url = '{{ route("service.destroy", ":id") }}';
            url = url.replace(':id', delId);
            $("#deleteForm").attr('action', url);
            $("#delete_id").val(delId);
        }
    </script>
@endsection
