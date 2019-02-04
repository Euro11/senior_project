@extends('auth.inc.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-top: 10%;">
                <div class="card-body">
                <br><div class="card-title text-center"><h1>I NEED TO CHECK</h1></div><br>
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <div class="col-sm-2"></div>
                            <div class="col-md-8">
                                <label for="email" class="col-form-label text-md-right"><i class="fa fa-user-circle"></i> {{ __('อีเมล์') }}</label><br>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="emxample@gmail.com" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-2"></div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-2"></div>
                            <div class="col-md-8">
                                <label for="password" class="col-form-label text-md-right"><i class="fa fa-key"></i> {{ __('รหัสผ่าน') }}</label><br>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="รหัสผ่าน" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-2"></div>
                        </div><br>

                        <div class="form-group row mb-3">
                            <div class="col-sm-2"></div>
                            <div class="col-md-8">
                                <button type="submit" class="btn login-button btn-lg btn-block">
                                    {{ __('เข้าสู่ระบบ') }}
                                </button>
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-md">
                    <a href="{{ route('register') }}">
                        <button type="submit" class="btn login-button btn-lg btn-block">
                            {{ __('ลงทะเบียน') }}
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
