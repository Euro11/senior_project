@extends('fontend.inc.template')
@section('stylesheet')
<link href="{{ asset('fonts/dropify.woff')}}">
<link href="{{ asset('fonts/dropify.ttf')}}">
<link href="{{asset('css/dropify.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card">
                <div class="card-header"><b>ข้อมูลส่วนตัว</b></div>

                <form method="POST" action="{{ route('profile.update', $user->id) }}">
                @csrf
                {{ method_field('PATCH') }}
                <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                    <br><br>              
                        <input id="img" style="z-index: 0" type="file" class="dropify" name="img_profile" data-default-file="{{ asset("img/img_profile/$user->img_profile")}}" >
                    </div>
                    <div class="col-md-6">
                        <br>
                        <label for="name">{{ __('Name : ') }}</label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus><br>

                        <label for="name">{{ __('รหัสนักศึกษา : ') }}</label>
                        <input id="std_id" type="text" class="form-control" name="std_id" value="{{ $user->std_id }}" required autofocus><br>

                        <label for="name">{{ __('E-mail : ') }}</label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" required autofocus><br>
                    </div>     
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">
                            {{ __('อัพเดท') }}
                        </button>
                        <a href="{{ route('profile', $user->id) }}" class="btn btn-outline-primary">
                            {{ __('ยกเลิก') }}
                        </a>
                    </div>
                </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>
<!-- dropify -->
<script src="{{asset('js/dropify.min.js')}}"></script>
<script>
    $('.dropify').dropify();
</script>
@endsection