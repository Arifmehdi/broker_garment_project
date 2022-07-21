@extends('front.layout')
@section('content')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  

<div class="page-title">
    <div class="container">
      <div class="page-caption">
        {{-- <h2>Add new Order</h2> --}}
        <p><a href="#" title="Home">Home</a> <i class="ti-angle-double-right"></i>Deals List</p>
      </div>
    </div>
  </div>
<!-- ================ Profile Settings ======================= -->
<section class="padd-top-10 padd-bot-80">
  <div class="container">
    <div class="row"> 
      <div class="col-md-3">
		<div id="leftcol_item">
		  <div class="user_dashboard_pic"> <img alt="user photo" src="{{asset('photos/profile/'.$data->photo)}}"> <span class="user-photo-action">{{ Auth::user()->name }}</span> </div>
    </div>
    @include('front.dashSidebar')
		
      </div>

      <div class="col-md-8 col-xl-6" style="margin-top: 15px;margin-bottom: 50px">
            
        <div class="row">
           
            <div class="col-md-12">
                <h3>Deals list</h3>
                <table class="table table-bordered">
                    <tr>
                        <td>Sl</td>
                        <td>Merchant Company</td>
                        <td>Seller Company</td>
                        <td>Machine Name</td>
                        <td>Title</td>
                        <td>Budget</td>
                        <td>Advance Amount</td>
                        <td>Quantity</td>
                        <td>Deadline</td>
                        <td>Expiry Reminders</td>
                        <td>Action</td>

                        
                    </tr>
                    @foreach ($deal_list as $k=>$list)
                    <tr>
                       
                        <td>{{++$k}}</td>
                        <td>{{$list->workorderID->companies->name}}</td>
                        <td>{{$list->machinepostID->usermachine->companyName->name}}</td>
                        <td>{{$list->machineID->name}}</td>
                        <td>{{$list->title}}</td>
                        <td>{{$list->budget}}</td>
                        <td>{{$list->advance_amount}}</td>
                        <td>{{$list->quantity}}</td>
                        <td>{{$list->deadline}}</td>
                        <td>
                        <div class="progress">
  <?php 
  if($list->created_at == null){
    echo " 0 %";
  }else{
    $startDate = strtotime($list->created_at->format('m/d/Y'));
    $endDate = strtotime($list->deadline);
    $totalDays = ($endDate - $startDate)/86400;
    $spendDays = strtotime(date('m/d/Y'));
    $spendTotalDays = ($spendDays - $startDate)/86400;
    if($totalDays==0){
      $count1 = $spendTotalDays / 1;
    }else{
      $count1 = $spendTotalDays / $totalDays;
    }
    
    $count2 = $count1 * 100;
    $count = number_format($count2, 0);
    // dd($count);
    ?>
  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $count;?>%; <?php  if($count<50){echo "background-color: green";}elseif($count<90){echo "background-color: yellow;color: black";}else{echo "background-color: red";}?>;">
    <?php if($totalDays==0){echo '0';}elseif($spendTotalDays<=$totalDays){ echo $count;}else{echo '100';}?> %
    <?php } ?>
  </div>
</div>                                        </td>
                        <td>
                           
                            <a href="{{route('deal_details',$list->id)}}" class="btn btn-xs btn-info">View</a>
                            
                            <a href="{{route('edit_deals',$list->id)}}" class="btn btn-xs btn-success">Edit</a>
                            <!-- <a href="{{route('edit_deals',$list->id)}}" class="btn btn-xs btn-primary">Ad</a> -->
                            
                            <form action="{{route('delete_deals',$list->id)}}" method="post">
                              
                                @csrf
                                @method('delete')
                                <input type="submit" value="Delete" class="btn btn-xs btn-danger" >

                            </form>
                            @if ($list->status=='complete')
                   <a href="{{route('dealOverview',$list->id)}}" class="btn btn-xs btn-info">Overview</a>
                 @endif
                        </td>
                       
                    </tr>
                    @endforeach
                    
                </table>

            </div>
          
        </div>

    </div>

		</div>
	
      </div>	  
	

</section>
<!-- ================ End Profile Settings ======================= --> 
@endsection







  