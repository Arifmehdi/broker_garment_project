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
                        <td>Title</td>
                        <td>Description</td>
                        <td>Feedback</td>
                        <td>Start Date</td>
                        <td>End Date</td>
                        <td>Status</td>
                        <td>Progress</td>
                        <td>Action</td>

                        
                    </tr>
                    @foreach ($job as $k=>$list)
                    <tr>
                       
                        <td>{{++$k}}</td>
                        <td>{{$list->title}}</td>
                        <td>{{$list->description}}</td>
                        <td>{{$list->feedback}}</td>
                        <td>{{$list->start_date}}</td>
                        <td>{{$list->end_date}}</td>
                        <td>{{$list->status}}</td>

                        <td>
                        <div class="progress">
  <?php 
if(isset($count) || isset($count_complete)){
   $count_percentage = $count * 100;
  
   $count_complete_percentage = $count_complete * 100; 
   $result = round(($count_complete_percentage/$count_percentage)*100);
//    dd($result);


  if($result == 0 || $result == NULL){
    echo " 0 %";
  }else{
    
    ?>
  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $result;?>%; <?php  if($result<50){echo "background-color: green";}elseif($result<90){echo "background-color: yellow;color: black";}else{echo "background-color: red";}?>;">
    <?php if($result==0){echo '0';}elseif($result<=99){ echo $result;}else{echo '100';}?>%
    <?php } } ?>
  </div>
</div>                                        </td>
                        <td>
                           
                            <a href="" class="btn btn-xs btn-info">View</a>
                            
                            <a href="" class="btn btn-xs btn-success">Edit</a>
                            <!-- <a href="{{route('edit_deals',$list->id)}}" class="btn btn-xs btn-primary">Ad</a> -->
                            
                            <form action="{{route('delete_milestone',$list->id)}}" method="post">
                              
                                @csrf
                                @method('delete')
                                <input type="submit" value="Delete" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')">

                            </form>
                            @if ($list->status=='complete')
                   <a href="" class="btn btn-xs btn-info">Overview</a>
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







  