@extends('front.layout')
@section('content')
<div class="page-title">
    <div class="container">
      <div class="page-caption">
        {{-- <h2>Add new Order</h2> --}}
        <p><a href="#" title="Home">Home</a> <i class="ti-angle-double-right"></i>Payment Report</p>
      </div>
    </div>
  </div>
<!-- ================ Profile Settings ======================= -->
<section class="padd-top-80 padd-bot-80">
  <div class="container">
    <div class="row"> 
      <div class="col-md-3">
		<div id="leftcol_item">
		  <div class="user_dashboard_pic"> <img alt="user photo" src="{{asset('photos/profile/'.$data->photo)}}"> <span class="user-photo-action">{{ Auth::user()->name }}</span> </div>
		</div>
        @include('front.dashSidebar')
        
      </div>
      <h4 style="margin-left: 600px;margin-top: -50px">Payment Report</h4>
      <hr/>
      <div class="col-md-8 col-xl-6" style="margin-top: 20px;margin-bottom: 10px">
           
        {{-- @foreach ($collection as $c) --}}
        <div class="row">
            
            <div class="col-md-6">
                <h5>Merchant Company</h5>
                <table class="table">
                    <tr>
                        <th>Company Name:</th>
                        <td>{{$c->Deals->workorderID->Companies->name}}</td>
                       
                      
                    </tr>
                    <tr>
                        <td>Title:</td>
                        <td>{{$c->Deals->title}}</td>
                        {{-- {{$w_details->Categories->name}} --}}
                       
                    </tr>
                    <tr>
                        <td>Amount</td>
                        <td>{{$c->amount}}</td>
                        {{-- {{$w_details->Machines->name}} --}}
                        
                    </tr>
                    <tr>
                        <td>Received person</td>
                        <td>{{$c->received_by}}</td>
                        {{-- {{$w_details->title}} --}}
                        
                    </tr>
                    <tr>
                        <td>Collection Date</td>
                        <td>{{$c->collection_date}}</td>
                        {{-- {{$w_details->budget}} --}}
                        
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>{{$c->status}}</td>
                        {{-- {{$w_details->quantity}} --}}
                       
                    </tr>
                   
                </table>

            </div>
            {{-- fhjjkhjksdf --}}
            <div class="col-md-6">
                <h5>Seller Company</h5>
                <table class="table">
                    <tr>
                        <th>Company Name:</th>
                        <td>{{$c->Deals->machinepostID->usermachine->company->name}}</td>
                        {{-- {{$w_details->Companies->name}} --}}
                      
                    </tr>
                    <tr>
                        <td>Title</td>
                        <td>{{$c->Deals->title}}</td>
                        {{-- {{$w_details->Categories->name}} --}}
                       
                    </tr>
                    <tr>
                        <td>Amount</td>
                        <td>{{$c->amount}}</td>
                        {{-- {{$w_details->Machines->name}} --}}
                        
                    </tr>
                    <tr>
                        <td>Received Person</td>
                        <td>{{$c->received_by}}</td>
                        {{-- {{$w_details->title}} --}}
                        
                    </tr>
                    <tr>
                        <td>Collection Date</td>
                        <td>{{$c->collection_date}}</td>
                        {{-- {{$w_details->budget}} --}}
                        
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>{{$c->status}}</td>
                        {{-- {{$w_details->quantity}} --}}
                       
                    </tr>
                    
                </table>

            </div>
            {{-- bgjkhdkjgh --}}
            
        </div>
        {{-- @endforeach --}}

    </div>

     
     {{-- <section class="padd-bot-80"> --}}
    <div class="container">
        <div class="col-md-4"></div>
        <div class="col-md-8">
            <h4>More Details</h4><hr>
            <table class="table">
                <tr>
                    <td>Quality</td>
                    <td>{{$c->Deals->quality_related}}</td>
                    {{-- {{$w_details->quality_related}} --}}
                    
                </tr>
                <tr>
                    <td>Created Date</td>
                    <td>{{$c->created_at}}</td>
                    {{-- {{$w_details->created_at}} --}}
                   
                </tr>
                <tr>
                    <td>Status</td>
                    <td>{{$c->status}}</td>
                    {{-- {{$w_details->status}} --}}
                   
                </tr>

            </table>
        </div>

    </div>
{{-- </section> --}}

		</div>
	
      </div>	  
	{{-- </div>
	
  </div> --}}
  
 
{{-- </section> --}}
<!-- ================ End Profile Settings ======================= --> 
@endsection







  