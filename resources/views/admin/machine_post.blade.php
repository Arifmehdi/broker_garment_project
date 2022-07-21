@extends('admin/layout')

@section('content')
<br><br><br><br>
<div class="row">
    <!-- Basic example -->
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> Machine Post</h3></div>
            <div class="card-body">

               
                <table class="table table-bordered">
            <tr>
                <th>SL</th>
                <th>Title</th>
                <th>Number of machine</th>
                <th>Status</th>
                
                <th>Action</th>
            </tr>
            
            @foreach ($p as $sl => $m)
                <tr>
                    <td>{{++$sl}}</td>
                   
                    <td>{{$m->title}}</td>
                    <td>{{$m->number_of_machine}}</td>
                    <td>{{$m->status}}</td>
                    
                    <td>
                        <a href="" class="btn btn-success"><i class="fas fa-edit"></i></a>
                        <a href="" class="btn btn-primary"><i class=" fas fa-eye"></i></a>
                        <form action="{{route('delete',$m->id)}}" method="post" >
                        @method('delete')
                        @csrf
                             <button   class="btn btn-danger" onclick="return confirm('Are you sure ?')"><i class="fas fa-trash-alt"></i></button>
                        </form>

                    </td>
                </tr>
            @endforeach 
        </table>
                
            </div>
            <!-- card-body -->
        </div>
        <!-- card -->
    </div>
</div>


@endsection