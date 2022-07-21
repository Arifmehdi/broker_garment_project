<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Front;
use App\Http\Controllers\MachineController;

Route::group(['prefix'=>'admin'],function(){
	Route::resource('/machine',MachineController::class);
    
	// Route::get('/modals',[AdminController::class,'Modals'])->name('admin/modals');
	// Route::get('/font_awesome',[AdminController::class,'Font_awesome'])->name('admin/font_awesome');
	// Route::get('/register',[AdminController::class,'Register'])->name('admin/register');
	// Route::get('/login',[AdminController::class,'Login'])->name('admin/login');
	// Route::get('/tables',[AdminController::class,'Tables'])->name('admin/tables');
	// Route::get('/forms',[AdminController::class,'Forms'])->name('admin/forms');
	// Route::get('/',[AdminController::class,'Index'])->name('admin');
	Route::get('/post_list',[AdminController::class,'Machine_post_list'])->name('post_list');
	Route::get('/approve_post/{id}',[AdminController::class,'Approve_post'])->name('approve_post');
	Route::get('/disapprove_post/{id}',[AdminController::class,'Disapprove_post'])->name('disapprove_post');

	Route::get('/proposal_list',[AdminController::class,'Proposal_list'])->name('proposal_list');
	Route::get('admin/proposal_details/{id}',[AdminController::class,'Proposal_details'])->name('admin/proposal_details');

	// rakib 
	Route::get('/collection/{id}',[AdminController::class,'collection'])->name('collection');
	Route::post('/show_collection',[AdminController::class,'show_collection'])->name('show_collection');
	Route::get('/list_collection',[AdminController::class,'list_collection'])->name('list_collection');  
	Route::get('/deal_collection_ledger/{id}',[Front::class,'deal_collection_ledger'])->name('deal_collection_ledger');  
});
// sabina
Route::get('/approve_machines/{id}',[AdminController::class,'Approve_machines'])->name('approve_machines');
Route::get('/disapprove_machines/{id}',[AdminController::class,'Disapprove_machines'])->name('disapprove_machines');

Route::get('/approve_order/{id}',[AdminController::class,'Approve_order'])->name('approve_order');
Route::get('/disapprove_order/{id}',[AdminController::class,'Disapprove_order'])->name('disapprove_order');






Route::prefix('admin')->middleware('auth')->group(function(){



 Route::get('/modals',[AdminController::class,'Modals'])->name('admin/modals');
 Route::get('/font_awesome',[AdminController::class,'Font_awesome'])->name('admin/font_awesome');
 Route::get('/register',[AdminController::class,'Register'])->name('admin/register');
 Route::get('/login',[AdminController::class,'Login'])->name('admin/login');
 Route::get('/tables',[AdminController::class,'Tables'])->name('admin/tables');
 Route::get('/forms',[AdminController::class,'Forms'])->name('admin/forms');
 Route::get('/',[AdminController::class,'Index'])->name('admin');






 // sumaiya starts 

Route::get('/category_list',[AdminController::class,'category_list'])->name('cat_list');
Route::get('/add_category',[AdminController::class,'category_form'])->name('add_cat');
Route::post('/save_category',[AdminController::class,'save_category'])->name('save_cat');
Route::put('/update_category/{id}',[AdminController::class,'update_category'])->name('up_cat');
Route::get('/edit_category/{id}',[AdminController::class,'edit_category'])->name('edit_cat');
Route::delete('/delete_category/{id}',[AdminController::class,'delete_category'])->name('delete_cat');

Route::get('/company_list',[AdminController::class,'company_list'])->name('company_list');

//3rd inings
Route::get('/dashboard/add_milestone/{id}',[Front::class,'add_milestone'])->name('add_milestone')->middleware('auth');
Route::post('/dashboard/store_milestone',[Front::class,'store_milestone'])->name('store_milestone')->middleware('auth');
Route::get('/dashboard/progress_milestone',[Front::class,'progress_milestone'])->name('progress_milestone')->middleware('auth');
Route::delete('/delete_milestone/{id}',[Front::class,'delete_milestone'])->name('delete_milestone')->middleware('auth');
 // sumaiya end 


 // rakib start
Route::get('/company',[AdminController::class,'company'])->name('company');
Route::post('/add_company',[AdminController::class,'add_company'])->name('add_company');
Route::get('/machineListInd/{id}',[AdminController::class,'machineListInd'])->name('machineListInd');
Route::get('/machineDetailsInt/{id}',[AdminController::class,'machineDetailsInt'])->name('machineDetailsInt');
Route::get('/edito_company/{id}',[AdminController::class,'edito_company'])->name('edito_company');
Route::put('/updato_company/{id}',[AdminController::class,'updato_company'])->name('updato_company');
// rakib end


// shimo start
Route::delete('/delete/{id}',[AdminController::class,'delete'])->name('delete');
Route::get('/addo_machinepost',[AdminController::class,'addo_machinepost'])->name('addo_machinepost')->middleware('auth');
Route::get('/machine_post',[AdminController::class,'machine_post'])->name('machine_post');

// shimaran
//withdraw
Route::put('/withdraw_update/{id}',[AdminController::class,'withdraw_update'])->name('withdraw_update');
Route::get('/withdraw_edit/{id}',[AdminController::class,'withdraw_edit'])->name('withdraw_edit');
Route::delete('/withdraw_delete/{id}',[AdminController::class,'withdraw_delete'])->name('withdraw_delete');
Route::get('/withdraw_list',[AdminController::class,'withdraw_list'])->name('withdraw_list');
Route::post('/save_withdraw',[AdminController::class,'save_withdraw'])->name('save_withdraw');
Route::get('/add_withdraw',[AdminController::class,'add_withdraw'])->name('add_withdraw');

Route::post('/withdraw_search',[AdminController::class,'withdraw_search'])->name('withdraw_search');


//shimo end



// ali start
// Front area
Route::get('/payment_report/{id}', [Front::class,'payment_report'])->name('payment_report');

Route::delete('/delete_deals/{id}', [Front::class,'delete_deals'])->name('delete_deals');
Route::put('/update_deals/{id}', [Front::class,'update_deals'])->name('update_deals');
Route::get('/edit_deals/{id}', [Front::class,'edit_deals'])->name('edit_deals');
Route::get('/deal_details/{id}', [Front::class,'deal_details'])->name('deal_details');
Route::get('/deal_list', [Front::class,'deal_list'])->name('deal_list');
Route::post('/accept_deal', [Front::class,'accept_deal'])->name('accept_deal');
Route::get('/think_proposal/{id}', [Front::class,'think_proposal'])->name('think_proposal');


Route::delete('/delete_workorder/{id}', [Front::class,'front_delete_workorder'])->name('delete_workorder');
Route::get('/workorder_details/{id}', [Front::class,'workorder_details'])->name('order_details');
Route::put('/update_workorder/{id}', [Front::class,'update_workorder'])->name('update_workorder');
Route::get('/edit_workorder/{id}', [Front::class,'edit_workorder'])->name('edit_workorder');
Route::post('/save_order', [Front::class,'save_workorder'])->name('save_order');
Route::get('/order', [Front::class,'add_workorder'])->name('order')->middleware('auth');

// Back Area 
Route::get('/admin/approve_workorder_post/{id}',[AdminController::class,'Approve_workorder_post'])->name('approve_workorder_post');
Route::get('/admin/disapprove_workorder_post/{id}',[AdminController::class,'Disapprove_workorder_post'])->name('disapprove_workorder_post');

Route::delete('/delete_order/{id}', [AdminController::class,'delete_workorder'])->name('del_order');
Route::get('/admin/workorder_details/{id}', [AdminController::class,'admin_workorder_details'])->name('admin_workorder_details');
Route::put('/admin/update_workorder/{id}', [AdminController::class,'admin_update_workorder'])->name('admin_update_workorder');
Route::get('/admin/edit_workorder/{id}', [AdminController::class,'admin_edit_workorder'])->name('admin_edit_workorder');
Route::get('/order_list', [AdminController::class,'workorder_list'])->name('order_list');
// ali end

// jahid
Route::get('/dealList', [AdminController::class,'dealList'])->name('dealList');
Route::get('/dealsDetails/{id}', [AdminController::class,'dealsDetails'])->name('dealsDetails');
// 3rd session 
Route::get('/dealOverview/{id}',[Front::class,'dealOverview'])->name('dealOverview'); 
// user add Sabina

Route::get('/add_user/{id}',[AdminController::class,'add_user'])->name('add_userAdmin');
Route::post('/save_userAdmin',[AdminController::class,'save_user'])->name('save_userAdmin');




});



// sabina start

Route::get('/dashboard',[Front::class,'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/profile',[Front::class,'profile'])->name('profile')->middleware('auth');
Route::get('/c_pass',[Front::class,'c_pass'])->name('c_pass')->middleware('auth');
Route::put('/edit_profile/{id}',[Front::class,'edit_profile'])->name('edit_profile')->middleware('auth');
// 2nd innings
Route::get('/add_user',[Front::class,'add_user'])->name('add_user');
Route::post('/save_user',[Front::class,'save_user'])->name('save_user');


// sabina end



//Front site




Route::get('', [Front::class,'index'])->name('index');
Route::get('/signup', [Front::class,'signup'])->name('signup');
//timeline
Route::get('/timeline', [Front::class,'timeline'])->name('timeline');
Route::get('/view_timeline/{id}', [Front::class,'view_timeline'])->name('view_timeline');
Route::get('/go_timeline/{id}', [Front::class,'go_timeline'])->name('go_timeline');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


 // sumaiya starts 
Route::get('/show_companyList/{id}', [App\Http\Controllers\Front::class, 'show_companyList'])->name('show_companyList');
// sumaiya END




// ashiq start
Route::get('/company_profile', [App\Http\Controllers\Front::class, 'company_profile'])->name('company_profile');
Route::get('/visit/{id}', [App\Http\Controllers\Front::class, 'show_company_profile'])->name('show_company_profile');
Route::delete('/delete_companyList/{id}', [AdminController::class, 'delete_companyList'])->name('delete_companyList');

// ashiq end

// jahid
// usermachine form
Route::get('/userMacines', [Front::class,'userMacines'])->name('userMacines')->middleware('auth');
Route::post('/saveUserMachine', [Front::class,'saveUserMachine'])->name('saveUserMachine');
Route::get('/getMachine/{id}', [Front::class,'getMachine']);
// user machine table
Route::get('/getUserMachine', [Front::class,'getUserMachine'])->name('getUserMachine');
Route::get('/editUserMachine/{id}', [Front::class,'editUserMachine'])->name('editUserMachine');
Route::delete('/deleteUserMachine/{id}', [Front::class,'deleteUserMachine'])->name('deleteUserMachine');
Route::put('/updateUserMachine/{id}', [Front::class,'updateUserMachine'])->name('updateUserMachine');
Route::get('/machineDetails/{id}', [Front::class,'machineDetails'])->name('machineDetails');


// post details demo
Route::get('/mechinePostDetails/{id}',[Front::class,'mechinePostDetails'])->name('mechinePostDetails');
Route::get('/workOrderPostDetails/{id}',[Front::class,'workOrderPostDetails'])->name('workOrderPostDetails');
// end demo

// propusal
Route::get('/proposalFrom/{id}/{name}',[Front::class,'proposalFrom'])->name('proposalFrom');
Route::post('/savePropusal',[Front::class,'savePropusal'])->name('savePropusal');
Route::get('/proposalList',[Front::class,'proposalList'])->name('proposalList');
Route::get('/editProposal/{id}',[Front::class,'editProposal'])->name('editProposal');
Route::put('/updatePropusal/{id}',[Front::class,'updatePropusal'])->name('updatePropusal');
Route::delete('/deleteProposal/{id}',[Front::class,'deleteProposal'])->name('deleteProposal');
Route::get('proposal_details/{id}',[Front::class,'Proposal_details'])->name('proposal_details');





// inonnahar
Route::get('/machine_show', [App\Http\Controllers\UserMachine::class, 'machine_show'])->name('userMachine_show');


Route::put('/update_show/{id}', [App\Http\Controllers\UserMachine::class,'update_show'])->name('update_show');
Route::get('/edit_show/{id}', [App\Http\Controllers\UserMachine::class, 'edit_show'])->name('edit_show');



Route::get('/add_userMachine', [App\Http\Controllers\UserMachine::class, 'add'])->name('add_userMachine');
Route::get('/userMachine', [App\Http\Controllers\UserMachine::class, 'index'])->name('userMachine');
Route::get('/userMachineTwo', [App\Http\Controllers\UserMachine::class, 'indexTwo'])->name('userMachineTwo');



//workOrder
Route::get('/workOrder', [App\Http\Controllers\WorkOrder::class, 'index'])->name('workOrder');


// ali start
// Route::get('/edit_order/{id}', [Front::class,'edit_workorder'])->name('edit_order');

// ali end


// iman start
Route::get('/admin/available_machinePost',[AdminController::class,'available_machinePost'])->name('available_machinePost');
Route::delete('/delete_availableMachinePost/{id}', [AdminController::class,'delete_availableMachinePost'])->name('delete_availableMachinePost');
// Route::get('/order_list', [AdminController::class,'machinepost_list'])->name('machinepost_list');

// Route::get('/edit_order/{id}', [Front::class,'edit_workorder'])->name('edit_order');
Route::post('/save_machinepost', [Front::class,'save_machinepost'])->name('save_machinepost');
Route::get('/machinepost', [Front::class,'add_machinepost'])->name('machinepost');

//3rd session
Route::get('/admin/completed_deal',[AdminController::class,"completed_deal"])->name('completed_deal');
// iman end



// inunnahar
//machine status Routes

Route::put('/update_status/{id}', [App\Http\Controllers\MachinePostStatus::class,'update_status'])->name('update_status');
Route::get('/edit_status/{id}', [App\Http\Controllers\MachinePostStatus::class, 'edit_status'])->name('edit_status');
Route::get('/machine_status', [App\Http\Controllers\MachinePostStatus::class, 'machine_status'])->name('machine_status');

// delete matchpost start

// Route::get('/matchedPost', [App\Http\Controllers\MatchedPost::class, 'matchedPost'])->name('matchedPost');
// Route::get('/matchedMachinePost', [App\Http\Controllers\MatchedPost::class, 'matchedMachinePost'])->name('matchedMachinePost');
// delete matchpost end

//matchpost new start
Route::get('/dashboard',[Front::class,'dashboard'])->name('dashboard')->middleware('auth');
Route::delete('/delete_machinePosts/{id}', [Front::class,'front_delete_machinePosts'])->name('delete_machinePosts');

Route::get('/machinePosts_details/{id}', [App\Http\Controllers\Front::class,'machinePosts_details'])->name('machinePosts_details');
//matchpost new end

// expired deadline 
Route::get('/expired_date', [App\Http\Controllers\Front::class, 'expired_date'])->name('expired_date')->middleware('auth');
Route::get('/admin/expired_dates', [App\Http\Controllers\AdminController::class, 'expired_dates'])->name('expired_dates')->middleware('auth');

// Route::get('/workorder_details/{id}', [App\Http\Controllers\MatchedPost::class,'workorder_details'])->name('order_details');
Route::get('/machinePosts_details/{id}', [App\Http\Controllers\MatchedPost::class,'machinePosts_details'])->name('machinePosts_details');

// arif start
Route::get('/admin/cash_ledger',[AdminController::class,'cash_ledger'])->name('cash_ledger');
Route::post('/admin/cash_ledger_search',[AdminController::class,'cash_ledger_search'])->name('cash_ledger_search');
Route::get('/all_post',[Front::class,'all_post'])->name('all_post');
Route::get('/all_category',[Front::class,'all_category'])->name('all_category');
Route::get('/contact',[Front::class,'contact'])->name('contact');

// arif end

