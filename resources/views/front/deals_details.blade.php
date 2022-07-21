@extends('front.layout')
@section('content')
<div class="page-title">
    <div class="container">
      <div class="page-caption">
        {{-- <h2>Add new Order</h2> --}}
        <p><a href="#" title="Home">Home</a> <i class="ti-angle-double-right"></i>Deals Details</p>
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
      
      <a href="{{route('add_milestone',$deals->id)}}"  class="btn btn-xs " style="width:10%;background:blue;color:white">Add Milestone</a>
      <a href="{{route('deal_collection_ledger',$deals->id)}}"  class="btn btn-xs " style="width:10%;background:blue;color:white">Payment A/C</a>
      <a href="{{route('payment_report',$deals->id)}}"  class="btn btn-xs " style="width:10%;background:blue;color:white">Payment Report</a>
    
      <div class="col-md-8 col-xl-6" style="margin-bottom: 30px">
            
        <div class="row">
           
            <div class="col-md-6">
                <h3>Deal Details</h3>
                <table class="table">
                    <tr>
                        <th>Merchant Company Name</th>
                        <td> {{$deals->workorderID->companies->name}} </td>
                      
                    </tr>
                    
                    <tr>
                        <td>Machine name</td>
                        <td>{{$deals->machineID->name}}</td>
                        
                    </tr>
                    <tr>
                        <td>Title</td>
                        <td>{{$deals->title}}</td>
                        {{-- {{$w_details->title}} --}}
                        
                    </tr>
                    <tr>
                        <td>Budget</td>
                        <td>{{$deals->budget}}</td>
                        
                    </tr>
                    <tr>
                        <td>Advance Amount</td>
                        <td>{{$deals->advance_amount}}</td>
                       
                    </tr>
                    <tr>
                        <td>Quantity</td>
                        <td>{{$deals->quantity}}</td>
                       
                    </tr>
                    <tr>
                        <td>Deadline</td>
                        <td>{{$deals->deadline}}</td>
                       
                    </tr>
                </table>

            </div>

            {{-- fjksjkfgskjj --}}
            <div class="col-md-6" style="margin-top: 54px">
                {{-- <h3>Deal Details</h3> --}}
                <table class="table">
                    <tr>
                        <th>Seller Company Name</th>
                        <td>{{$deals->machinepostID->usermachine->companyName->name}}</td>
                      
                    </tr>
                    
                    <tr>
                        <td>Machine name</td>
                        <td>{{$deals->machineID->name}}</td>
                        
                    </tr>
                    <tr>
                        <td>Title</td>
                        <td>{{$deals->title}}</td>
                        {{-- {{$w_details->title}} --}}
                        
                    </tr>
                    <tr>
                        <td>Budget</td>
                        <td>{{$deals->budget}}</td>
                        
                    </tr>
                    <tr>
                        <td>Advance Amount</td>
                        <td>{{$deals->advance_amount}}</td>
                       
                    </tr>
                    <tr>
                        <td>Quantity</td>
                        <td>{{$deals->quantity}}</td>
                       
                    </tr>
                    <tr>
                        <td>Deadline</td>
                        <td>{{$deals->deadline}}</td>
                       
                    </tr>
                </table>

            </div>
            {{-- bgfhjdhgd --}}
          
        </div>

    </div>

     
     {{-- <section class="padd-bot-80"> --}}
    <div class="container" style="margin-top:50px">
        
        <div class="col-md-8">
            <h4>Spacifications</h4><hr>
            <table class="table">
                @php
                 $data = json_decode($deals->specifications);
                @endphp
                @foreach ( $data as $key=>$value)
                <tr>
                   
                    <td>Specification Title</td>
                    
                   
                    <td>Specification value</td>
                    
                    
                </tr>
                <tr>
                   
                    <td>{{$key}}</td>
                    
                   
                    <td>{{$value}}</td>
                    
                    
                </tr>
                @endforeach
            </table>

        </div>
        <div class="col-md-8">
            <h4>More Details</h4><hr>
            <table class="table">
                <tr>
                    <td>Quality</td>
                    <td>{{$deals->quality_related}}</td>
                    
                </tr>
                <tr>
                    <td>Created Date</td>
                    <td>{{$deals->created_at}}</td>
                   
                </tr>
                <tr>
                    <td>Status</td>
                    <td>{{$deals->status}}</td>
                   
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







  