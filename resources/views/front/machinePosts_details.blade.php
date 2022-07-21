@extends('front.layout')
@section('content')
<div class="page-title">
    <div class="container">
      <div class="page-caption">
        {{-- <h2>Add new Order</h2> --}}
        <p><a href="#" title="Home">Home</a> <i class="ti-angle-double-right"></i>Work Order Details</p>
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

      <div class="col-md-8 col-xl-6" style="margin-top: 100px;margin-bottom: 50px">
            
        <div class="row">
           

            <div class="col-md-4">
             
                <img src="" alt="" class="img-responsive">
                {{-- {{url('uploads/'.$userMachine->photo)}} --}}
            </div>
            <div class="col-md-8">
                <h5>Machine Post Details</h5>
                <table class="table">
                    <tr>
                        <td>Company Name</td>
                        <td> {{$d->Usermachines->Company->name}}</td>
                      
                    </tr>
                    <tr>
                        <td>Category Name</td>
                        <td>{{$d->Usermachines->Category->name}}</td>
                       
                    </tr>
                    <tr>
                        <td>Machine name</td>
                        <td>{{$d->Usermachines->Machine->name}}</td>
                        
                    </tr>
                    <tr>
                        <td>Title</td>
                        <td>{{$d->Usermachines->title}}</td>
                        
                    </tr>
                    <tr>
                        <td>Brand</td>
                        <td>{{$d->Usermachines->brand}}</td>
                        
                    </tr>
                   
                  
                </table>

            </div>
          
        </div>

    </div>

     

		</div>
	
      </div>	  
	{{-- </div>
	
  </div> --}}
  
 
</section>
<!-- ================ End Profile Settings ======================= --> 
@endsection