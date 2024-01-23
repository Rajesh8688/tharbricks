@extends('admin.layouts.master')

@section('extrastyle')

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
                            @can('plan-view')
                            <a href="{{route('plan.index')}}" class="btn btn-primary btn-print mb-1 mb-md-0"><i
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

                                        <form class="form-horizontal" action="{{route('plan.update',$plan->id)}}" method="post"
                                            enctype="multipart/form-data" >
                                          @csrf
                                          @method('PUT')
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="name"> Plan Name  </label>
                                                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Plan Name" name="name" value="{{$plan->name}}" autocomplete="off" required>
                                                            @error('name')
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
                                                            <option value = "Active" {{$plan->status == 'Active' ? 'selected' : ''}}>Active</option>
                                                            <option value = "InActive"{{$plan->status == 'InActive' ? 'selected' : ''}} >InActive</option>
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
                                                            <input type="number" id="order" class="form-control @error('order') is-invalid @enderror" placeholder="Order" name="order" value="{{$plan->order}}" autocomplete="off" required>
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
                                                        <div class="form-group">
                                                            <label for="monthly_amount">Monthly Amount</label>
                                                            <input type="number" id="monthly_amount" class="form-control @error('monthly_amount') is-invalid @enderror" placeholder="Monthly Amount" name="monthly_amount" value="{{$plan->monthly_amount}}" autocomplete="off" required>
                                                            @error('monthly_amount')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label for="yearly_amount">Yearly Amount</label>
                                                            <input type="number" id="yearly_amount" class="form-control @error('yearly_amount') is-invalid @enderror" placeholder="Yearly Amount" name="yearly_amount" value="{{$plan->yearly_amount}}" autocomplete="off" required>
                                                            @error('yearly_amount')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class= "row ">
                                                    <div class="col-12">
                                                        <div class="table-responsive border rounded px-1 pb-1">
                                                            <h6 class="border-bottom py-2 mx-2 mb-0 font-medium-5"><i class="feather icon-lock mr-50 "></i>Details  <button type="button" class="btn btn-primary mr-1" onclick="addDetails()" style="float: right"> Add</button>
                                                            </h6>

                                                          
                                                                        
                                                            <div id = "DeatailsId">
                                                                @forEach($planDetails as $NRK=>$details)
                                                                <?php $id = "subDeatilsId".$NRK;?>
                                                                <div class="row px-1 pt-1" id="{{$id}}" >
                                                                    <input type="hidden" name="plan_details_id[]" value = "{{$details->id}}">
                                                                    <div class="col-6">
                                                                        <input type="text"  class="form-control" placeholder="Deatil title" name="plan_details[]" autocomplete="off" required value = "{{$details->title}}">
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <input type="number" class="form-control" placeholder="Details Order" name="plan_details_order[]"  autocomplete="off" required value = "{{$details->order}}">
                                                                    </div>
                                                                    
                                                                    @if($NRK != 0)
                                                                        <div class="col-2">
                                                                            <button type="button" class="btn btn-danger mr-1" onClick="removeDetails('{{$id}}')"> Remove</button>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                @endforeach
                                                                
                                                            </div>
                                                                   

                                                          
                                                        </div>
                                                    </div>
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

        function addDetails(){
            var Id = "subDeatilsId" + generateUniqueId();
            $html = ` <div class="row px-1 pt-1" id= "`+Id+`">
                        <div class="col-6">
                            <input type="text" class="form-control" placeholder="Details" name="plan_details[]"  autocomplete="off" required>
                        </div>

                        <div class="col-4">
                            <input type="number" class="form-control" placeholder="Details Order" name="plan_details_order[]"  autocomplete="off" required>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-danger mr-1" onClick="removeDetails('`+Id+`')"> Remove</button>
                        </div>
                    </div>`;
            $("#DeatailsId").append($html);
        }
        function removeDetails(id){          
            $("#"+id).remove();
        }
    </script>
@endsection
