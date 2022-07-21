@extends('front.layout')
@section('content')
<!-- ======================= Page Title ===================== -->
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Profile Settings</h2>
      <p><a href="#" title="Home">Home</a> <i class="ti-angle-double-right"></i> Profile Settings</p>
    </div>
  </div>
</div>
<!-- ======================= End Page Title ===================== --> 

<!-- ================ Profile Settings ======================= -->
<section class="padd-top-80 padd-bot-80">
  <div class="container">
    <div class="row"> 
      <div class="col-md-3">
		
		<div id="leftcol_item">
		  <div class="user_dashboard_pic"> <img alt="user photo" src="{{asset('photos/profile/'.$data->photo)}}"> <span class="user-photo-action">  {{ Auth::user()->name }}</span> </div>
		</div>
		@include('front.dashSidebar')
	  </div>
	  <div class="col-md-9">
	  
		<div class="profile_detail_block">
			<div class="col-md-6 col-sm-6 col-xs-12">
				
				<form action="{{route('edit_profile',$data->id)}}" method="post" enctype="multipart/form-data">
					@csrf
					@method('PUT')
			  <div class="form-group">
				<label>Name</label>
				<input type="text" class="form-control" placeholder="Name" value="{{$data->name}}" name="f_name" required>
			  </div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="form-group">
				<label>Designation</label>
				<input type="text" class="form-control" placeholder="Designation" name="designation" value="{{$data->designation}}">
			  </div>
			</div>          
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="form-group">
				<label>Email</label>
				<input type="text" class="form-control" placeholder="mail@example.com" value="{{$data->email}}" name="email" required>
			  </div>
			</div>
			
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="form-group">
				<label>Phone</label>
				<input type="text" class="form-control" placeholder="123 214 13247" value="{{$data->phone}}" name="phone" required>
			  </div>
			</div>
		
			<div class="col-md-6 col-sm-6 col-xs-12">
			  <label>User Profile</label>
			  <div class="custom-file-upload">
				<!-- <input type="file" id="file" name="myfiles[]" multiple /> -->
				<input type="file" id="file" name="profile" class="form-control">
			  </div>
			</div>
		
			<div class="clearfix"></div>
			<button  class="col-md-12 padd-top-10 text-center btn btn-m theme-btn full-width">Update</button>

		</form>
	
		</div>
      </div>	  
    </div>
  </div>
</section>
<!-- ================ End Profile Settings ======================= --> 
@endsection