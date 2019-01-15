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
                        <h3>Manage Subject</h3>
                    </div>
                    <div class="text-right">
                        <a href="{{route('managesubject.create')}}"> 
                            <button type="button" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create New</button>
                        </a>
                    </div>
                    <table id="datatables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>subject id</th>
                                <th>subject name</th>
                                <th>description</th>
                                <th>unit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subject as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->sub_name }}</td>
                                    <td>{!! $value->sub_description !!}</td>
                                    <td>{{ $value->sub_unit }}</td>
                                    <td>
                                        <div class="form-group d-flex justify-content-around">
                                            <a href="{{route('managesubject.show', $value->id)}}"> 
                                                <button type="submit" class="btn btn-info"><i class="fas fa-database"></i></button>
                                            </a>
                                            <a href="{{route('managesubject.edit', $value->id)}}"> 
                                                <button type="submit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></button>
                                            </a>
                                            <form action="{{route('managesubject.destroy', $value->id)}}" method="POST">
                                                {!! method_field('DELETE') !!}
                                                @csrf
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> </button>
                                            </form>

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