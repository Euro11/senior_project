@extends('auth.inc.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-top: 10%;">
                <div class="card-body">
                <br><div class="card-title text-center"><h1>I NEED TO CHECK</h1></div><br>
                    <form method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <div class="col-sm-2"></div>
                            <div class="col-md-8">
                                <label for="name"><i class="fa fa-user-circle"></i> ชื่อ-สกุล</label>
                                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="ชื่อ-สกุล" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif                                
                            </div>
                            <div class="col-sm-2"></div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-2"></div>
                            <div class="col-md-8">
                                <label for="email"><i class="fa fa-at"></i> อีเมล์</label>
                                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="อีเมล์" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif                                
                            </div>
                            <div class="col-sm-2"></div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-2"></div>
                            <div class="col-md-8">
                                <label for="password"><i class="fa fa-key"></i> รหัสผ่าน</label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="รหัสผ่าน" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif                                                        
                            </div>
                            <div class="col-sm-2"></div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-2"></div>
                            <div class="col-md-8">
                                <label for="password-confirm"><i class="fa fa-check-circle"></i> ยืนยันรหัสผ่าน</label>
                                <input id="password-confirm" type="password" class="form-control" placeholder="ยืนยันรหัสผ่าน" name="password_confirmation" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
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
                                    {{ __('ลงทะเบียน') }}
                                </button>
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-md">
                    <a href="{{ route('login') }}">
                        <button type="submit" class="btn login-button btn-lg btn-block">
                            {{ __('เข้าสู่ระบบ') }}
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
