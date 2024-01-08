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
                            <a href="{{route('question.create')}}" class="btn btn-primary btn-print mb-1 mb-md-0"><i
                                    class="feather icon-plus-circle"></i>&nbsp;Add Question</a>
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
                                                    <th>Question</th>
                                                    <th>Type</th>
                                                    <th>Category</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @if(count($questions) > 0)
                                                    @foreach($questions as $question)
                                                        <tr>
                                                            <td>{{$question->question_text}}</td>
                                                            <td>@if($question->type == "imageRadio")
                                                                {{"Image Radio"}}
                                                                @elseif($question->type == "normalRadio")
                                                                {{"Normal Radio"}}
                                                                @elseif($question->type == "multiSelect")
                                                                {{"Multi Select"}}
                                                                @else
                                                                {{ucfirst($question->type)}}
                                                                @endif
                                                            </td>
                                                            <td>{{$question->category->name}}</td>
                                                            
                                                            <td>{{$question->status}}</td>
                                                            <td>
                                                          
                                                                @can('question-update')
                                                                    <a href="{{ route('question.edit', $question->id) }}"><i
                                                                            class="feather icon-edit"></i> Edit</a> |
                                                                @endcan
                                                               

                                                                @can('question-delete')
                                                                    <a href="javascript:" class="text-danger deleteBtn"
                                                                       onclick="destroy({{$question->id}})"
                                                                       data-id="{{$question->id}}"
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
            let url = '{{ route("question.destroy", ":id") }}';
            url = url.replace(':id', delId);
            $("#deleteForm").attr('action', url);
            $("#delete_id").val(delId);
        }
    </script>
@endsection
