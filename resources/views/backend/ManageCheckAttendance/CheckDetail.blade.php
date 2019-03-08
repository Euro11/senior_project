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
                        <h3><a href="{{ url('/ManageCheckAttendance')}}"><button class="btn btn-light"><i class="fas fa-arrow-left"></i></button></a>
                        <b>{{ $section->sub_name }} :</b> Section {{ $section->name}} {{ $section->day_name}} ( {{ $section->class_date}} )</h3>
                    </div>
                        <form action="{{ route('section.updatestatus',$section->id) }}" method="POST" style="margin-right: 10px;">
                            {{ csrf_field() }}
                            @if($section->check_button_status == '0')
                                <button type="submit" class="btn btn-success btn-lg" name="check_button_status" value="1"><i class="fas fa-play"></i> <b>เริ่มการเช็คชื่อ</b></button> 
                            @elseif($section->check_button_status == '1')
                                <button type="submit" class="btn btn-warning btn-lg" name="check_button_status" value="2"><i class="fas fa-pause"></i> <b>หมดเวลาเช็คชื่อ</b></button>
                                <button type="submit" class="btn btn-danger btn-lg" name="check_button_status" value="0"><i class="fas fa-power-off"></i> <b>หมดเวลาเรียน</b></button>
                            @elseif($section->check_button_status == '2')
                                <button type="submit" class="btn btn-danger btn-lg" name="check_button_status" value="0"><i class="fas fa-power-off"></i> <b>หมดเวลาเรียน</b></button>
                            @endif

                        </form><br>
                    <table id="datatables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ชื่อ</th>
                                <th width="20%">เวลา</th>
                                <th width="10%">ตำแหน่ง</th>
                                <th width="20%">Re-check</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $d)
                            @if($d->status_check == 0 || $d->status_check == 2)
                            <tr>
                                <td>{{ $d->name }}</td>
                                <td>{{ $d->created_at }}</td>
                                <td class="text-center">
                                    <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" data-lat='{{ $d->user_lat }}' data-lng='{{ $d->user_lon }}'><i class="fas fa-map-marked-alt"></i></button>
                                </td>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-12">
                                    <div style="width: 600px; height: 400px;" id="map_canvas" class="shadow rounded"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        </div>
                        <!-- End modal -->

                                <td>
                                    <div class="form-group d-flex justify-content-around">
                                        <a href="{{ route('ManageCheckAttendance.edit', $d->id) }}"> 
                                            <button type="submit" class="btn btn-success">Agree <i class="fas fa-check"></i></button>
                                        </a>

                                        <form action="{{ route('ManageCheckAttendance.destroy', $d->id) }}" method="POST">
                                        {!! method_field('DELETE') !!}
                                        @csrf
                                            <button type="submit" class="btn btn-danger">Cancel <i class="fa fa-times"></i></button>
                                        </form>            
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table> 
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h1><b>ยืนยันสำเร็จ</b></h1>
                    </div>
                    <table class="table table-striped table-bordered table-success">
                        <thead>
                            <tr>
                                <th>ชื่อ</th>
                                <th>เวลา</th>
                                <th>ยืนยันเมื่อ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $d2)
                                @if($d2->status_check == 1)
                                <tr>
                                    <td>{{ $d2->name }}</td>
                                    <td>{{ $d2->created_at }}</td>
                                    <td>{{ $d2->updated_at }}</td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    <h1><b>สาย</b></h1>
                    <table class="table table-striped table-bordered table-success">
                        <thead>
                            <tr>
                                <th>ชื่อ</th>
                                <th>เวลา</th>
                                <th>ยืนยันเมื่อ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $d2)
                                @if($d2->status_check == 3)
                                <tr>
                                    <td>{{ $d2->name }}</td>
                                    <td>{{ $d2->created_at }}</td>
                                    <td>{{ $d2->updated_at }}</td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table> 
                    <h1><b>ขาดเรียน</b></h1>
                    <table class="table table-striped table-bordered table-success">
                        <thead>
                            <tr>
                                <th>ชื่อ</th>
                                <th>เวลา</th>
                                <th>ยืนยันเมื่อ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $d2)
                                @if($d2->status_check == 4)
                                <tr>
                                    <td>{{ $d2->name }}</td>
                                    <td>{{ $d2->created_at }}</td>
                                    <td>{{ $d2->updated_at }}</td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table> 
                </div>
                <span class="text-muted">Notice : ( id = 0 เช็คชื่อแล้ว ยังไม่ยืนยัน,
                 id = 1 เช็คชื่อแล้ว ยืนยันแล้ว,
                 id = 2 เช็คชื่อแล้ว สาย ยังไม่ยืนยัน,
                 id = 3 เช็คชื่อแล้ว สาย ยืนยันแล้ว,
                 id = 4 ขาดเรียน )</span>
                
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script>
$(document).ready(function() {
    var map = null;
    var myMarker;
    var myLatlng;

    // Re-init map before show modal
    $('#myModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        initializeGMap(button.data('lat'), button.data('lng'));
        $("#map_canvas").css("width", "100%");
    });

    // Trigger map resize event after modal shown
    $('#myModal').on('shown.bs.modal', function() {
        google.maps.event.trigger(map, "resize");
        map.setCenter(myLatlng);
    });

    function initializeGMap(lat, lng) {
        myLatlng = new google.maps.LatLng(lat, lng);

        var myOptions = {
          zoom: 15,
          center: myLatlng,
        };

        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

        myMarker = new google.maps.Marker({
          position: myLatlng
        });
        myMarker.setMap(map);
    }
});
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHFYchVRd2Z8w1WzLtQNA9krlwk8Up25Q&callback=myMap"></script>
@endsection