<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserMachines;

class MachinePostStatus extends Controller
{
    function machine_status(){
        $data=UserMachines::get();
        return view ('MachinePostView.index',compact('data'));
    }

    // function machine_status(){
    //     $data=UserMachines::get();
    //     return view ('front.statusPost',compact('data'));
    // }



    
    function edit_status($id){
       
        $data=UserMachines::find($id);
        //dd($data);
        return view ('MachinePostView.edit_status',compact('data'));
    }

    // function edit_status($id){
       
    //     $data=UserMachines::find($id);
    //     //dd($data);
    //     return view ('front.edit_statusPost',compact('data'));
    // }


    function update_status(Request $r,$id){
        $data = $r->all();
         //dd($id);
         //dd($data);
                
            $update = UserMachines::find($id);
            $update ->title = $r->title;
            $update ->number_of_machine = $r->number_of_machine;
            $update ->number_of_available = $r->number_of_available;
            $update ->status = $r->status;
         
            
            $update ->update();
        
             return redirect(route('machine_status'));
        
            }
}
