@extends('backend.inc.app')

@section('stylesheet')
@endsection
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
                <div class="card-header">
                    <h3><a href="{{ url('/managesubject')}}">Manage Subject</a> > <a href="{{ URL::previous() }}">Section</a> > <a href="{{ URL::previous() }}">User in class</a> > Adding Users</h3>
                </div>
            </div>
<br>
    <div class="card">
        <div class="card-body">
            <!-- Form -->
            <form method="POST" action="{{ route('class.store') }}">
            @csrf
                <!-- Section --> 
                <div class="card-title">
                    <h3>Section</h3>
                </div>
                <div class="form-group row">
                    <label for="section_id" class="col-md-4 col-form-label text-md-right">{{ __('Section ID') }}</label>

                    <div class="col-md-6">                                   
                        <input type="text" class="form-control" name="section_id" value="{{ $section->id }}">
                    </div>
                </div>

                <!-- add student -->
                <div class="card-title">
                    <h3>Student</h3>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">{{ __('Student') }}</label>

                    <div class="col-md-6">
                        <table id="datatables" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="5">ID.</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($student as $s)
                                <tr>
                                    <td>{{ $s->id }}</td>
                                    <td>{{ $s->name }}</td>
                                    <td><input type="checkbox" name="student_id[]" value="{{ $s->id }}"> ADD to class</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> 
                
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Add') }}
                        </button>
                        <a href="{{ URL::previous() }}" class="btn btn-outline-primary">
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
@section('javascript')
@endsection