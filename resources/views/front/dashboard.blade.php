@extends('front.layout')
@section('content')
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
	  <div class="col-md-9">
        <div id="dashboard_listing_blcok">
		  <div class="col-md-4 col-sm-4">
			<div class="statusbox">
			  <h3>Balance Credit</h3>
			  <div class="statusbox-content">
				<p class="ic_status_item ic_col_one"><i class="fa fa-balance-scale"></i></p>
				<h2>$215,00</h2>
				<span>Updated 02 Jan 2021</span> 
			  </div>
			</div>
		  </div>
		  <div class="col-md-4 col-sm-4">
			<div class="statusbox">
			  <h3>View Progress</h3>
			  <div class="statusbox-content">
				<p class="ic_status_item ic_col_two"><i class="fa fa-line-chart"></i></p>
				<h2>$280,00</h2>
				<span>Updated 02 Jan 2021</span> 
			  </div>
			</div>
		  </div>
		  <div class="col-md-4 col-sm-4">
			<div class="statusbox">
			  <h3>View Payments</h3>
			  <div class="statusbox-content">
				<p class="ic_status_item ic_col_three"><i class="fa fa-cc-paypal"></i></p>
				<h2>$350,00</h2>
				<span>Updated 02 Jan 2021</span> 
			  </div>
			
			  </div>
			</div>

			<!-- table start  -->
			
			<div class="col-md-12 col-sm-8">
			<table class="table table-hover">
				<tr class="bg-primary">
					<td>SL</td>
					<td>Title</td>
					<td>Company Name</td>
					<td>Category Name</td>
					
					<td>Number of machine</td>
					<td>Status</td>
					<td>Action</td>
				</tr>
				@if($machine_post)
				@foreach($machine_post as $k=>$m)
				<tr>
					<td>{{ ++$k }}</td>
					<td>{{$m->title}}</td>
					<td>{{$m->usermachines->company->name}}</td>
					<td>{{$m->usermachines->category->name}}</td>
				
					<td align="right">{{$m->number_of_machine}}</td>
					<td>{{$m->status}}</td>
					<td>
					

					  <a href="#" class="btn btn-primary"><i
                      class="fa-solid fa-pen-to-square"></i></a>
                  <form action="" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger" onclick="return confirm('Are you sure!!')" type="submit"><i
                        class="fa-solid fa-trash"></i></button>
                  </form>
                  <a href="" class="btn btn-success"><i
                      class="fa-solid fa-bars"></i></a>


					</td>
				</tr>
				@endforeach
				@endif
			</table>
			</div>
			
			<!-- table end  -->
			{{-- Workorder Post start --}}
			<div class="col-md-12 col-sm-8" style="margin-top: 45px">
			<h3 style="color: rgb(255, 85, 232);margin-left:20px;margin-bottom:20px;" >Workorder Post</h3>
			<div style="margin-left: 15px">
				<a href="{{route('order')}}" class="btn btn-sm btn-info">Back</a>
				
			</div>
				
			  @foreach ($workorder as $w)
			  <div class="col-md-4 col-sm-4">
				
				<div class="statusbox">
				  <h3>{{$w->title}}</h3>
				  
				  <div class="statusbox-content">
					
					{{-- <p class="ic_status_item ic_col_three"><i class="fa fa-cc-paypal"></i></p>
					<h2>Budget</h2>
					<span></span>  --}}
					<table class="table">
						
						<tr>
							<th><h5>Budget :</h5></th>
							<th></th>
							<th><h5>{{$w->budget}}</h5></th>
							
						</tr>
						<tr>
							<th><h5>Quantity:</h5></th>
							<th></th>
							<th><h5>{{$w->quantity}}</h5></th>
							
						</tr>
						<tr>
							<th><h5>Deadline:</h5></th>
							<th></th>
							<th><h5>{{$w->deadline}}</h5></th>
							
						</tr>
						<tr>
							<th></th>
							<th></th>
							<th></th>
							
						</tr>
					
						
						

					</table>		
						
			<div class="col-md-12" style="margin-top: -18px">
				<div class="col-md-8">
					<a href="{{route('order_details',$w->id)}}" class="btn-sm btn btn-info">
						
					View</a>
					{{-- <i class="fas fa-edit"></i> --}}
					<a href="{{route('edit_workorder',$w->id)}}" class="btn-sm btn btn-success">Edit</a>
					
				</div>
				<div class="col-md-4" style="margin-left: -25px">
					<form action="{{route('delete_workorder',$w->id)}}" method="post">
						
						@csrf
						@method('delete')


						<input type="submit" value="Delete" class="btn-sm btn btn-danger" onclick="return confirm('Are You Sure???')">
					</form>
				</div>
			</div>
										
				  </div>
				</div>
			  </div>
			  @endforeach
			</div>

			{{-- Workorder Post End  --}}

			  <!-- machinepost start  -->
		 {{-- <div class="col-md-12 col-sm-8" style="margin-top: 70px">
				<h3 style="color: rgb(179, 137, 235);margin-left:20px;margin-bottom:15px;" >MachinePost</h3>
			  <div class="col-md-4 col-sm-4">
			<div class="statusbox">
			  <h3>Balance Credit</h3>
			  <div class="statusbox-content">
				<p class="ic_status_item ic_col_one"><i class="fa fa-balance-scale"></i></p>
				<h2>$215,00</h2>
				<span>Updated 02 Jan 2021</span> 
			  </div>
			</div>
		  </div>
		  <div class="col-md-4 col-sm-4">
			<div class="statusbox">
			  <h3>View Progress</h3>
			  <div class="statusbox-content">
				<p class="ic_status_item ic_col_two"><i class="fa fa-line-chart"></i></p>
				<h2>$280,00</h2>
				<span>Updated 02 Jan 2021</span> 
			  </div>
			</div>
		  </div>
		  <div class="col-md-4 col-sm-4">
			<div class="statusbox">
			  <h3>View Payments</h3>
			  <div class="statusbox-content">
				<p class="ic_status_item ic_col_three"><i class="fa fa-cc-paypal"></i></p>
				<h2>$350,00</h2>
				<span>Updated 02 Jan 2021</span> 
			  </div>
			
			  </div>
			</div>
		</div> --}}

<!-- inun start  -->

<div class="col-md-12 col-sm-8" style="margin-top: 45px">
			 <!-- <h4 style="color: rgb(68, 16, 151);margin-left:20px;margin-bottom:20px;text-align: center;" >Machine Post</h4> -->
			 <h3 style="color: rgb(255, 85, 232);margin-left:20px;margin-bottom:20px;" >Machine Post</h3>
					  <div style="margin-left: 15px">
						  {{-- <a href="{{route('order')}}" class="btn btn-sm btn-info">Back</a> --}}
					  </div>
						  
					  @foreach (  $machineposts as $k=>$d)
						<div class="col-md-4 col-sm-4">
						  
						  <div class="statusbox">
							<h3>{{$d->Usermachines->title}}</h3>
							
							<div class="statusbox-content">
							  
							  {{-- <p class="ic_status_item ic_col_three"><i class="fa fa-cc-paypal"></i></p>
							  <h2>Budget</h2>
							  <span></span>  --}}
							  <table class="table">
					  <tr>
						<td><h6>Company Name</h6></td>
						<td></td>
						<td><h6>{{$d->Usermachines->Company->name}}</h6></td>
					  </tr>
					  <tr>
						<td><h6>Category Name</h6></td>
						<td></td>
						<td><h6>{{$d->Usermachines->Category->name}}</h6></td>
					  </tr>
					  <tr>
						<td><h6>Machine Name</h6></td>
						<td></td>
						<td><h6>{{$d->Usermachines->Machine->name}}</h6></td>
					  </tr>
					  <tr>
						<td><h6>Brand</h6></td>
						<td></td>
						<td><h6>{{$d->Usermachines->brand}}</h6></td>
					  </tr>
					 
				
					<tr>
					  <td><h6>Status</h6></td>
					  <td></td>
						<td><h6>{{$d->status}}</h6></td>
					</tr>
					
					
							  </table>		
								  
					  <div class="col-md-12" style="margin-top: -18px">
						  <div class="col-md-8">
							  <a href="{{route('machinePosts_details',$d->id)}}" class="btn-sm btn btn-info">
								  
							  View</a>
							  {{-- <i class="fas fa-edit"></i> --}}
							  
							  
						  </div>
						  <div class="col-md-4" style="margin-left: -25px">
							  <form action="{{route('delete_machinePosts',$d->id)}}" method="post">
								  
								  @csrf
								  @method('delete')
		  
		  
								  <input type="submit" value="Delete" class="btn-sm btn btn-danger" onclick="return confirm('Are You Sure???')">
							  </form>
						  </div>
					  </div>
												  
							</div>
						  </div>
						</div>
						@endforeach
			</div>
<!-- inun end  -->

		

		
		
		</div>
      </div>	  
    </div>
  </div>
</section>


<!-- ================ End Profile Settings ======================= --> 
@endsection 