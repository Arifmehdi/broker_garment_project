@extends('admin/layout')

@section('content')
<br><br><br><br>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Category List</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th> Name</th>

                                        <th> Address</th>
                                        <th> Phone</th>
                                        {{-- <th> Email</th> --}}

                                        {{-- <th> Company Bio</th> --}}
                                        <!-- <th> Company Profile First</th>
                                      <th> Company Profile Last</th>
                                      -->
                                        <th> Machine Post Limits</th>
                                        <th> Work Post Limits</th>
                                        <!-- <th> Trade License</th>
                                      <th> Logo</th>
                                      <th> Certificates</th>
                                      <th> Map</th> -->

                                        <th> Status</th>
                                        <th colspan="2" style="justify-content: center;">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        @if($data)
                                        @foreach ($data as $k=>$l)
                                    <tr>
                                        <td>{{++$k}}</td>

                                        <td>{{$l->name}}</td>
                                        <td>{{$l->address}}</td>
                                        <td>{{$l->phone}}</td>
                                        {{-- <td>{{$l->email}}</td> --}}
                                        {{-- <td>{{$l->company_bio}}</td> --}}
                                        <!-- <td style="min-width:500px; min-height:80px;word-wrap: break-word;">{{$l->company_profile_one}}</td>
                                        <td style="min-width:500px; min-height:80px;word-wrap: break-word;">{{$l->company_profile_two}}</td>
                                         -->
                                        <td>{{$l->machine_post_limits}}</td>
                                        <td>{{$l->work_post_limits}}</td>

                                        <td>
                                            <select name="status" id="">
                                                <option value="" class="form-control">Select Option</option>
                                                <option value="active" <?php if($l->status == 'active'){ echo
                                                    "selected";} ?>>Actiive</option>
                                                <option value="inactive" <?php if($l->status == 'inactive'){ echo
                                                    "selected";} ?>>Inactive</option>
                                                <option value="pending" <?php if($l->status == 'pending'){ echo
                                                    "selected";} ?>>Pending</option>
                                            </select>
                                        </td>



                                        <td>
                                        <a href="{{route('add_userAdmin',$l->id)}}" class="btn btn-primary btn-sm">Add User</a>
                                     </td>

                                        <td>
                                            <a href="{{route('edito_company',$l->id)}}"
                                                class="btn btn-primary btn-xs"><i class="fas fa-edit"></i></a>
                                            <a href="{{route('show_companyList',$l->id)}}"
                                                class="btn btn-info btn-xs"><i class=" fas fa-eye"></i></a>
                                            <form action="{{route('delete_companyList',$l->id)}}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-xs"
                                                    onclick="return confirm('Are You Sure???')"> <i
                                                        class=" fas fa-trash-alt"></i> </button>
                                            </form>
                                            <a href="{{route('machineListInd',$l->id)}}"
                                                class="btn btn-success btn-xs"><i class=" fas fa-list"></i></a>
                                            <!-- <a href="" class="btn btn-danger btn-xs" ><i class=" fas fa-cut"></i></a> -->
                                        </td>

                                    </tr>

                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection