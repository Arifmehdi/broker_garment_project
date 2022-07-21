@extends('front.layout')
@section('content')

<!-- ======================= Page Title ===================== -->
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Browse by Categories</h2>
      <p><a href="#" title="Home">Home</a> <i class="ti-angle-double-right"></i> Browse by Categories</p>
    </div>
  </div>
</div>
<!-- ======================= End Page Title ===================== --> 

<!-- ================= Category start ========================= -->
<section class="padd-top-80 padd-bot-60">
  <div class="container">
    <div class="row">
		<div class="col-md-12">
		  <div class="col-md-3 col-sm-6">
			<a href="browse-job.html" title="">
				<div class="utf_category_box_area">
				  <div class="utf_category_desc">
					<div class="utf_category_icon"> <i class="icon-bargraph" aria-hidden="true"></i> </div>
					<div class="category-detail utf_category_desc_text"> 
					  <h4>{{$category[0]->name}}</h4>
					  <p>122 Jobs</p>	
					</div>
				  </div>			
				</div>
			</a>
		  </div>
		  <div class="col-md-3 col-sm-6">
			<a href="browse-job.html" title="">
				<div class="utf_category_box_area">
				  <div class="utf_category_desc">
					<div class="utf_category_icon"> <i class="icon-tools" aria-hidden="true"></i> </div>
					<div class="category-detail utf_category_desc_text"> 
					  <h4>{{$category[1]->name}}</h4>
					  <p>155 Jobs</p>
					</div>
				  </div>
				</div>
			</a>
		  </div>
		  <div class="col-md-3 col-sm-6">
			<a href="browse-job.html" title="">
				<div class="utf_category_box_area">
				  <div class="utf_category_desc">
					<div class="utf_category_icon"> <i class="ti-briefcase" aria-hidden="true"></i> </div>
					<div class="category-detail utf_category_desc_text">
					  <h4>{{$category[2]->name}}</h4>
					  <p>300 Jobs</p>
					</div>
				  </div>
				</div>
			</a>
		  </div>
		  <div class="col-md-3 col-sm-6">
			<a href="browse-job.html" title="">
				<div class="utf_category_box_area">
				  <div class="utf_category_desc">
					<div class="utf_category_icon"> <i class="ti-ruler-pencil" aria-hidden="true"></i> </div>
					<div class="category-detail utf_category_desc_text"> 
					  <h4>{{$category[3]->name}}</h4>
					  <p>80 Jobs</p>
					</div>
				  </div>
				</div>
			</a>
		  </div>
		  <div class="col-md-3 col-sm-6">
			<a href="browse-job.html" title="">
				<div class="utf_category_box_area">
				  <div class="utf_category_desc">
					<div class="utf_category_icon"> <i class="icon-briefcase" aria-hidden="true"></i> </div>
					<div class="category-detail utf_category_desc_text"> 
					  <h4>{{$category[4]->name}}</h4>
					  <p>120 Jobs</p>
					</div>
				  </div>
				</div>
			</a>
		  </div>
		  <div class="col-md-3 col-sm-6">
			<a href="browse-job.html" title="">
				<div class="utf_category_box_area">
				  <div class="utf_category_desc">
					<div class="utf_category_icon"> <i class="icon-wine" aria-hidden="true"></i> </div>
					<div class="category-detail utf_category_desc_text">
					  <h4>{{$category[5]->name}}</h4>
					  <p>78 Jobs</p>
					</div>
				  </div>
				</div>
			</a>
		  </div>
		  <div class="col-md-3 col-sm-6">
			<a href="browse-job.html" title="">
				<div class="utf_category_box_area">
				  <div class="utf_category_desc">
					<div class="utf_category_icon"> <i class="ti-world" aria-hidden="true"></i> </div>
					<div class="category-detail utf_category_desc_text">
					  <h4>Digital Marketing</h4>
					  <p>90 Jobs</p>
					</div>
				  </div>
				</div>
			</a>
		  </div>
		  <div class="col-md-3 col-sm-6">
			<a href="browse-job.html" title="">
				<div class="utf_category_box_area">
				  <div class="utf_category_desc">
					<div class="utf_category_icon"> <i class="ti-desktop" aria-hidden="true"></i> </div>
					<div class="category-detail utf_category_desc_text"> 
					  <h4>Education & Training</h4>
					  <p>210 Jobs</p>
					</div>
				  </div>
				</div>
			</a>
		  </div>
	  </div>
    </div>
  </div>
</section>
@endsection
