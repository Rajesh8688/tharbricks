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

                <!-- invoice functionality start -->
                <section class="invoice-print mb-1">
                    <div class="row">
                        <fieldset class="col-12 col-md-5 mb-1 mb-md-0">&nbsp;</fieldset>
                        <div class="col-12 col-md-7 d-flex flex-column flex-md-row justify-content-end">
                            @can('question-view')
                            <a href="{{route('question.index')}}" class="btn btn-primary btn-print mb-1 mb-md-0"><i
                                    class="feather icon-list"></i>&nbsp;Go to List</a>
                            </a>
                            @endcan
                        </div>
                    </div>
                </section>

                <!-- Adding Form -->
                <section id="multiple-column-form" class="input-validation">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{$titles['subTitle']}}</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <hr>
                                        {{-- <x-admin-error-list-show></x-admin-error-list-show> --}}


                                        <form class="form-horizontal" action="{{route('question.update',$question->id)}}" method="post"
                                              enctype="multipart/form-data" >
                                            @csrf
                                            @method('PUT')
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="question_text">Question Text </label>
                                                            <input type="text" id="question_text" class="form-control @error('question_text') is-invalid @enderror" placeholder="Question Text" name="question_text" value="{{$question->question_text}}" autocomplete="off" required>
                                                            @error('question_text')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <label for="first-name-column">Status</label>
                                                        <div class="form-label-group">
                                                        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                                            <option value = "" >Select Status</option>
                                                            <option value = "Active" {{$question->status == 'Active' ? 'selected' : ''}}>Active</option>
                                                            <option value = "InActive"{{$question->status == 'InActive' ? 'selected' : ''}} >InActive</option>
                                                        </select>
                                                        @error('status')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                  
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="order">Order</label>
                                                            <input type="number" id="order" class="form-control @error('order') is-invalid @enderror" placeholder="Order" name="order" value="{{$question->order}}" autocomplete="off" required>
                                                            @error('order')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <label for="first-name-column">Service</label>
                                                        <div class="form-label-group">
                                                        <select name="service_id" class="form-control @error('service_id') is-invalid @enderror" required id = "service_id">
                                                            <option value = "" >Select Service</option>
                                                            @foreach($services as $service)
                                                                <option value = "{{$service->id}}" {{$question->service_id == $service->id ? 'selected' : ''}}>{{$service->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('service_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                  
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6 col-12"> 
                                                        <div class="form-label-group">
                                                            <div class="custom-control custom-switch mr-2 mb-1">
                                                                <p class="mb-0">show Others </p>
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="customSwitch4"
                                                                    name="maintenance"
                                                                    value="1" {{$question->show_other_option ? 'checked' : ''}}>
                                                                <label class="custom-control-label"
                                                                    for="customSwitch4"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <label for="first-name-column">Next Question</label>
                                                        <div class="form-label-group">
                                                        <select name="next_question_id" class="form-control  questionDropdown"  >
                                                            <option value = "" >Select next Question</option>
                                                            @forEach($serviceQuestions as $serviceQ)
                                                            <option value = "{{$serviceQ->id}}" {{$serviceQ->id == $question->next_question_id ? 'selected' : ''}}>{{$serviceQ->question_text}}</option>

                                                            @endforeach
                                                        </select>
                                                        
                                                  
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="description">Type </label>

                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                    <ul class="list-unstyled mb-0">
                                                                        <li class="d-inline-block mr-2">
                                                                            <fieldset>
                                                                                <div class="custom-control custom-radio">
                                                                                    <input type="radio" class="custom-control-input @error('type') is-invalid @enderror typeclass" name="type" id="customRadio1" value="input" {{ $question->type == 'input' ? 'checked' : '' }} required>
                                                                                    <label class="custom-control-label" for="customRadio1">Input</label>
                                                                                </div>
                                                                            </fieldset>
                                                                        </li>
                                                                        <li class="d-inline-block mr-2">
                                                                            <fieldset>
                                                                                <div class="custom-control custom-radio">
                                                                                    <input type="radio" class="custom-control-input @error('type') is-invalid @enderror typeclass" name="type" id="customRadio4" value="date" {{ $question->type == 'date' ? 'checked' : '' }} required>
                                                                                    <label class="custom-control-label" for="customRadio4">Date</label>
                                                                                </div>
                                                                            </fieldset>
                                                                        </li>
                                                                        <li class="d-inline-block mr-2">
                                                                            <fieldset>
                                                                                <div class="custom-control custom-radio">
                                                                                    <input type="radio" class="custom-control-input @error('type') is-invalid @enderror typeclass" name="type" id="customRadio2" value="imageRadio" {{ $question->type == 'imageRadio' ? 'checked' : '' }} required>
                                                                                    <label class="custom-control-label" for="customRadio2">Image Radio</label>
                                                                                </div>
                                                                            </fieldset>
                                                                        </li>
                                                                    
                                                                        <li class="d-inline-block mr-2">
                                                                            <fieldset>
                                                                                <div class="custom-control custom-radio">
                                                                                    <input type="radio" class="custom-control-input @error('type') is-invalid @enderror typeclass" name="type" id="customRadio3" value="normalRadio" {{ $question->type == 'normalRadio' ? 'checked' : '' }} required>
                                                                                    <label class="custom-control-label" for="customRadio3">Normal Radio</label>
                                                                                </div>
                                                                            </fieldset>
                                                                        </li>
                                                                        
                                                                    
                                                                        <li class="d-inline-block mr-2">
                                                                            <fieldset>
                                                                                <div class="custom-control custom-radio">
                                                                                    <input type="radio" class="custom-control-input @error('type') is-invalid @enderror typeclass" name="type" id="customRadio5" value="multiSelect" {{ $question->type == 'multiSelect' ? 'checked' : '' }} required>
                                                                                    <label class="custom-control-label" for="customRadio5">Multi Select</label>
                                                                                </div>
                                                                            </fieldset>
                                                                        </li>
                                                                        {{-- <li class="d-inline-block mr-2">
                                                                            <fieldset>
                                                                                <div class="custom-control custom-radio">
                                                                                    <input type="radio" class="custom-control-input @error('type') is-invalid @enderror typeclass" name="type" id="customRadio6" value="decisionMaking" {{ $question->type == 'decisionMaking' ? 'checked' : '' }} required>
                                                                                    <label class="custom-control-label" for="customRadio6">Decision Making</label>
                                                                                </div>
                                                                            </fieldset>
                                                                        </li> --}}
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                         
                                                           
                                                        </div>
                                                        @error('type')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    </div>
                                                </div>    
                                                <div class="typeDiv">
                                                    @if($question->type == 'imageRadio')
                                                        <div class= "row imageRadio">
                                                            <div class="col-12">
                                                                <div class="table-responsive border rounded px-1 pb-1">
                                                                    <h6 class="border-bottom py-2 mx-2 mb-0 font-medium-5"><i class="feather icon-lock mr-50 "></i>Image Radio  <button type="button" class="btn btn-primary mr-1" onclick="addimageRadio()" style="float: right"> Add</button>
                                                                    </h6>
                                                                    <div id = "imageRadioId">
                                                                        @forEach($questionOptions as $IRK=>$option)
                                                                        <?php $id = "subimageRadioId".$IRK;?>
                                                                        <div class="row px-1 pt-1" id="{{$id}}" >
                                                                            <input type="hidden" name="question_option_ir_id[]" value = "{{$option->id}}">
                                                                            <div class="col-3">
                                                                                <input type="text"  class="form-control" placeholder="Option Name" name="question_option_ir_text[]"  autocomplete="off" required value="{{$option->option_text}}">
                                                                            </div>
                                                                            <div class="col-3">
                                                                                <input type="file" id="image" class="form-control" placeholder="Image" name="question_image[]" value="{{$option->image}}">
                                                                            </div>
                                                                            <div class="col-3">
                                                                                <select name="question_option_ir_next_question_id[]" class="form-control questionDropdown " >
                                                                                    <option value = "" >Select next Question</option>
                                                                                    @foreach ($serviceQuestions as $citem)
                                                                                    <option value = "{{$citem->id}}" {{$option->next_question_id == $citem->id ? 'selected' : ''}}>{{$citem->question_text}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>

                                                                            @if($IRK != 0)
                                                                                <div class="col-2">
                                                                                    <button type="button" class="btn btn-danger mr-1" onClick="removeimageRadio('{{$id}}')"> Remove</button>
                                                                                </div>
                                                                            @endif

                                                                            
                                                                        </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if($question->type == 'normalRadio')
                                                        <div class= "row normalRadio">
                                                            <div class="col-12">
                                                                <div class="table-responsive border rounded px-1 pb-1">
                                                                    <h6 class="border-bottom py-2 mx-2 mb-0 font-medium-5"><i class="feather icon-lock mr-50 "></i>Normal Radio  <button type="button" class="btn btn-primary mr-1" onclick="addnormalRadio()" style="float: right"> Add</button>
                                                                    </h6>
                                                                    
                                                                    <div id = "normalRadioId">
                                                                        @forEach($questionOptions as $NRK=>$nroption)
                                                                        <?php $id = "normalRadioId".$NRK;?>
                                                                        <div class="row px-1 pt-1" id="{{$id}}" >
                                                                            <input type="hidden" name="question_option_nr_id[]" value = "{{$nroption->id}}">
                                                                            <div class="col-6">
                                                                                <input type="text"  class="form-control" placeholder="Option Name" name="question_option_nr_text[]" autocomplete="off" required value = "{{$nroption->option_text}}">
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <select name="question_option_nr_next_question_id[]" class="form-control questionDropdown " >
                                                                                    <option value = "" >Select next Question</option>
                                                                                    @foreach ($serviceQuestions as $citem)
                                                                                    <option value = "{{$citem->id}}" {{$nroption->next_question_id == $citem->id ? 'selected' : ''}}>{{$citem->question_text}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            @if($NRK != 0)
                                                                                <div class="col-2">
                                                                                    <button type="button" class="btn btn-danger mr-1" onClick="removenormalRadio('{{$id}}')"> Remove</button>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                        @endforeach
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if($question->type == 'multiSelect')
                                                        <div class= "row multiSelect">
                                                            <div class="col-12">
                                                                <div class="table-responsive border rounded px-1 pb-1">
                                                                    <h6 class="border-bottom py-2 mx-2 mb-0 font-medium-5"><i class="feather icon-lock mr-50 "></i>Multi Select  <button type="button" class="btn btn-primary mr-1" onclick="addmultiSelect()" style="float: right"> Add</button>
                                                                    </h6>
                                                                    <div id = "multiSelectId">
                                                                        @forEach($questionOptions as $MSK=>$msoption)
                                                                        <?php $id = "submultiSelectId".$MSK;?>
                                                                        <input type="hidden" name="question_option_ms_id[]" value = "{{$msoption->id}}">
                                                                        <div class="row px-1 pt-1" id="{{$id}}" >
                                                                            <div class="col-6">
                                                                                <input type="text"  class="form-control" placeholder="Option Name" name="question_option_ms_text[]" autocomplete="off" required value ="{{$msoption->option_text}}">
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <select name="question_option_ms_next_question_id[]" class="form-control questionDropdown " >
                                                                                    <option value = "" >Select Next Question</option>
                                                                                    @foreach ($serviceQuestions as $citem)
                                                                                    <option value = "{{$citem->id}}" {{$msoption->next_question_id == $citem->id ? 'selected' : ''}}>{{$citem->question_text}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            @if($MSK != 0)
                                                                            <div class="col-2">
                                                                                <button type="button" class="btn btn-danger mr-1" onClick="removemultiSelect('{{$id}}')"> Remove</button>
                                                                            </div>
                                                                            @endif
                                                                            
                                                                        </div>
                                                                        @endforeach
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    {{-- @if($question->type == 'decisionMaking')
                                                        <div class= "row decisionMaking">
                                                            <div class="col-12">
                                                                <div class="table-responsive border rounded px-1 pb-1">
                                                                    <h6 class="border-bottom py-2 mx-2 mb-0 font-medium-5"><i class="feather icon-lock mr-50 "></i>DecisionMaking<button type="button" class="btn btn-primary mr-1" onclick="adddecisionMaking()" style="float: right"> Add</button>
                                                                    </h6>
                                                                    <div id = "decisionMakingId">
                                                                        @forEach($questionOptions as $DMK=>$dmoption)
                                                                        <?php //$id = "submultiSelectId".$DMK;?>
                                                                            <div class="row px-1 pt-1" id="{{$id}}">
                                                                                <input type="hidden" name="question_option_dm_id[]" value = "{{$dmoption->id}}">
                                                                                <div class="col-5">
                                                                                    <input type="text"  class="form-control" placeholder="Option Name" name="question_option_dm_text[]" autocomplete="off" required value = "{{$dmoption->option_text}}">
                                                                                </div>
                                                                                <div class="col-5">
                                                                                    <select name="question_option_next_question_id[]" class="form-control questionDropdown " >
                                                                                        <option value = "" >Select next Question</option>
                                                                                        @foreach ($serviceQuestions as $citem)
                                                                                        <option value = "{{$citem->id}}" {{$dmoption->next_question_id == $citem->id ? 'selected' : ''}}>{{$citem->question_text}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                @if($DMK != 0)
                                                                                <div class="col-2">
                                                                                    <button type="button" class="btn btn-danger mr-1" onClick="removedecisionMaking('{{$id}}')"> Remove</button>
                                                                                </div>
                                                                                @endif
                                                                            </div>
                                                                        @endforeach
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif --}}


                                                </div>
                                              
                                                <div>&nbsp;</div>
                                                <div class="col-md-8 offset-md-4">
                                                    <button type="submit"
                                                            class="btn btn-primary mr-1 mb-1">Save
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


        @if(session('success'))
        toastr.success('{{session('success')}}', 'Success');
        @endif
        @if(session('error'))
        toastr.error('{{session('error')}}', 'Error');
        @endif

        function addimageRadio(){
            var Id = "subimageRadioId" + generateUniqueId();
            var className = "questionDropDown"+generateUniqueId();

            $html = `<div class="row px-1 pt-1" id= "`+Id+`">
                        <div class="col-3">
                            <input type="text" class="form-control" placeholder="Option Name" name="question_option_ir_text[]"  autocomplete="off" required>
                        </div>
                        <div class="col-3">
                            <input type="file" class="form-control" placeholder="Image" name="question_image[]" required>
                        </div>
                        <div class="col-3">
                            <select name="question_option_ir_next_question_id[]" class="form-control questionDropdown `+className+`" >
                                <option value = "" >Select next Question</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-danger mr-1" onClick="removeimageRadio('`+Id+`')"> Remove</button>
                        </div>
                    </div>`;
            $("#imageRadioId").append($html);
            $selectedService = $('#service_id').val();
            QuestionDropdown($selectedService,className);
        }
        function removeimageRadio(id){          
            $("#"+id).remove();
        }

        function addnormalRadio(){
            var Id = "subnormalRadioId" + generateUniqueId();
            var className = "questionDropDown"+generateUniqueId();

            $html = `<div class="row px-1 pt-1" id= "`+Id+`">
                        <div class="col-6">
                            <input type="text" class="form-control" placeholder="Option Name" name="question_option_nr_text[]"  autocomplete="off" required>
                        </div>
                        <div class="col-4">
                            <select name="question_option_nr_next_question_id[]" class="form-control questionDropdown `+className+`" >
                                <option value = "" >Select next Question</option>
                            </select>
                        </div>
                       
                        <div class="col-2">
                            <button type="button" class="btn btn-danger mr-1" onClick="removenormalRadio('`+Id+`')"> Remove</button>
                        </div>
                    </div>`;

            $("#normalRadioId").append($html);
            $selectedService = $('#service_id').val();
            QuestionDropdown($selectedService,className);
        }
        function removenormalRadio(id){          
            $("#"+id).remove();
        }

        function addmultiSelect(){
            var Id = "submultiSelectId" + generateUniqueId();
            var className = "questionDropDown"+generateUniqueId();

            $html = `<div class="row px-1 pt-1" id= "`+Id+`">
                        <div class="col-6">
                            <input type="text" class="form-control" placeholder="Option Name" name="question_option_ms_text[]"  autocomplete="off" required>
                        </div>
                        <div class="col-4">
                            <select name="question_option_ms_next_question_id[]" class="form-control questionDropdown `+className+`" >
                                <option value = "" >Select next Question</option>
                            </select>
                        </div>
                       
                        <div class="col-2">
                            <button type="button" class="btn btn-danger mr-1" onClick="removemultiSelect('`+Id+`')"> Remove</button>
                        </div>
                    </div>`;

            $("#multiSelectId").append($html);
            $selectedService = $('#service_id').val();
            QuestionDropdown($selectedService,className);
        }
        function removemultiSelect(id){          
            $("#"+id).remove();
        }

        function adddecisionMaking(){
            var Id = "subdecisionMakingId" + generateUniqueId();
            var className = "questionDropDown"+generateUniqueId();

            $html = `<div class="row px-1 pt-1" id= "`+Id+`">
                        <div class="col-5">
                            <input type="text" class="form-control" placeholder="Option Name" name="question_option_dm_text[]"  autocomplete="off" required>
                        </div>
                        <div class="col-5">
                            <select name="question_option_next_question_id[]" class="form-control questionDropdown `+className+`" >
                                <option value = "" >Select next Question</option>
                            </select>
                        </div>
                       
                        <div class="col-2">
                            <button type="button" class="btn btn-danger mr-1" onClick="removedecisionMaking('`+Id+`')"> Remove</button>
                        </div>
                    </div>`;

            $("#decisionMakingId").append($html);
            $selectedService = $('#service_id').val();
            QuestionDropdown($selectedService,className);
        }
        function removedecisionMaking(id){          
            $("#"+id).remove();
        }

        $(document).ready(function() {
            

            $("input[name$='type']").click(function() {
                var test = $(this).val();
                $(".imageRadio").hide();
                $(".normalRadio").hide();
                $(".multiSelect").hide();

                if(test == 'imageRadio'){
                    $html = `<div class= "row imageRadio">
                                <div class="col-12">
                                    <div class="table-responsive border rounded px-1 pb-1">
                                        <h6 class="border-bottom py-2 mx-2 mb-0 font-medium-5"><i class="feather icon-lock mr-50 "></i>Image Radio  <button type="button" class="btn btn-primary mr-1" onclick="addimageRadio()" style="float: right"> Add</button>
                                        </h6>
                                        <div id = "imageRadioId">
                                            <div class="row px-1 pt-1" >
                                                <div class="col-6">
                                                    <input type="text"  class="form-control" placeholder="Option Name" name="question_option_ir_text[]"  autocomplete="off" required>
                                                </div>
                                                <div class="col-5">
                                                    <input type="file" id="image" class="form-control" placeholder="Image" name="question_image[]" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    $(".typeDiv").html($html);
                }else if(test == 'normalRadio'){
                    $html = `<div class= "row normalRadio">
                                <div class="col-12">
                                    <div class="table-responsive border rounded px-1 pb-1">
                                        <h6 class="border-bottom py-2 mx-2 mb-0 font-medium-5"><i class="feather icon-lock mr-50 "></i>Normal Radio  <button type="button" class="btn btn-primary mr-1" onclick="addnormalRadio()" style="float: right"> Add</button>
                                        </h6>
                                        <div id = "normalRadioId">
                                            <div class="row px-1 pt-1" >
                                                <div class="col-9">
                                                    <input type="text"  class="form-control" placeholder="Option Name" name="question_option_nr_text[]" autocomplete="off" required>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    $(".typeDiv").html($html);
                }else if(test == 'multiSelect'){
                    $html = `<div class= "row multiSelect">
                                <div class="col-12">
                                    <div class="table-responsive border rounded px-1 pb-1">
                                        <h6 class="border-bottom py-2 mx-2 mb-0 font-medium-5"><i class="feather icon-lock mr-50 "></i>Multi Select  <button type="button" class="btn btn-primary mr-1" onclick="addmultiSelect()" style="float: right"> Add</button>
                                        </h6>
                                        <div id = "multiSelectId">
                                            <div class="row px-1 pt-1" >
                                                <div class="col-9">
                                                    <input type="text"  class="form-control" placeholder="Option Name" name="question_option_ms_text[]" autocomplete="off" required>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    $(".typeDiv").html($html);
                }else if(test == 'decisionMaking'){
                    var className = "questionDropDown"+generateUniqueId();
                    $html = `<div class= "row decisionMaking">
                                <div class="col-12">
                                    <div class="table-responsive border rounded px-1 pb-1">
                                        <h6 class="border-bottom py-2 mx-2 mb-0 font-medium-5"><i class="feather icon-lock mr-50 "></i>DecisionMaking<button type="button" class="btn btn-primary mr-1" onclick="adddecisionMaking()" style="float: right"> Add</button>
                                        </h6>
                                        <div id = "decisionMakingId">
                                            <div class="row px-1 pt-1" >
                                                <div class="col-5">
                                                    <input type="text"  class="form-control" placeholder="Option Name" name="question_option_dm_text[]" autocomplete="off" required>
                                                </div>
                                                <div class="col-5">
                                                    <select name="question_option_next_question_id[]" class="form-control questionDropdown `+className+`" >
                                                        <option value = "" >Select next Question</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    $(".typeDiv").html($html);
                    $selectedService = $('#service_id').val();
                    QuestionDropdown($selectedService,className);
                }
            });
            $('#service_id').on('change', function () {
                var selectedService = $(this).val();
                QuestionDropdown(selectedService);
            });
    });

    function QuestionDropdown(selectedService,className = 'questionDropdown'){
        var url = '{{route("getServiceQuestions")}}';
        var questionId = '{{$question->id}}';
         // Make an AJAX request to get the options for the second dropdown
         $.ajax({
                url: url,
                type: 'GET',
                data :{
                    'service_id' : selectedService,
                    'question_id' : questionId
                },
                success: function (response) {
                    // Update the options in the second dropdown
                    var questionDropdown = $('.'+className);
                    questionDropdown.empty();

                    console.log(response);
                    questionDropdown.append($('<option>').text("Select Next Question").attr('value', ""));
                    $.each(response.options, function (key, value) {
                        questionDropdown.append($('<option>').text(value).attr('value', key));
                    });
                },
                error: function (error) {
                    console.error('Error updating options:', error);
                }
            });
    }
    

        
    </script>
@endsection
