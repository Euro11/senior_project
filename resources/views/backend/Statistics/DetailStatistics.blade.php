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
                        <h3><a href="{{ url('/ViewStatistics')}}"><button class="btn btn-light"><i class="fas fa-arrow-left"></i></button></a>
                        <b>สถิติวิชา {{ $section->sub_name }} :</b> Section {{ $section->name}} {{ $section->day_name}} ( {{ $section->class_date}} )</h3>
                    </div>
                    <table id="datatables" class="table table-striped table-bordered table-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th width="11%">No.</th>
                                <th width="5%">Member</th>
                                @for ($i = 1; $i <= 15; $i++)                               
                                    <th>{{$i}}</th>
                                @endfor
                                <th>รวม</th>
                                <th>ผ่าน/ไม่ผ่าน</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $u)
                            <tr>
                                <td><a href="">{{ $u->std_id }}</a></td>
                                <td class="text-center">
                                    <img class="member-card-image" src="{{ asset("img/img_profile/$u->img_profile")}}">
                                    <p class="member-card-text">{{ $u->name }}</p>
                                </td>
                                @for ($i = 1; $i <= 15; $i++)                               
                                    <td></td>
                                @endfor
                                <td></td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table> 
                </div>
            </div><br>
            
        </div>
    </div>
</div>
@endsection