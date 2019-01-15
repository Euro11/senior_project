@extends('backend.inc.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
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
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Users Role</h3>
                    </div>
                    <table id="datatables" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th width="5">No.</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($role as $r)
                                <tr>
                                    <td>{{ $r->id }}</td>
                                    <td>{{ $r->role_name }}</td>
                                    <td>
                                        <div class="form-group d-flex justify-content-around">
                                            <a href="{{ route('role.edit', $r->id)}}"> 
                                                <button type="submit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></button>
                                            </a>
                                            <form action="{{ route('role.destroy', $r->id)}}" method="POST">
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
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Create Users Role</h3><br>
                    </div>
            <form method="POST" action="{{ route('role.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="role_name" class="col-md-4 col-form-label text-md-right">{{ __('Role Name') }}</label>

                            <div class="col-md-6">
                                <input id="role_name" type="text" class="form-control{{ $errors->has('role_name') ? ' is-invalid' : '' }}" name="role_name">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Create') }}
                                </button>
                                <a href="{{ URL::previous() }}" class="btn btn-outline-success">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Day Name</h3>
                    </div>
                    <table id="datatables" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th width="5">No.</th>
                                <th>Day Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($week as $w)
                                <tr>
                                    <td>{{ $w->id }}</td>
                                    <td>{{ $w->day_name }}</td>
                                    <td>
                                        <div class="form-group d-flex justify-content-around">
                                            <a href="{{ route('week.edit', $w->id)}}"> 
                                                <button type="submit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></button>
                                            </a>
                                            <form action="{{ route('week.destroy', $w->id)}}" method="POST">
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
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Create Day Name</h3><br>
                    </div>
            <form method="POST" action="{{ route('week.store') }}">
                @csrf
                <div class="form-group row">
                    <label for="day_name" class="col-md-4 col-form-label text-md-right">{{ __('Day Name') }}</label>

                    <div class="col-md-6">
                        <input id="day_name" type="text" class="form-control{{ $errors->has('day_name') ? ' is-invalid' : '' }}" name="day_name">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-success">
                            {{ __('Create') }}
                        </button>
                        <a href="{{ URL::previous() }}" class="btn btn-outline-success">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection