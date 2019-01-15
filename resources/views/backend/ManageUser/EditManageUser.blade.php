@extends('backend.inc.app')
@section('stylesheet')
<link href="{{asset('css/backend/dropify.min.css')}}" rel="stylesheet" />
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Edit User</h3>
                    </div>
                    <form method="POST" action="{{route('manageuser.update', $users->id)}}">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $users->name }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="std_id" class="col-md-4 col-form-label text-md-right">{{ __('student ID') }}</label>

                            <div class="col-md-6">
                                <input id="std_id" type="text" class="form-control{{ $errors->has('std_id') ? ' is-invalid' : '' }}" name="std_id" value="{{ $users->std_id }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $users->email }}" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                            <div class="col-md-6">                                   
                                <select id="role" class="select2-multi form-control" name="role">
                                  <option value="{{$users->role}}">{{$users->role}}</option>
                                  <option value="1">1 : Student</option>
                                  <option value="2">2 : Teacher</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="img" class="col-md-4 col-form-label text-md-right">{{ __('Profile Picture') }}</label>

                            <div class="col-md-6">
                                <input id="img" type="file" class="dropify" name="img_profile" data-default-file="{{ asset("img/img_profile/$users->img_profile")}}" >
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
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
<!-- dropify -->
<script src="{{asset('js/backend/dropify.min.js')}}"></script>
<script>
    $('.dropify').dropify();
</script>
@endsection