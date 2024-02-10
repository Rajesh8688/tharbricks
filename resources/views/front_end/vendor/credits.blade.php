@extends('front_end.vendor.layouts.master')
@section('content')
<style>
    .text-xs {
    font-size: .875em;
}
#my_credits .credits-pill {
    font-size: 12px;
    top: -10px;
    line-height: 18px;
}

#my_credits .credits-pill .pill-light-blue {
    background-color: #eaf1fd;
}
#my_credits .credits-pill .pl-2, #my_credits .credits-pill .px-2 {
    padding-left: 9px!important;
}
#my_credits .xl-rounded-left {
    border-top-left-radius: 17px!important;
    border-bottom-left-radius: 17px!important;
}
#my_credits .credits-pill .pr-2, #my_credits .credits-pill .px-2 {
    padding-right: 9px!important;
}
#my_credits .xl-rounded-right {
    border-top-right-radius: 17px!important;
    border-bottom-right-radius: 17px!important;
}
.text-grey-400 {
    color: #9da0b6!important;
}
.text-green {
    color: #47bf9c!important;
}
    </style>
<div class="content-admin-main">
                
   


    <div class="aon-admin-heading">
        <h4>My Credits</h4>
    </div>                
    
    <div class="card aon-card">
        <div class="card-body aon-card-body">

            {{-- <div class="sf-bd-data-tb-head aon-mob-btn-marb">
                <button class="admin-button" data-toggle="modal" data-target="#exampleModal" type="button">
                    <i class="fa fa-plus"></i>
                    Add/Remove Group  
                </button>
                <button class="admin-button m-l10" data-toggle="modal" data-target="#add_services" type="button">
                    <i class="fa fa-plus"></i>
                    Add a Service 
                </button>
            </div>  --}}
            <div class="col-12 mb-3" id="my_credits">
                <div class="d-block d-md-flex justify-content-between align-items-center no-gutters mb-md-2 mb-0">
                    <div>
                        <div class="js-atu-header-off p-md-2 text-lg">
                           <h3>Total Credits</h3>
                        </div>
                        
                    </div>
                    <div class="text-left pt-3 pb-3 pt-md-0 pb-md-0 text-md-right">
                        <strong class="js-page-n-credits">{{auth()->user()->vendorDetails->credits}}</strong> credits
                    </div>
                </div>
                @foreach ($plans as $plan)
                    <div class="js-credits-section-waiting waiting-hidden py-2 pb-3">
                        <div class="starter-pack-container js-starter-pack-container">
                            <div class="starter-pack-elem p-2 p-md-4 border rounded border-grey-100 position-relative">
                                <div class="credits-pill text-xs position-absolute">
                                    @if($plan->discount > 0)
                                        <span class="xl-rounded-left p-1 text-primary pill-light-blue pl-2">
                                        <span class="js-discount-pct">{{$plan->discount}}</span>% OFF
                                        </span>
                                    @endif
                                    
                                    <span class="xl-rounded-right p-1 bg-primary text-white pr-2">
                                        {{$plan->name}}
                                    </span>
                                </div>
                                <div class="d-block d-md-flex mt-3 mt-md-0 no-gutters" style="font-weight: bold;">
                                    <div class="col-12 col-md-9 d-flex no-gutters">
                                        <div class="col-7 col-md-7 d-block d-md-flex no-gutters">
                                            <div class="col-12 col-md-7">
                                                About <span class="js-estimated-responses">{{$plan->no_of_responses}}</span> responses
                                            </div>
                                            <div class="col-12 col-md-5 mt-2 mt-md-0">
                                                <span class="bark-svg-icon bsi-primary-grey-400 d-inline-block align-middle bsi-sm"><!--?xml version="1.0" encoding="UTF-8"?-->
                                                    <svg width="22px" height="22px" viewBox="0 0 22 22" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <g>
                                                                <circle class="primary-color" cx="11" cy="11" r="11"></circle>
                                                                <path d="M12.9763193,6.21214457 L12.9763193,9.6935682 L13.0019226,9.6935682 C13.6996127,8.84738039 14.7109433,8.76824053 15.1269971,8.76824053 C17.1880633,8.76824053 18.455427,10.5336683 18.455427,12.2199563 C18.455427,13.9427703 17.1112534,15.6838474 15.0693896,15.6838474 C14.6085301,15.6838474 13.6164019,15.5925322 12.950716,14.7585197 L12.9251127,14.7585197 L12.9251127,15.5560061 L10.9344555,15.5560061 L10.9344555,6.21214457 L12.9763193,6.21214457 Z M12.9251127,12.2199563 C12.9251127,13.2305115 13.6996127,13.9184196 14.6533359,13.9184196 C15.6134599,13.9184196 16.3815591,13.2305115 16.3815591,12.2199563 C16.3815591,11.2154887 15.6070591,10.5275807 14.6469351,10.5275807 C13.6932119,10.5275807 12.9251127,11.2154887 12.9251127,12.2199563 Z" fill="#FFFFFF"></path>
                                                                <path d="M3.16115514,14.1744231 L9.29226873,15.5376933 L9.29226873,13.792282 L3.40029033,13.5922519 L3.16115514,14.1744231 Z M8.28011385,10.507463 L3.72183503,12.5953216 L3.8173688,13.1937126 L8.59662757,12.2519825 L8.28011385,10.507463 Z M3.32323991,12.2202348 L9.28160526,7.99582586 L9.28160526,6 L3,11.6789183 L3.32323991,12.2202348 Z" fill="#FFFFFF" fill-rule="nonzero"></path>
                                                            </g>
                                                        </g>
                                                    </svg></span>
                                                <span class="align-middle">
                                                    <span class="js-n-credits">{{$plan->no_of_credits}}</span> credits
                                                </span>
                                            </div>
                                        </div>
                                        <div class="d-none d-md-block col-5 col-md-5 text-right text-md-left">
                                            <p class="m-0">
                                                <span class="js-currency-symbol"></span><span class="js-price">₹{{number_format($plan->amount,2)}}</span> <span class="js-vat-toggle">(ex GST)</span>
                                            </p>
                                            <span class="text-sm text-grey-400">
                                                <span class="js-price-per-credit">₹{{number_format($plan->amount / $plan->no_of_credits ,2)}}</span>/credit
                                            </span>
                                        </div>
                                        <div class="d-flex d-md-none justify-content-between flex-column align-items-end col-5 col-md-5 text-right text-md-left">
                                            <p class="m-0">
                                                <span class="js-currency-symbol"></span><span class="js-price">₹{{number_format($plan->amount,2)}}</span> <span class="js-vat-toggle">(ex GST)</span>
                                            </p>
                                            <span class="text-sm text-grey-400">
                                                <span class="js-currency-symbol"></span>
                                                <span class="js-price-per-credit">₹{{number_format($plan->amount / $plan->no_of_credits ,2)}}</span>/credit
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3 mt-4 mt-md-0 text-right">
                                        <span class="btn btn-primary js-purchase-pack d-block d-md-inline-block" data-pack-id="spack" data-atuavail="1" data-credits="{{$plan->no_of_credits}}" data-pack-price="{{$plan->amount}}" data-price-per-credit="{{number_format($plan->amount / $plan->no_of_credits ,2)}}">Buy now</span>
                                        {{-- <div class="atu-container custom-checkbox mt-3 text-center text-md-right">
                                            <input type="checkbox" value="spack" id="atu-toggle-spack" class="custom-control-input my-auto js-atu-toggle">
                                            <label for="atu-toggle-spack" class="custom-control-label cursor-pointer">Auto top-up next time</label>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
             
              

                <h3 class ="pt-4 pb-3">Credit transaction log</h3>

                <div class="sf-bs-data-table">
                    <div class="table-responsive">
                        <table class="table table-striped  example-dt-table" style="width:100%;font-weight:bold">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Description</th>
                                    <th>Credits</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($creditLogs as $item)
                                <tr>
                                    <td>{{$item->unique_id}}</td>
                                    <td>{{$item->credits_description}}</td>
                                    @if($item->action == 'added')
                                        <td class="text-green">
                                            {{$item->credits}}
                                        </td>
                                    @else
                                        <td>
                                            {{"-".$item->credits}}
                                        </td>
                                    @endif
                                    <td>{{ Carbon\Carbon::parse($item->date_of_transaction)->format('d M Y') }}</td>
                                    
                                </tr>
                            @empty
                            <tr align="center" class="alert alert-danger">
                                <td colspan="4">No Log(s) found</td>
                            </tr>
                                
                            @endforelse
                                
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

           

        </div>
    </div>
</div>

@endsection