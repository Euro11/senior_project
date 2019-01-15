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
                        <h3><a href="{{ url('/managesubject')}}">Manage Subject</a> > <a href="{{ URL::previous() }}">Section</a> > Users in class</h3>
                    </div>
                    <div class="text-right">
                        <a href="{{ route('class.show', $section->id ) }}"> 
                            <button type="button" class="btn btn-primary"><i class="fa fa-plus-circle"></i> ADD Users</button>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection