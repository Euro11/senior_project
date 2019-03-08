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
                    <table id="table" class="table table-striped table-bordered table-sm text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th width="5%">รหัสนักศึกษา</th>
                                <th width="5%">Member</th>
                                @for ($i = 1; $i <= 15; $i++)                               
                                    <th>{{$i}}</th>
                                @endfor
                                <th>คะแนนรวม</th>
                                <th>ผ่าน/ไม่ผ่าน</th>
                                <th>รายงาน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- ประกาศตัวแปล จำนวนผู้ใช้, จำนวนคอลลัมน์, สกอร์-->
                            <?php $countUsers = 0; $countCol = 0; $score = 0.0; ?>
                            @foreach($users as $u)
                            <tr>
                                <td><?php echo ++$countUsers; ?></td>
                                <td><a href="">{{ $u->std_id }}</a></td>
                                <td class="text-center">
                                    <img class="member-card-image" src="{{ asset("img/img_profile/$u->img_profile")}}">
                                    <p class="member-card-text">{{ $u->name }}</p>
                                </td>
                                @foreach($static as $s)
                                    @if($s->name == $u->name)
                                        @if($s->status_check == 1)
                                            <td>1</td>
                                            <!-- รวมสกอร์ นับแถวที่ถูกใช้ไป -->
                                            <?php $score += 1.0;$countCol += 1 ?>
                                        @elseif($s->status_check == 3)
                                            <td>0.5</td>
                                            <!-- รวมสกอร์ นับแถวที่ถูกใช้ไป -->
                                            <?php $score += 0.5;$countCol += 1 ?>
                                        @elseif($s->status_check == 4)
                                            <td>0</td>
                                            <!-- นับแถวที่ถูกใช้ไป -->
                                            <?php $countCol += 1; ?>
                                        @endif
                                    @endif
                                @endforeach
                                @for($j = $countCol; $j < 15; $j++)
                                    <td></td>
                                @endfor

                                <td>{{ $score}}</td>

                                @if($score <= 12)
                                    <td class="danger">ไม่ผ่าน</td>
                                @else
                                    <td class="success">ผ่าน</td>
                                @endif
                                <td>
                                    <a href="{{ route('ViewStatistics.edit', $u->id)}}">
                                        <button type="submit" class="btn btn-warning btn-block"><i class="far fa-share-square"></i></button>
                                    </a> 
                                </td>
                            </tr>
                            <!-- รีเซ็ตค่าให้เป็นเริ่มต้น -->
                            <?php $score = 0.0; $countCol = 0; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><br>
            
        </div>
    </div>
</div>
@endsection
@section('javascript')
@endsection