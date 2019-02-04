@extends('frontend.inc.template')

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
                <div class="card-header">
                    <a href="{{ route('viewsubject.show', $user->id ) }}"><button class="btn btn-light"><i class="fas fa-arrow-left"></i></button></a>
                    <b>{{ $section->sub_name }} : Section {{ $section->name}} {{ $section->day_name}} ( {{ $section->class_date}} )</b>
                </div>
                <div class="card-body row">
                    <div class="col-md-12">
                        <b>รหัสวิชา :</b> {{ $section->subject_id }} <br>
                        <b>ปีการศึกษา :</b> {{ $section->year }} <br>
                        <b>อาจารย์ผู้สอน :</b> {{ $section->teacher_name }} <br>
                        <b>คำอธิบายรายวิชา :</b> {!! $section->sub_description !!} <br>
                    </div>
                    @foreach($usersAll as $u)
                        @if($user->id == $u->student_id)
                        <div class="col-md-12 text-center">
                            <a href="{{ route('checkattendance.show', $user->id) }}">
                                <button class="btn btn-success btn-lg btn-block">เช็คชื่อ</button>
                            </a>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div><br>

            <div class="card">
                <div class="card-body">  
                    <div class="card-title">
                        <b>Members ({{ $section->std_count }})</b>
                    </div>
                    <hr>
                    <div class="row text-center">                        
                        @foreach($usersAll as $u)
                            <div class="card member-card">
                                <div class="card-body ">
                                    <img class="member-card-image" src="{{ asset("img/img_profile/$u->img_profile")}}">
                                    <p class="member-card-text">{{ $u->name }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div><br>

        </div>
    </div>
</div>
@endsection