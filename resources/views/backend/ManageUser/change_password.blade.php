@extends('backend.inc.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md">
            @if ($message = Session::get('delete'))
                <div class="alert alert-danger alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button> 
                  <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Change Password</h3>
                    </div>
                    <form method="POST" action="{{ url('/confirmpassword', $users->id) }}">
                        @csrf
                        <div class="form-group row">
                            <label for="passwordold" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>

                            <div class="col-md-6">
                                <input id="passwordold" type="passwordold" class="form-control{{ $errors->has('passwordold') ? ' is-invalid' : '' }}" name="passwordold" required>

                                @if ($errors->has('passwordold'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('passwordold') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Change Password') }}
                                </button>
                                <a href="{{ url('/manageuser') }}" class="btn btn-outline-primary">
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