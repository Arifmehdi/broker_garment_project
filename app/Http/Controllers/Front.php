<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Machineposts;
use App\Models\Workorders;
use App\Models\User;
use App\Models\Companies;
use App\Models\Usermachines;
use App\Models\Category;
use App\Models\Machine;
use App\Models\Jobschedules;
use App\Models\Jobfiles;
use App\Models\Designs;
use App\Models\Collections;
use App\Models\Withdrawals;
use Auth;
use App\Models\Proposal;
use App\Models\Deals;

class Front extends Controller
{
     public function index()
     {

      $machine_order = machineposts::get()->where('status','active');
      
      $work_order = workorders::get()->where('status','active');

      // dd($work_order);
        return view('front.index',compact('machine_order','work_order'));
     }

     public function signup(){
      return view('front.signup');
   }

   // arif start
   public function deal_collection_ledger($id)
{
   $collection = Collections::where('status','active')->where('deal_id',$id)->get();
   
   $withdrawal = Withdrawals::where('status','active')->where('deal_id',$id)->get();
   $company = Companies::get();
   // dd($withdrawal);
   return view('front.cash_ledger',compact('company','collection','withdrawal'));
   
}
   public function timeline(){
      $machine_order = machineposts::get()->where('status','active');
      
      $work_order = workorders::get()->where('status','active');

      // $a = [];
      // foreach($machine_order as $m){
      //    $a[] = ['type'=>'machine', 'date'=>$m->created_at,'data'=>$m];
      // }

      // experiment start 
      $a = [];
      foreach($machine_order as $m){
         $date= date('Y-m-d h:i:s', strtotime($m->created_at));

         
         $a[] = ['type'=>'machine', 'date'=>$date,'data'=>$m];
      }

      // experiment end 


      // $b = [];
      // foreach($a as $d){
         
      //    $b[] = $d['date'];
      // }
      // dd($b);
      foreach($work_order as $m){

         $date= date('Y-m-d h:i:s', strtotime($m->created_at));
         $a[] = ['type'=>'machine', 'date'=>$date,'data'=>$m];
      }
// dd($a);
//  echo "<pre>";
//  print_r($a);
//  exit;
    

      // dd($a->date);
      // // $s = sort($a['date']);
      // // dd($s);
      // // 
      // // $b = $a->sortBy('date', SORT_REGULAR, true);

   // experment 2 start 

   // $b = [];
   //    foreach($a as $d){
         
   //       $b[] = $d['date'];
   //    }
      
   
      // dd($b);

   // experment 2 end 


//    $j = array_sort_by_column($a, 'date');


// function array_sort_by_column(&$array, $column, $direction = SORT_ASC) {
//     $reference_array = array();

//     foreach($a as $key => $row) {
//         $reference_array[$key] = $row[$column];
//     }

//     $pp = array_multisort($reference_array, $direction, $array);
// }
      
      // dd($a);
     




// $sorted = $a->sortBy("date")->toArray();

      
// dd($sorted);  

      
      return view('front.timeline',compact('machine_order','work_order','a'));
   }

   public function view_timeline($id)
   {
      $work = Workorders::find($id);
      return view('front.view_timeline',compact('work'));
   }
   
   public function go_timeline($id)
   {
      $machine = Machineposts::find($id);
      return view('front.view_timeline',compact('machine'));
   }

   public function all_post()
   {

      return view('front.all_post');
   }
   
   public function all_category()
   { 
      $category = Category::where('id' ,'>' ,0)->get();
      // dd($category);
      return view('front.all_category',compact('category'));
   }

   public function contact()
   {
      return view('front.contact');
   }
  //  arif end 
//   sumaiya start 
public function add_milestone($id)
    {
      if(Auth::user()->name){
          
         $data = User::find(Auth::user()->id);
           }
        return view('front.add_milestone',compact('id','data'));
    }
    
    public function store_milestone(Request $r)
    {
      // dd($r);
      $id = DB::table('jobschedules')->insertGetId([
         'deal_id' => $r->deal_id,
         'title' => $r->title,
         'description' => $r->description,
         'start_date' => $r->start_date,
         'end_date' => $r->end_date,
         'feedback' => $r->feedback,
     ]);
   //   echo $id;

     if($photo= $r->file('photo')){
      $path = "photos/milestone/";
      $pname = md5(rand(100,1000)).'.'.$photo->getClientOriginalExtension();
      $photo->move($path,$pname);
     
  }
  
  if($photo_two = $r->file('job_video')){
      $path_two = 'photos/milestone/';
      $p= md5(rand(100,1000)).'.'.$photo_two->getClientOriginalExtension();
      $photo_two->move($path_two,$p);
      
  }

  $jobfile = [];
  $jobfile['jobschedule_id'] = $id;
  $jobfile['photo'] = $pname;
  $jobfile['video'] =  $p;
 
   Jobfiles::create([
   'jobschedule_id' => $id,
   'photo' => $pname,
   'video' => $p
]);

if($photo_three = $r->file('design_photo')){
   $path_three = 'photos/milestone/';
   $pa= md5(rand(100,1000)).'.'.$photo_three->getClientOriginalExtension();
   $photo_three->move($path_three,$pa);
   
}

 Designs::create([
   'jobschedule_id' => $id,
   'title' => $r->design_title,
   'photo' => $pa
]);

return redirect(route('progress_milestone'));

    }

    public function progress_milestone()
    {
      if(Auth::user()->name){
          
         $data = User::find(Auth::user()->id);
           }
      $job = Jobschedules::get();
      $count = Jobschedules::get()->count();
      $count_complete = Jobschedules::where('status','completed')->get()->count();
      // dd($count_complete);
      
      return view('front.list_milestone',compact('data','job','count','count_complete'));
      
    }

    public function delete_milestone($id)
    {
      $jobshedule = Jobschedules::find($id);
      $jobshedule->delete();
      return redirect(route('progress_milestone'));
    }
//   sumaiya end

   public function profile()
   {
        if(Auth::user()->name){
          
      $data = User::find(Auth::user()->id);
        }
      return view('front.profile',compact('data'));
   }


   // inun delete 3rd session dashboard start 


   // public function dashboard()
   // {
   //    if(Auth::user()->name){
   //       $user = Auth::user()->company_id;
    
   //       $machine = Machineposts::get()->where('status','active');
        
   //       $data = User::find(Auth::user()->id);
   //       $work_order = workorders::get()->where('status','active');
   //       $workorder=Workorders::get();
         
   //       $a = '';
   //       $b='';
   //       foreach($work_order as $w){
   //          if($w->company_id == $user){
   //             $a = $w->company_id;
   //             $b = $w->companies->id;
   //          }
   //       }
    
   //       // dd($a);
   //       // $aa = $work_order->company_id;
   //       // dd($aa);
        
   //    }

   //    if(Auth::user()->name){
   //       //  $machine_post = Machineposts::get()->where($b,'=',$a);

   //       // not done properly before
   //        $machine_post = Machineposts::get()->where('status','active');
   //       // dd($machine_post);
   //          $f = Auth::user()->company_id;
         
   //       $match = Machineposts::get()->where($b,);
         

   //    }
   //    return view('front.dashboard',compact('data','machine_post','workorder'));
   // }

      // inun delete 3rd session dashboard end


      // inun new 3rd session dashboard start



      public function dashboard()
   {
      if(Auth::user()->name){
         $user = Auth::user()->company_id;
    
         $machine = Machineposts::get()->where('status','active');
        
         $data = User::find(Auth::user()->id);
         $work_order = workorders::get()->where('status','active');
         $workorder=Workorders::get();
         
         $a = '';
         $b='';
         foreach($work_order as $w){
            if($w->company_id == $user){
               $a = $w->company_id;
               $b = $w->companies->id;
            }
         }
    
         // dd($a);
         // $aa = $work_order->company_id;
         // dd($aa);
        
      }

      if(Auth::user()->name){
         //  $machine_post = Machineposts::get()->where($b,'=',$a);

         // not done properly before
          $machine_post = Machineposts::get()->where('status','active');
         // dd($machine_post);
            $f = Auth::user()->company_id;
         
         $match = Machineposts::get()->where($b,);

         $machineposts = Machineposts::get();
         // dd($workorder);
         

      }
      return view('front.dashboard',compact('data','machine_post','workorder','machineposts'));
   }
            // inun new 3rd session dashboard end
      
   public function c_pass()
   {
      if(Auth::user()->name){
         $data = User::find(Auth::user()->id);

      }
    
      return view('front.c_pass',compact('data'));
   }
   
   public function edit_profile(Request $r,$id)
   {
      $edit = User::find($id);
     $data = $r->all();
     if($photo = $r->file('profile')){
      $photo_path = 'photos/profile/';
      $photo_name = date('Ymdhis').'.'.$photo->getClientOriginalExtension();
      $photo->move($photo_path,$photo_name);
      $edit->photo = $photo_name;
     }
     
     
     $edit->name = $r->f_name;
     $edit->phone = $r->phone;
     $edit->email = $r->email;
     $edit->password = Hash::make($r->password);
    
     $edit->designation = $r->designation;
   //   $edit->password = $password;
      $edit->update();
     
     return redirect(route('profile'));


    
   }


   // ashiq start
   public function company_profile()
    {
      if(Auth::user()->name){
         $data = Companies::find(Auth::user()->id);
      }
      
        return view('front.company_profile', compact('data'));
      //   ,compact('data')
    }

    public function show_company_profile($id)
    {
      $data = Companies::find($id);
  
      return view('front.company_profile',compact('data'));

    }
    
    public function show_companyList($id)
    {
      $data = Companies::find($id);
  
      return view('front.company_profile',compact('data'));

    }

    

   // ashiq end

   // jahid start

   function dealOverview($id){
      $companyID = Auth::user()->company_id;
      $data = User::find(Auth::user()->id);
      
    //   $d = Deals::where('status','complete')->get();
      $deals = Deals::find($id);
      $feedbacks = Feedback::where('deal_id',$deals->id)->get();
      
       $marchentCompany =$deals->workorderID->company_id;
      
       $sellerCompany = $deals->seller->usermachines->company_id;
       if($companyID===$marchentCompany){
        $status = 'marchent' ;
       //  $marchentCompanyID = $marchentCompany;
  
       }
       if($companyID==$sellerCompany){
          $status = 'seller';
          // $sellerCompanyID = $sellerCompany;
       }
      
      
    
      return view('front.dealOverview',compact('deals','data','status','feedbacks')); 
    }
   // 3rd session 



   function userMacines(){
      $data = User::find(Auth::user()->id);
      $category= Category::get();
      $company= Companies::get();
      $machine= Machine::get();

      return view('front.userMacines',compact('category','company','machine','data'));
   }
   function saveUserMachine(request $data){
      
      $company_id = Auth::user()->company_id; 
      $data->validate([
         
         'category_id'=>'required',
         
         'photo'=>'required',
         'title'=>'required',
         'number_of_machine'=>'required',
         'key'=>'required',
         'value'=>'required',
         'purchase_date'=>'required',
         'number_of_available'=>'required',
         'brand'=>'required',
         'status'=>'required'
      ]);

         $array =[];
        $key = $data->key;
        $value = $data->value;
        $assArr = array_combine($key, $value);
        $checkArr = true;
        foreach ($assArr as $key => $value) {
            if (empty($key) || empty($value) || $value==null) {
                $checkArr = false;
                break;
            }
        }
        if ($checkArr==false){
         return redirect(route('userMacines'))->with('status', 'Your field must not be empty');
        }else{
         $jsonArr = json_encode($assArr);
         $file = $data->file('photo');
         if ($file) {
            $fileName =date('YmdHis').'.'.$file->getClientOriginalExtension();
            $filePath = "uploads/".$fileName;
            $array['photo'] = $fileName;
            $file->move('uploads',$fileName);
        }
           
         if(!isset($data->machine_id)){
            $m = [
               'name'=>$data->title,
               'category_id'=>$data->category_id,
               'specifications'=> $jsonArr,
               'brand'=> $data->brand,
               'photo'=> $filePath
            ];
          $machine_id =  Machine::create($m);
          $array['machine_id']=$machine_id->id;

         }
         if(isset($data->machine_id)){
            $array['machine_id']=$data->machine_id;
         }
         
         
         $array['company_id']=$company_id;
         $array['specifications']=$jsonArr;
         $array['category_id']=$data->category_id;
        
         $array['title']=$data->title;
      
        $array['number_of_machine']=$data->number_of_machine;
        $array['purchase_date']=$data->purchase_date;
        $array['number_of_available']=$data->number_of_available;
        $array['brand']=$data->brand;
        $array['status']=$data->status;
        $result = Usermachines::create($array);
        if ($result) {
            return redirect(route('getUserMachine'));
        } 
        }
      
   }
   function getMachine($id){
      $data = Machine::find($id);
      // dd($data);
      // $arr = ['id'=>$id];
      // $data = json_encode($arr);
      return response()->json($data, 200);
      // print_r($data);
   }
   function getUserMachine(){

      $data = User::find(Auth::user()->id);
      $userMachine = Usermachines::get();
      return view('front.UserMachineTable',compact('userMachine','data'));
   }
   function editUserMachine($id){
      $data = User::find(Auth::user()->id);
      $userMachine = Usermachines::find($id);
      $category= Category::get();
      $company= Companies::get();
      $machine= Machine::get();
      return view('front.editUserMachine',compact('userMachine','category','company','machine','data'));
   }
   function updateUserMachine(request $data, $id){
      $userMachine = Usermachines::find($id);

      $d= array([
         'company_id'=>$data->company_id,
         'category_id'=>$data->category_id,
         'machine_id'=>$data->machine_id,
         'title'=>$data->title,
         'number_of_machine'=>$data->number_of_machine,
         'purchase_date'=>$data->purchase_date,
         'number_of_available'=>$data->number_of_available,
         'brand'=>$data->brand,
         'status'=>$data->status,
      ]);
      $file = $data->file('photo');
      if($file){
            $fileName =date('YmdHis').'.'.$file->getClientOriginalExtension();
            $filePath = "uploads/".$fileName;
            $d['photo'] = $fileName;
            $file->move('uploads',$fileName); 
      }
      $key = $data->key;
        $value = $data->value;
        $assArr = array_combine($key, $value);
      $checkArr = true;
        foreach ($assArr as $key => $value) {
            if (empty($key) || empty($value) || $value==null) {
                $checkArr = false;
                break;
            }
        }
        if ($checkArr==false){
         return redirect(route('editUserMachine',$id))->with('status', 'Your field must not be empty');
        }
      
        $jsonArr = json_encode($assArr);
        $d['specifications']=$jsonArr;
        $userMachine->update($d);
        return redirect(route('getUserMachine'));
   }
   function deleteUserMachine(request $data , $id){
      $userMachine = Usermachines::find($id);
      $userMachine->delete();
      return redirect(route('getUserMachine'));
   }
   function machineDetails($id){
      $data = User::find(Auth::user()->id);
      $userMachine = Usermachines::find($id);
      return view('front.machineDetailsView',compact('userMachine','data'));
   }

   // ali start
   public function add_workorder(){
      if(Auth::user()->name){
          
         $data = User::find(Auth::user()->id);
           }
       $compamyID = Auth::user()->company_id;
      
      $company=companies::where('id',$compamyID)->get();
      $category=category::get();
       $machine=machine::get();
       
      return view('front.add_workorder',compact('data','company','category','machine'));
   }
   
   public function save_workorder(Request $order){
      //   dd($order);
         $order->validate([
            'company_id'=>'required',
            'category_id'=>'required',
            'machine_id'=>'required',
            'spec_title'=>'required',
            'spec_value'=>'required',
            'title'=>'required',
            'budget'=>'required',
            'deadline'=>'required',
            'quantity'=>'required',
            'quality_related'=>'required'
            
        ]);
        $data = [];
        $key = $order->spec_title;
        $value = $order->spec_value;
        $assArr = array_combine($key, $value);
   
        $checkArr = true;
        foreach ($assArr as $key => $value) {
            if (empty($key) || empty($value) || $value==null) {
                $checkArr = false;
                break;
            }
        }
      
            $jsonArr = json_encode($assArr);
            $data['company_id']=$order->company_id;
            $data['category_id']=$order->category_id;
            $data['machine_id']=$order->machine_id;
            $data['title']=$order->title;  
            $data['specifications']=$jsonArr;
            $data['budget']=$order->budget;
            $data['deadline']=$order->deadline;
            $data['quantity']=$order->quantity;
            $data['quality_related']=$order->quality_related;
            // $data['status']='pending';
           
            $result =workorders::create($data);
            if ($result) {
                return redirect(route('dashboard'));
            }
         
        }

        public function workorder_details($id){
         $w_details=Workorders::find($id);
         
         if(Auth::user()->name){
             
            $data = User::find(Auth::user()->id);
              }
         return view('front.workorder_details',compact('w_details','data'));
   
   
        }

        public function edit_workorder($id){
         $edit_workorder=Workorders::find($id);
 
       $category= Category::get();
       $company= Companies::get();
       $machine= Machine::get();
       if(Auth::user()->name){
           
          $data = User::find(Auth::user()->id);
            }
       return view('front.edit_workorder',compact('edit_workorder','category','company','machine','data'));
 
 
      }

      public function update_workorder(Request $order, $id){
         $update_workorder=Workorders::find($id);
         $data = [];
        $key = $order->spec_title;
        $value = $order->spec_value;
        $assArr = array_combine($key, $value);
   
        $checkArr = true;
        foreach ($assArr as $key => $value) {
            if (empty($key) || empty($value) || $value==null) {
                $checkArr = false;
                break;
            }
        }
      
            $jsonArr = json_encode($assArr);
            $data['company_id']=$order->company_id;
            $data['category_id']=$order->category_id;
            $data['machine_id']=$order->machine_id;
            $data['title']=$order->title;  
            $data['specifications']=$jsonArr;
            $data['budget']=$order->budget;
            $data['deadline']=$order->deadline;
            $data['quantity']=$order->quantity;
            $data['quality_related']=$order->quality_related;
            // $data['status']='pending';
           
            $result =$update_workorder->update($data);
            if ($result) {
                return redirect(route('dashboard'));
            }
   
        }

        public function front_delete_workorder($id){

         $delete_order=Workorders::find($id);
         // dd( $delete_order);
         $delete_order->delete();
         return redirect(route('dashboard'));
   
        }

        public function think_proposal($id){
         $proposal=Proposal::find($id);
        // dd($proposal);
        
        if(Auth::user()->name){
         
           $data = User::find(Auth::user()->id);
             }
        return view('front.accept_deals',compact('data','proposal'));

    }

    public function accept_deal(Request $deal){
      // dd($deal);
      $deal->validate([
         'merchant_id'=>'required',
         'seller_id'=>'required',
         'machine_id'=>'required',
         'title'=>'required',
         'spec_title'=>'required',
         'spec_value'=>'required',
         'budget'=>'required',
         'advance_amount'=>'required',
         'advance_paid'=>'required',
         'deadline'=>'required',
         'quantity'=>'required',
         'quality_related'=>'required'
         
     ]);
     $data = [];
     $key = $deal->spec_title;
     $value = $deal->spec_value;
     $assArr = array_combine($key, $value);

     $checkArr = true;
     foreach ($assArr as $key => $value) {
         if (empty($key) || empty($value) || $value==null) {
             $checkArr = false;
             break;
         }
     }
   
         $jsonArr = json_encode($assArr);
         $data['merchant_id']=$deal->merchant_id;
         $data['seller_id']=$deal->seller_id;
         $data['machine_id']=$deal->machine_id;
         $data['title']=$deal->title;  
         $data['specifications']=$jsonArr;
         $data['budget']=$deal->budget;
         $data['advance_amount']=$deal->advance_amount;
         $data['advance_paid']=$deal->advance_paid;
         $data['deadline']=$deal->deadline;
         $data['quantity']=$deal->quantity;
         $data['quality_related']=$deal->quality_related;
         // $data['status']='pending';
        
         $result =Deals::create($data);
         if ($result) {
             return redirect(route('deal_list'));
         }

   }

   public function deal_list(){

      $deal_list=Deals::get();
      if(Auth::user()->name){
          
         $data = User::find(Auth::user()->id);
           }
      return view('front.deal_list',compact('deal_list','data'));
   }

   public function deal_details($id){
      $deals=Deals::find($id);
      if(Auth::user()->name){
          
         $data = User::find(Auth::user()->id);
           }
      return view('front.deals_details',compact('deals','data'));

   }

   public function edit_deals($id){
      $edit_deal=Deals::find($id);
      if(Auth::user()->name){
          
         $data = User::find(Auth::user()->id);
           }
      return view('front.edit_deals',compact('edit_deal','data'));
   }

   public function update_deals(Request $deal, $id){
      $up_deal=Deals::find($id);
      $data = [];
     $key = $deal->spec_title;
     $value = $deal->spec_value;
     $assArr = array_combine($key, $value);

     $checkArr = true;
     foreach ($assArr as $key => $value) {
         if (empty($key) || empty($value) || $value==null) {
             $checkArr = false;
             break;
         }
     }
   
         $jsonArr = json_encode($assArr);
         $data['merchant_id']=$deal->merchant_id;
         $data['seller_id']=$deal->seller_id;
         $data['machine_id']=$deal->machine_id;
         $data['title']=$deal->title;  
         $data['specifications']=$jsonArr;
         $data['budget']=$deal->budget;
         $data['advance_amount']=$deal->advance_amount;
         $data['advance_paid']=$deal->advance_paid;
         $data['deadline']=$deal->deadline;
         $data['quantity']=$deal->quantity;
         $data['quality_related']=$deal->quality_related;
         // $data['status']='pending';
        
         $result =$up_deal->update($data);
         if ($result) {
             return redirect(route('deal_list'));
         }

   }

   public function delete_deals($id){
      $del_deal=Deals::find($id);
      $del_deal->delete();
      return redirect(route('deal_list'));

   }

   public function payment_report($id){
      if(Auth::user()->name){
          
         $data = User::find(Auth::user()->id);
           }
           $c=Collections::find($id);
            // dd($c->Deals->workorderID->Companies->name);
      return view('front.payment_report',compact('data','c'));
   }

   
   // ali end


   // iman start
  
   
   public function add_machinepost(){

      $category= Category::get();
      $company= Companies::get();
      $machine= Machine::get();
      $users = DB::table('usermachines')
                    ->where([
                     'status' => 'available',
                     'approved' => 'yes',
                    ] )
                    ->get();
         // echo '<pre>';
         // print_r($users);
         
        

       return view('front.timeline',compact('users','machine'));
   }

   public function save_machinepost(Request $order){
     
      $order->validate([
         'company_id'=>'required',
         'category_id'=>'required',
         'machine_id'=>'required',
         'status'=>'required',
         'spec_title'=>'required',
         'spec_value'=>'required',
         'title'=>'required',
         'budget'=>'required',
         'deadline'=>'required',
         'quantity'=>'required',
         'quality_related'=>'required'
         
     ]);
     $data = [];
     $key = $order->spec_title;
     $value = $order->spec_value;
     $assArr = array_combine($key, $value);

     $checkArr = true;
     foreach ($assArr as $key => $value) {
         if (empty($key) || empty($value) || $value==null) {
             $checkArr = false;
             break;
         }
     }
   
         $jsonArr = json_encode($assArr);
         $data['company_id']=$order->company_id;
         $data['category_id']=$order->category_id;
         $data['machine_id']=$order->machine_id;
         $data['title']=$order->title;  
         $data['specifications']=$jsonArr;
         $data['budget']=$order->budget;
         $data['deadline']=$order->deadline;
         $data['quantity']=$order->quantity;
         $data['quality_related']=$order->quality_related;
         $data['status']=$order->status;
        
         $result =workorders::create($data);
         if ($result) {
             return redirect(route('order_list'));
         }
      
     }
   
   // iman end 

   // jahid proposal start

    // propusal 

    function mechinePostDetails($id){
      $machinePostDetails = Machineposts::find($id);
      return view('front.mechinePostDetails',compact('machinePostDetails'));
   }
   function workOrderPostDetails($id){
      $workOrderPostDetails = Workorders::find($id);
      return view('front.workOrderPostDetails',compact('workOrderPostDetails'));
   }

   function proposalFrom($id,$name){
      
      if($name=='workOrder'){
         $workOrder = Workorders::find($id);
         $machinePost =Machineposts::get();
         // return view('front.proposalFrom',compact('workOrder','machinePost','name'));
      }elseif($name='machine'){
         $machinePost =Machineposts::find($id);
         $workOrder = Workorders::get();
         
      }
      return view('front.proposalFrom',compact('machinePost','workOrder','name'));
          
   }
   function savePropusal(request $data){
      // dd($data);
      $data->validate([
         'machinepost_id'=>'required',
         'workorder_id'=>'required',
         'title'=>'required',
         'budget'=>'required',
         'quantity'=>'required',
         'quality_related'=>'required',
         'message'=>'required',
         'deadline'=>'required'
      ]);
      $array =[];
      $userId = Auth::user()->id;
      $array['machinepost_id']= $data->machinepost_id;
      $array['workorder_id']= $data->workorder_id;
      $array['user_id']= $userId;
      $array['title']= $data->title;
      $array['budget']= $data->budget;
      $array['quantity']= $data->quantity;
      $array['quality_related']= $data->quality_related;
      $array['message']= $data->message;
      $array['deadline']= $data->deadline;
      
      $success = Proposal::create($array);
      if($success){
         return redirect(route('index'));
      }


   }

   function proposalList(){
      $userId = Auth::user()->id;
      $data = User::find(Auth::user()->id);
      $proposal = Proposal::where('user_id',$userId)->get();
      return view('front.proposalList',compact('proposal','data'));

   }
   function editProposal($id){
      $data = User::find(Auth::user()->id);
      $proposal = Proposal::find($id);
      // dd($proposal->title);
      
     $workOrderCompany =  $proposal->workorder->company_id;
   
     $machinePostCompany = $proposal->machinepost->usermachines->company_id;
     
      $userID = $proposal->user_id;
      
      $userTable= User::find($userID);
      $compamyID = $userTable->company_id;
      if($compamyID==$machinePostCompany){
         $p = 'machinePost';
         $machinePost =Machineposts::where('id',$proposal->machinepost_id)->first();
         
         $workOrder = Workorders::get();
        
      }elseif($compamyID== $workOrderCompany){
         $p = 'workorderPost';
         $workOrder = Workorders::where('id',$proposal->workorder_id)->first();
         $machinePost =Machineposts::get();
         
         
      }
      
      return view('front.editProposal',compact('proposal','data','p','workOrder','machinePost'));
   }
   function updatePropusal(request $data,$id){
      $proposal = Proposal::find($id);
      $userID = Auth::user()->id;
      $array=[
         'workorder_id'=>$data->workorder_id,
         'machinepost_id '=>$data->machinepost_id,
         'user_id  '=>$userID,
         'title'=>$data->title,
         'budget'=>$data->budget,
         'deadline'=>$data->deadline,
         'quantity'=>$data->quantity,
         'quality_related'=>$data->quality_related,
         'message'=>$data->message,
         
      ];
      $proposal->update($array);
      return redirect(route('proposalList'));
   }
   function deleteProposal(request $data ,$id){
      $proposal = Proposal::find($id);
      $proposal->delete();
      return redirect(route('proposalList'));
   }
   public function Proposal_details($id)
   {
    if(Auth::user()->name){
       $data = User::find(Auth::user()->id);
    }
    $proposalDetails = Proposal::find($id);
    // dd($proposalDetails->User->Companies);
    return view('front.proposal_details',compact('data','proposalDetails'));
   }


   // sabina  front 
   public function add_user()
{

      $data = User::find(Auth::user()->id);
    return view('front.add_user',compact('data'));
}

public function save_user(Request $data)
{
    $compamyID = Auth::user()->company_id;
    $array=[];
    $array['name']= $data->name;
    $array['email']= $data->email;
    $array['phone']= $data->phone;
    $array['designation']= $data->designation;
    $array['password']= Hash::make($data->password);
    $array['company_id']=$compamyID;
    $photo = $data->file('photo');
if($photo){
    $path = 'photos/profile';
    $fileName = date('YmdHis').'.'.$photo->getClientOriginalExtension();
    $photo->move($path,$fileName);
    $array['photo']= $fileName;

}
User::create($array);
return redirect(route('dashboard'));



}
// sabina end


// inun start 3rd session
public function machinePosts_details($id){
   $d=Machineposts::find($id);
   
   if(Auth::user()->name){
       
      $data = User::find(Auth::user()->id);
        }
   return view('front.machinePosts_details',compact('d','data'));


  }



  public function front_delete_machinePosts($id){

   $delete_order=Machineposts::find($id);
   // dd( $delete_order);
   $delete_order->delete();
   return redirect(route('dashboard'));

  } 

  function expired_date(){
   
   $date_now = date("Y-m-d");
  

   $deal =Deals::where('deadline','<',$date_now)->get();
  




    if ( $deal ){
    
      return view('front.expired_date',compact('deal'));
    }
   

}
// inun end
}

   

