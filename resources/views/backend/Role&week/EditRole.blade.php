@extends('backend.inc.app')
@section('stylesheet')
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
                    <form method="POST" action="{{route('role.update', $role->id)}}">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('Role id') }}</label>

                            <div class="col-md-6">
                                <input id="id" type="text" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id" value="{{ $role->id }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role_name" class="col-md-4 col-form-label text-md-right">{{ __('Role Name') }}</label>

                            <div class="col-md-6">
                                <input id="role_name" type="text" class="form-control{{ $errors->has('role_name') ? ' is-invalid' : '' }}" name="role_name" value="{{ $role->role_name }}" required autofocus>
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
@endsection