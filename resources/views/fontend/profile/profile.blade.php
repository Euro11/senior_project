@extends('fontend.inc.template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button> 
                  <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="card">
                <div class="card-header"><b>ข้อมูลส่วนตัว</b></div>

                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">                            
                            <img class="img_profile" src="{{ asset("img/img_profile/$user->img_profile")}}">
                        </div>
                        <div class="col-md-6 text-left">
                            <br><br>
                            <p><b>Name : </b>{{ $user->name }}</p>
                            <p><b>รหัสนักศึกษา : </b>{{ $user->std_id }}</p>
                            <p><b>E-mail : </b>{{ $user->email }}</p>
                            <br>
                        </div>     
                        <div class="col-md-12 text-center">
                            <a href="{{ route('profile.edit', $user->id)}}">
                                <button type="submit" class="btn btn-warning">แก้ไขข้อมูลส่วนตัว</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection