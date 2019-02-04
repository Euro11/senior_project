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
                        <h3><a href="{{ url('/managesubject')}}">Manage Subject</a> > <a href="{{ route('managesubject.show', $section->subject_id)}}">Section</a> > Users in class</h3>
                    </div>
                    <div class="text-right">
                        <a href="{{ route('class.show', $section->id ) }}"> 
                            <button type="button" class="btn btn-primary"><i class="fa fa-plus-circle"></i> ADD Users</button>
                        </a>
                    </div><br>
                    <table id="datatables2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="5">ID.</th>
                                    <th>Name</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($classroom as $c)
                                    <tr>
                                        <td>{{ $c->id }}</td>
                                        <td>{{ $c->name }}</td>
                                        <td>
                                            <div class="form-group d-flex justify-content-around">
                                                <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#modalConfirm"><i class="fa fa-times"></i> delete </button>
                                                <!-- Modal Confirm -->
                                                <div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog modal-sm" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-body text-center">
                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <i class="fas fa-exclamation-triangle fa-5x"></i><br>
                                                        คุณต้องการ "ลบ" ผู้ใช้ออกจากกลุ่มใช่หรือไม่ ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{route('class.destroy', $c->id)}}" method="POST">
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
        </div>
    </div>
</div>
@endsection