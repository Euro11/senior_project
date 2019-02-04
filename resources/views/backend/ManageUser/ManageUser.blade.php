@extends('backend.inc.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button> 
                  <strong>{{ $message }}</strong>
                </div>
            @endif
            @if ($message = Session::get('warning'))
                <div class="alert alert-warning alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button> 
                  <strong>{{ $message }}</strong>
                </div>
            @endif
            @if ($message = Session::get('delete'))
                <div class="alert alert-danger alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button> 
                  <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Manage Users</h3>
                    </div>
                    <div class="text-right">
                        <a href="{{route('manageuser.create')}}"> 
                            <button type="button" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create New</button>
                        </a>
                    </div>
                    <table id="datatables" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th width="5">No.</th>
                                <th>Member</th>
                                <th>E-mail</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->role_name }}</td>
                                    <td>
                                        <div class="form-group d-flex justify-content-around">
                                            <a href="{{route('manageuser.edit', $value->id)}}"> 
                                                <button type="submit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></button>
                                            </a>
                                            <a href="{{ url('/changepassword', $value->id) }}">
                                                <button type="submit" class="btn btn-info"><i class="fas fa-exchange-alt"></i> Password</button>
                                            </a>
                                            <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#modalConfirm"><i class="fa fa-times"></i></button>
                                            <!-- Modal Confirm -->
                                            <div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog modal-sm" role="document">
                                              <div class="modal-content">
                                                <div class="modal-body text-center">
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <i class="fas fa-exclamation-triangle fa-5x"></i><br>
                                                    คุณต้องการ "ลบ" ผู้ใช้ท่านนี้ ?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{route('manageuser.destroy', $value->id)}}" method="POST">
                                                        {!! method_field('DELETE') !!}
                                                        @csrf
                                                        <button type="submit" class="btn btn-success">ใช่</button>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">ไม่ใช่</button>
                                                    </form>
                                                </div>
                                              </div>
                                            </div>
                                            </div>
                                            <!-- End modal -->
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> 
                </div>
            </div>


            @if(Auth::user()->role == 3)
            <br>
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>For Admin</h3>
                    </div>
                    <a href="{{ url('/changepassword', Auth::user()->id) }}">
                        <button class="btn btn-primary">Change Admin Password</button>                        
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection