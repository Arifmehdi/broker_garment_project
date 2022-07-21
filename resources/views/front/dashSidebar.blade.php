<!-- <div class="dashboard_nav_item">
	 <ul>
	   <li class="active"><a href="{{route('dashboard')}}"><i class="login-icon ti-dashboard"></i> Dashboard</a></li>
	    <li><a href="{{route('profile')}}"><i class="login-icon ti-user"></i> Edit Profile</a></li>
	    <li><a href="{{route('c_pass')}}"><i class="login-icon ti-key"></i> Change Password</a></li>
	    <li><a href="#"><i class="login-icon ti-power-off"></i> Logout</a></li>
  </ul>
</div> -->
<!-- <li class="dropdown bg-warning" > <a href="">Post your <br> machine</a> </li> -->

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<div class="dashboard_nav_item">
	<ul>
		<li class="<?php if( url()->current()==route('dashboard')){echo 'active';} ?>"><a href="{{route('dashboard')}}"><i class="login-icon ti-dashboard"></i> Dashboard</a></li>
		
		<li class="<?php if( url()->current()==route('order')){echo 'active';} ?>"><a href="{{route('order')}}"><i class="login-icon ti-dashboard"></i style="color:#675F00"><strong> Post your
					Work-order</strong> </a></li>
		<li class="dropdown <?php if( url()->current()==route('profile')){echo 'active';} ?>"><a href="{{route('machine_status')}}"><i class="login-icon ti-user"></i> Status of Machine</a>
		<li class="<?php if( url()->current()==route('userMacines')){echo 'active';} ?>"><a href="{{route('userMacines')}}"><i class="login-icon ti-user"></i>Machine Upload</a></li>
		<li class="<?php if( url()->current()==route('getUserMachine')){echo 'active';} ?>"><a href="{{route('getUserMachine')}}"><i class="login-icon ti-user"></i>Machine List</a> </li>
		<li class="<?php if( url()->current()==route('proposalList')){echo 'active';} ?>"><a href="{{route('proposalList')}}"><i class="login-icon ti-user"></i> My Proposal List</a>
		</li>
		<li class="<?php if( url()->current()==route('proposalList')){echo 'active';} ?>"><a href="{{route('deal_list')}}"><i class="login-icon ti-user"></i> My Deal List</a>
		</li>
		<!-- <ul class="dropdown">Mark of Machine</ul>
                <ul class="dropdown">Mark of Machine</ul>
                <ul class="dropdown">Mark of Machine</ul> -->






		</li>
		<li class="<?php if( url()->current()==route('add_user')){echo 'active';} ?>"><a href="{{route('add_user')}}"><i class="login-icon ti-user"></i>Create New User</a></li>
		<li class="<?php if( url()->current()==route('profile')){echo 'active';} ?>"><a href="{{route('profile')}}"><i class="login-icon ti-user"></i> Edit Profile</a></li>
		<li class="<?php if( url()->current()==route('c_pass')){echo 'active';} ?>"><a href="{{route('c_pass')}}"><i class="login-icon ti-key"></i> Change Password</a></li>
		<li class="<?php if( url()->current()==route('logout')){echo 'active';} ?>">
			<a class="dropdown-item" href="{{ route('logout') }}"
				onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
				<i class="login-icon ti-power-off"></i>
				{{ __('Logout') }}
			</a>

			<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
				@csrf
			</form>
			<!-- <a href="#"><i class="login-icon ti-power-off"></i> Logout</a> -->
		</li>
	</ul>
</div>