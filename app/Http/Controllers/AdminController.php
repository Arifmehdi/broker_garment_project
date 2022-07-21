<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\CursorPaginator;

use App\Models\Category;
use App\Models\Companies;
use App\Models\Usermachines;
use App\Models\Machineposts;
use App\Models\Workorders;
use App\Models\Machine;
use App\Models\Withdrawals;
use App\Models\Deals;
use App\Models\User;
use App\Models\Proposal;
use App\Models\Collections;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function __construct()
    {

        $this->middleware('isAdmin');
    }
    public function Index()
    {
        $count = User::all()->count();
        $collect = DB::table('collections')->where('status','active')->sum('collections.amount');
        $withdraw = DB::table('withdrawals')->where('status','active')->sum('withdrawals.amount');
    // dd($collect);
        $card_collection = Collections::where('status','active')->get();
        
        $card_withdraw = Withdrawals::where('status','active')->get();
        // dd($card_collection);
        // dd($card_withdraw);
        return view('admin.index',compact('card_collection','card_withdraw','collect','withdraw','count'));
    }
    public function Forms()
    {
        return view('admin.forms');
    }
    public function Tables()
    {
        return view('admin.table');
    }
    public function Font_awesome()
    {
        return view('admin.font_awesome');
    }
    public function Login()
    {
        return view('admin.login');
    }
    public function Register()
    {
        return view('admin.register');
    }
    public function Modals()
    {
        return view('admin.modals');
    }

    // sumaiya starts
    public function category_form()
    {
        $list=Category::get();
        return view('admin.add_category',compact('list'));
    }

    
    public function save_category(Request $category){
        
      $info=$category->all('name');

      Category::create($info);
    
    
     return redirect(route('add_cat'));
    }


    public function category_list(){
        $list=Category::get();
    
        return view('admin.category_list',compact('list'));
    }

    function edit_category($id)
        {
            $data = Category::find($id);
            $list = Category::get();
            return view('admin.edit_category',compact('data','list'));

        }

        function update_category(Request $cat,$id)
        {   
            $data = Category::find($id);
            $info=$cat->all();
            $data->update($info);
            return redirect(route('add_cat'));

        }

        public function delete_category($id){
            $data = Category::find($id);
            $data->delete();
            return redirect(route('add_cat'));

        }

        public function company_list()
        {
            $data = Companies::get();
            return view('admin.company_list',compact('data'));
        }


    // sumaiya end

       // rakib start
    
       public function company()
       {
           return view('admin.company');
       }
   
       public function add_company(Request $r)
       {
           $data = $r->all();

           $photo_multi = $r->file('certificates');
   
           if($photo= $r->file('trade_license')){
               $path = "photos/company/";
               $pname = md5(rand(100,1000)).'.'.$photo->getClientOriginalExtension();
               $photo->move($path,$pname);
               $data['trade_license'] = $pname;
           }
           
           if($photo_two = $r->file('logo')){
               $path_two = 'photos/company/';
               $pname_two = md5(rand(100,1000)).'.'.$photo_two->getClientOriginalExtension();
               $photo_two->move($path_two,$pname_two);
               $data['logo'] = $pname_two;
           }
           if($photo_three = $r->file('photo')){
               $path_three = 'photos/company';
               $pname_three = md5(rand(100,1000)).'.'.$photo_three->getClientOriginalExtension();
               $photo_three->move($path_three,$pname_three);
               $data['photo'] = $pname_three;
           }
   
           $j =[];
           $image_name = array();
           $image = array();
         
           if($files = $r->file('certificates')){
               foreach($files as $k=>$file){
                   $img_name = md5(rand());
                   $img_extention = strtolower($file->getClientOriginalExtension());
                   $full_name = $img_name.'.'.$img_extention;
                   $img_path = 'photos/company/';
                   $img_url = $img_path.$full_name;
                   $img_move = $file->move($img_path,$full_name);
                   $image[] = $img_url;
                   $image_name[] = $full_name; 
                   
                   $l = ++$k;
                   $j[]=$full_name;
                //    $img_implode = implode('|',$image); 
               }
           }

       $da = json_encode($j);
       $data['certificates'] = $da;

       Companies::create($data);
    //    print_r($da);
    return redirect(route('company_list'));

       }






       public function updato_company(Request $r,$id)
       {
        $data = $r->all();

        $photo_multi = $r->file('certificates');

        if($photo= $r->file('trade_license')){
            $path = "photos/company/";
            $pname = md5(rand(100,1000)).'.'.$photo->getClientOriginalExtension();
            $photo->move($path,$pname);
            $data['trade_license'] = $pname;
        }
        
        if($photo_two = $r->file('logo')){
            $path_two = 'photos/company/';
            $pname_two = md5(rand(100,1000)).'.'.$photo_two->getClientOriginalExtension();
            $photo_two->move($path_two,$pname_two);
            $data['logo'] = $pname_two;
        }
        if($photo_three = $r->file('photo')){
            $path_three = 'photos/company';
            $pname_three = md5(rand(100,1000)).'.'.$photo_three->getClientOriginalExtension();
            $photo_three->move($path_three,$pname_three);
            $data['photo'] = $pname_three;
        }

        $j =[];
        $image_name = array();
        $image = array();
      
        if($files = $r->file('certificates')){
            foreach($files as $k=>$file){
                $img_name = md5(rand());
                $img_extention = strtolower($file->getClientOriginalExtension());
                $full_name = $img_name.'.'.$img_extention;
                $img_path = 'photos/company/';
                $img_url = $img_path.$full_name;
                $img_move = $file->move($img_path,$full_name);
                $image[] = $img_url;
                $image_name[] = $full_name; 
                
                $l = ++$k;
                $j[]=$full_name;
             //    $img_implode = implode('|',$image); 
            }
        }

    $da = json_encode($j);
    $data['certificates'] = $da;
    

    
    $da = Companies::find($id);
    $do =$r->all();
    $da->update($do);
 //    print_r($da);
 return redirect(route('company_list'));
       }
       
 function machineListInd($id){
    $data = Usermachines::where('company_id',$id)->get();
    // dd($data);
    return view('admin.machineListInd',compact('data'));

}
function machineDetailsInt($id){
    $userMachine = Usermachines::find($id);
    return view('admin.machineDetailsInt',compact('userMachine'));
}
//    ashiq end

// rakib start
public function machine()
{
    $data = Category::get();
    return view('admin.machine',compact('data'));
}

public function edito_company($id)
{
     $data = Companies::find($id);
    
    return view('admin.edit_company',compact('data'));
  
}

public function collection($id)
{
    // echo $id;
    return view('admin.collection',compact('id'));
}

public function show_collection(Request $r)
{
    // dd($r);
    $collect = $r->all();
    // dd($collect);
     Collections::create($collect);
    return back();
}

public function list_collection()
{
    $collect = Collections::get();
    return view('admin.list_collection',compact('collect'));
}


       // rakib end

    //    ashiq start
    public function delete_companyList($id)
    {
        $data = Companies::find($id);
        $data->delete();
        return back();

    }
    //    ashiq end

    //shimo start
    
    public function machine_post()
    {
        $p = Machineposts::get();
        return view('admin.machine_post',compact('p'));
    }
    public function delete($id)
    {
        $delete = Machineposts::find($id);
        $delete->delete();
        return redirect(route('machine_post'));
    }

    public function addo_machinepost()
    {
        return view('front.add_machinepost');
    }
    // shimo end


    // ali start
    public function workorder_list(){
        $data=Workorders::get();
        return view('admin.order_list',compact('data'));

    }

    
    public function delete_workorder($id){
        $data=Workorders::find($id);
        $data->delete();
        return redirect(route('order_list'));

    }

    public function admin_edit_workorder($id){

        $edit_workorder=Workorders::find($id);
        $machine= Machine::get();
        $category= Category::get();
    
          return view('admin.edit_workorder',compact('edit_workorder','machine','category'));
    
        }
    
        public function admin_update_workorder(Request $upWorkorder,$id){
    
            $update_workorder=Workorders::find($id);
            $data = [];
            $key = $upWorkorder->spec_title;
            $value = $upWorkorder->spec_value;
            $assArr = array_combine($key, $value);
       
            $checkArr = true;
            foreach ($assArr as $key => $value) {
                if (empty($key) || empty($value) || $value==null) {
                    $checkArr = false;
                    break;
                }
            }
          
                $jsonArr = json_encode($assArr);
                $data['company_id']=$upWorkorder->company_id;
                $data['category_id']=$upWorkorder->category_id;
                $data['machine_id']=$upWorkorder->machine_id;
                $data['title']=$upWorkorder->title;  
                $data['specifications']=$jsonArr;
                $data['budget']=$upWorkorder->budget;
                $data['deadline']=$upWorkorder->deadline;
                $data['quantity']=$upWorkorder->quantity;
                $data['quality_related']=$upWorkorder->quality_related;
                // $data['status']='pending';
               
                $result =$update_workorder->update($data);
                if ($result) {
                    return redirect(route('order_list'));
                }
    
       }

       public function admin_workorder_details($id){
        $w_details=Workorders::find($id);
        return view('admin.workorder_details',compact('w_details'));
       }

       public function Approve_workorder_post($id)
    {
        $approveWorkorder =Workorders::find($id);
        $approveWorkorder->status='active';
        $approveWorkorder->update();
        return redirect(route('order_list'));
    }
    public function Disapprove_workorder_post($id)
    {
        $disApproveWorkorder = Workorders::find($id);
        $disApproveWorkorder->status='inactive';
        $disApproveWorkorder->update();
        return redirect(route('order_list'));
    }

    // ali end 

    //ismail
    public function Machine_post_list()
    {
        $machineposts = Machineposts::get();
        return view('admin/machine_post_list',compact('machineposts'));
    }
    public function Approve_post($id)
    {
        $approvePosts = Machineposts::find($id);
        $approvePosts->status='active';
        $approvePosts->update();
        return redirect(route('post_list'));
    }
    public function Disapprove_post($id)
    {
        $disApprovePosts = Machineposts::find($id);
        $disApprovePosts->status='inactive';
        $disApprovePosts->update();
        return redirect(route('post_list'));
    }
    public function Proposal_list()
    {   
        $proposalList = Proposal::get();
        return view('admin/proposal_list',compact('proposalList'));
    }
    public function Proposal_details($id)
    {
        $proposalDetails = Proposal::find($id);
        return view('admin/proposal_details',compact('proposalDetails'));
    }

    // sabina
    public function Approve_machines($id)
    {
        $approval = Machine::find($id);
        $approval->status='active';
        $approval->update();
        return redirect(route('machine.index'));
    }
    public function Disapprove_machines($id)
    {
        $disApproval = Machine::find($id);
        $disApproval->status='inactive';
        $disApproval->update();
        return redirect(route('machine.index'));
    }

    public function Approve_order($id)
    {
        $approval =Workorders::find($id);
        $approval->status='active';
        $approval->update();
        return redirect(route('order_list'));
    }
    public function Disapprove_order($id)
    {
        $disApproval =  Workorders::find($id);
        $disApproval->status='inactive';
        $disApproval->update();
        return redirect(route('order_list'));
    }


    
//     //withdraw
//     // shimran maria simu
//     public function add_withdraw()
//     {
//         $list=Deals::get();
//         return view('admin.add_withdraw',compact('list'));
//     }
//     public function save_withdraw(Request $withdraw){
        
//         $withdraw->validate([
//             'deal_id'=>'required',
//             'amount'=>'required',
//             'posted_by'=>'required',
//             'payment_date'=>'required',
//             'bank_name'=>'required',
//             'account_no'=>'required'
//         ]);
//         $info=$withdraw->all();
//         Withdrawals::create($info);
//         return redirect(route('withdraw_list'));
//       }
  
  
//       public function withdraw_list(){
//           $list=Withdrawals::get();
//           return view('admin.withdrawals_list',compact('list'));
//       }
//       public function withdraw_delete($id)
//         {
//             $delete = Withdrawals::find($id);
//             $delete->delete();
//             return redirect(route('withdraw_list'));
//         }

//         function withdraw_edit($id)
//         {
//             $list = Withdrawals::find($id);
//             // dd($list->Deals);
//             return view('admin.edit_withdraw',compact('list'));

//         }

//         function withdraw_update(Request $cat,$id)
//         {   
//             $list = Withdrawals::find($id);
//             $info=$cat->all();
//             $list->update($info);
//             return redirect(route('withdraw_list'));

//         }
// // 2nd innings

//         public function withdraw_search(Request $r)
//         {
//             $start_date = $r->start_date;
//             $end_date = $r->end_date;
//             $searchResult = Withdrawals::select("*")
//                         ->whereBetween('payment_date', [$start_date, $end_date])
//                         ->get();
//             return view('admin.search_withdraw',compact('searchResult'));
//         }
        
//     // shimo end




// shomo update shimo new  start 

//withdraw
    // shimran maria simu
    public function add_withdraw()
    {
        $list=Deals::get();
        return view('admin.add_withdraw',compact('list'));
    }
    public function save_withdraw(Request $withdraw){
        
        $withdraw->validate([
            'deal_id'=>'required',
            'amount'=>'required',
            
            'payment_date'=>'required',
            'bank_name'=>'required',
            'account_no'=>'required',
            'status'=>'required'
        ]);
        $info=$withdraw->all();

        $user_id=Auth::user()->name;
        $info['posted_by']=$user_id;
        

        //dd($info);
        Withdrawals::create($info);
        return redirect(route('withdraw_list'));
      }
  
  
      public function withdraw_list(){
          $list=Withdrawals::get();
          return view('admin.withdrawals_list',compact('list'));
      }
      public function withdraw_delete($id)
        {
            $delete = Withdrawals::find($id);
            $delete->delete();
            return redirect(route('withdraw_list'));
        }

        function withdraw_edit($id)
        {
            $list = Withdrawals::find($id);
            // dd($list->Deals);
            return view('admin.edit_withdraw',compact('list'));

        }

        function withdraw_update(Request $cat,$id)
        {   
            $list = Withdrawals::find($id);
            $info=$cat->all();
            $list->update($info);
            return redirect(route('withdraw_list'));

        }
// 2nd innings

        public function withdraw_search(Request $r)
        {
            $start_date = $r->start_date;
            $end_date = $r->end_date;
            $searchResult = Withdrawals::select("*")
                        ->whereBetween('payment_date', [$start_date, $end_date])
                        ->get();
            return view('admin.search_withdraw',compact('searchResult'));
        }
        
    // shimo end
// shomo update shimo new  end
    // jahid
    // deals

    function dealList(){
        $deals = Deals::get();
        return view('admin.dealList',compact('deals'));
    }
    function dealsDetails($id){
        $deals = Deals::find($id);
        return view('admin.dealDetails',compact('deals'));
    }

    // add user sabina

    public function add_user($id)
    {
        return view('admin.add_user', compact('id'));
    }

    public function save_user(Request $data)
    {
        $compamyID = Auth::user()->company_id;
        $array = [];
        $array['name'] = $data->name;
        $array['email'] = $data->email;
        $array['phone'] = $data->phone;
        $array['designation'] = $data->designation;
        $array['password'] = Hash::make($data->password);
        $array['company_id'] = $compamyID;
        $photo = $data->file('photo');
        if ($photo) {
            $path = 'photos/profile';
            $fileName = date('YmdHis') . '.' . $photo->getClientOriginalExtension();
            $photo->move($path, $fileName);
            $array['photo'] = $fileName;
        }
        User::create($array);
        return redirect(route('company_list'));
    }

    // iman start 
    public function available_machinePost()
    {

      
                   
    $users = Usermachines::where(['status' => 'available','approved' => 'yes',])->get();
       
        
      
        return view('admin.available_machinePost',compact('users'));
    }

    public function delete_availableMachinePost($id){
        $data=Usermachines::find($id);
        $data->delete();
        // return redirect(route('order_list'));
        return back();

    }

    function completed_deal(){
        $data = Deals::where('status','completed')->get();
        // dd($data);
        return view('admin.completed_deal',compact('data'));
    
    }
    // iman end 
    
    
   
    public function cash_ledger()
    {   
        $collection = Collections::where('status','active')->get();
        $withdrawal = Withdrawals::where('status','active')->get();
        $company = Companies::get();
        // dd($withdrawal);
        return view('admin.cash_ledger',compact('company','collection','withdrawal'));
    }

    public function cash_ledger_search(Request $r)
    {

        $start = $r->post('start');
        $end = $r->post('end');


        $collection = DB::table('collections')
                    ->where('status','active')
                    ->whereBetween('collection_date',[$start,$end])->get();
         $withdraw = DB::table('withdrawals')
                    ->where('status','active')
                    ->whereBetween('payment_date',[$start,$end])->get();

        dd($withdraw);
        // $collection = Collections::where('status','active')->wherebetween('starting_date',[$start,$end])->get();
        dd($collection);

        echo $start.' '. $end;
    }

    // inunnahar start 
    function expired_dates(){
        // if(Auth::user()->name){
        //    $data = User::find(Auth::user()->id);
        // }
        $date_now = date("Y-m-d");
        // dd($date_now);
     
        $deal =Deals::where('deadline','<',$date_now)->get();
       
        //dd($deal);
     
     
     
         if ( $deal ){
         
           return view('admin.expired_dates',compact('deal'));
         }
        
     
     }

    // inunnahar end

    }
