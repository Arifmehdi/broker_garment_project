@extends('admin/layout')

@section('content')

<div class="row">
    <div class="col-sm-12">
     

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Company</h3></div>
            <div class="card-body">
                <div class="form">
                    <form class="cmxform form-horizontal tasi-form"  method="post" action="{{route('add_company')}}" enctype="multipart/form-data">
                    @csrf    
                    <table class="table">
                            <tr>
                                <td> <label for="name" class="">Name </label></td>
                                <td colspan="2"><input class="form-control" type="text" name="name" required  placeholder="Name"></td>
                                <td> <label for="email" class="">Address </label></td>
                                <td colspan="2"><input class="form-control" type="text" name="address" required  placeholder="Address"></td>
                                
                            </tr>

                            <tr>
                                <td> <label for="profile" class="">Company Bio </label></td>
                                <td colspan="5"><textarea  id="" cols="15" rows="2" name="company_bio" class="form-control" placeholder="Company bio" required></textarea></td>
                                
                            </tr>

                            <tr>
                                <td> <label for="name" class="">Company Profile  First</label></td>
                               <td colspan="2"><textarea  id="" cols="15" rows="2" name="company_profile_one" class="form-control" placeholder="Company profile first" required></textarea></td>
                                <td> <label for="email" class="">Company Profile Last </label></td>
                                <td colspan="2"><textarea  id="" cols="15" rows="2" name="company_profile_two" class="form-control" placeholder="Company profile last (If any)" ></textarea></td>
                                
                            </tr>

                            
                            <tr>
                                <td> <label for="email" class="">Trade Licence </label></td>
                                <td colspan="2"><input class="form-control" type="file" name="trade_license" required="" aria-required="true"></td>
                                <td> <label for="profile" class="">Logo </label></td>
                                <td colspan="2"><input class="form-control" type="file" name="logo" required="" aria-required="true"></textarea></td>
                                <td></td>

                            </tr>

                            <tr>
                                 <td> <label for="email" class="">Certificates </label></td>
                                	<!-- <input type="file" id="file" name="myfiles[]" multiple /> -->
                                <td colspan="2"><input class="form-control" type="file" name="certificates[]" required="" aria-required="true" multiple/></td>
                                <td> <label for="profile" class="">Photo </label></td>
                               <td colspan="2"> <input class="form-control" type="file" name="photo" required="" aria-required="true"></td>
                             
                            </tr>

                            <tr>
                                 
                                <td> <label for="profile" class="">Phone </label></td>
                                <td colspan="2"><input class="form-control" type="text" name="phone" required="" aria-required="true" placeholder="Phone"></td>
                                <td> <label for="email" class="">E-mail </label></td>
                                	<!-- <input type="file" id="file" name="myfiles[]" multiple /> -->
                                <td colspan="2"><input class="form-control" type="email" name="email" required="" aria-required="true" placeholder="Email"></td>
                                
                            </tr>
                            <tr>
                                <td> <label for="profile" class="">Map </label></td>
                                <td colspan="5"><textarea  id="" cols="15" rows="2" name="map" class="form-control" placeholder="Map" required></textarea></td>

                            </tr>

                            <tr>
                                <td> <label for="email" class="">Machine Post Limits</label></td>
                                	<!-- <input type="file" id="file" name="myfiles[]" multiple /> -->
                                <td><input class="form-control" type="number" name="machine_post_limits" required="" aria-required="true" placeholder="Machine post limit"></td>
                                <td> <label for="profile" class="">Work Post Limits </label></td>
                               <td> <input class="form-control" type="number" name="work_post_limits" required="" aria-required="true" placeholder="Work post limit"></td>
                               <td> <label for="profile" class="">Status</label></td>
                               <!-- <td> <input type="radio" name="status" value="active">&nbsp;&nbsp;Active &nbsp; &nbsp; &nbsp;<input type="radio" name="status" value="inactive" checked>&nbsp;&nbsp;Inactive</td> -->
                               <td>
                                <select name="status" id="" class="form-control" required>
                                    <option value="">Select Option</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="pending">Pending</option>
                               </select>
                            </td>
                                
                            </tr>
                            <tr>
                            <!-- <td colspan="3"></td> -->
                            <td > <input type="reset" class="btn  btn-block btn-secondary waves-effect" value="Reset"></td>
                            <td colspan="2"><button class="btn btn-block btn-success waves-effect waves-light mr-1" type="submit">Save</button></td>
                              
                            </tr>

                        </table>
                    </form>
                </div>
                <!-- .form -->
            </div>
            <!-- card-body -->
        </div>
        <!-- card -->
    </div>
    <!-- col -->
</div>
                        <!-- End row -->

@endsection


 
                       