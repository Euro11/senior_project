@extends('backend.inc.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Create Section</h3>
                    </div>
                    <form method="POST" action="{{ route('section.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Section') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="number" class="form-control" name="name" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="year" class="col-md-4 col-form-label text-md-right">{{ __('ปีการศึกษา') }}</label>

                            <div class="col-md-6">
                                <input id="year" type="text" class="form-control" name="year" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="class_date" class="col-md-4 col-form-label text-md-right">{{ __('เวลาเรียน') }}</label>

                            <div class="col-md-6">
                                <input id="class_date" type="text" class="form-control" name="class_date" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="class_day" class="col-md-4 col-form-label text-md-right">{{ __('วันที่เรียน') }}</label>

                            <div class="col-md-6">                                   
                                <select id="class_day" class="select2-multi form-control" name="class_day">
                                  <option value="1">1 : อาทิตย์</option>
                                  <option value="2">2 : จันทร์</option>
                                  <option value="3">3 : อังคาร</option>
                                  <option value="4">4 : พุธ</option>
                                  <option value="5">5 : พฤหัสบดี</option>
                                  <option value="6">6 : ศุกร์</option>
                                  <option value="7">7 : เสาร์</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="teacher_id" class="col-md-4 col-form-label text-md-right">{{ __('อาจารย์ผู้สอน') }}</label>

                            <div class="col-md-6">                                   
                                <select id="teacher_id" class="select2-multi form-control" name="teacher_id">
                                  @foreach($teacher as $t)
                                      <option value="{{ $t->id}}">{{ $t->name}}</option>
                                  @endforeach
                                </select>
                                </div>
                        </div>

                        <div class="form-group row">
                            <label for="subject_id" class="col-md-4 col-form-label text-md-right">{{ __('Subject ID') }}</label>

                            <div class="col-md-6">
                                <input id="subject_id" type="text" class="form-control{{ $errors->has('subject_id') ? ' is-invalid' : '' }}" value="{{ $subject->id }}" name="subject_id">
                            </div>
                        </div>

                        <div class="form-group row">                        
                            <div class="col-md-6">
                                <div id="map_canvas" class="shadow rounded"></div>
                            </div>

                            <div class="col-md-6">
                                <label for="sec_lat">Latitude</label>  
                                <input name="sec_lat" type="text" id="lat_value" value="0" class="form-control" readonly><br>
                                <label for="sec_lon">Longitude</label>  
                                <input name="sec_lon" type="text" id="lon_value" value="0" class="form-control" readonly><br>

                                <label for="check_radius">ขอบเขตในการเช็คชื่อ</label>  
                                <input name="check_radius" type="number" value="200" class="form-control"><br>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
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
<script src="{{ asset('js/backend/inputmask.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#class_date').mask('99:99 - 99:99');
    });
</script>

<script type="text/javascript">
var map; // กำหนดตัวแปร map ไว้ด้านนอกฟังก์ชัน เพื่อให้สามารถเรียกใช้งาน จากส่วนอื่นได้
var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น
var geocoder; // กำหนดตัวแปร สำหรับใช้งานข้อมูลสถานที่จาก Google Map
function initialize() { // ฟังก์ชันแสดงแผนที่
    GGM=new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM
    // กำหนดจุดเริ่มต้นของแผนที่
    var my_Latlng  = new GGM.LatLng(14.039493485052665,100.72893570066378);
     
    // เรียกใช้งานข้อมูล Geocoder ของ Google Map
    geocoder = new GGM.Geocoder();
     
    var my_mapTypeId=GGM.MapTypeId.ROADMAP; // กำหนดรูปแบบแผนที่ที่แสดง
    // กำหนด DOM object ที่จะเอาแผนที่ไปแสดง ที่นี้คือ div id=map_canvas
    var my_DivObj=$("#map_canvas")[0]; 
    // กำหนด Option ของแผนที่
    var myOptions = {
        zoom: 17, // กำหนดขนาดการ zoom
        center: my_Latlng , // กำหนดจุดกึ่งกลาง
        mapTypeId:my_mapTypeId // กำหนดรูปแบบแผนที่
    };
    map = new GGM.Map(my_DivObj,myOptions);// สร้างแผนที่และเก็บตัวแปรไว้ในชื่อ map
     
    var my_Marker = new GGM.Marker({ // สร้างตัว marker
        position: my_Latlng,  // กำหนดไว้ที่เดียวกับจุดกึ่งกลาง
        map: map, // กำหนดว่า marker นี้ใช้กับแผนที่ชื่อ instance ว่า map
        draggable:true, // กำหนดให้สามารถลากตัว marker นี้ได้
        title:"คลิกลากเพื่อหาตำแหน่งจุดที่ต้องการ!" // แสดง title เมื่อเอาเมาส์มาอยู่เหนือ
    });
     
    // กำหนด event ให้กับตัว marker เมื่อสิ้นสุดการลากตัว marker ให้ทำงานอะไร
    GGM.event.addListener(my_Marker, 'dragend', function() {
        var my_Point = my_Marker.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
        map.panTo(my_Point);  // ให้แผนที่แสดงไปที่ตัว marker           
         
        $("#lat_value").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
        $("#lon_value").val(my_Point.lng()); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
    });
}
$(function(){  
    // โหลด สคริป google map api เมื่อเว็บโหลดเรียบร้อยแล้ว  
    // ค่าตัวแปร ที่ส่งไปในไฟล์ google map api  
    // v=3.2&sensor=false&language=th&callback=initialize  
    //  v เวอร์ชัน่ 3.2  
    //  sensor กำหนดให้สามารถแสดงตำแหน่งทำเปิดแผนที่อยู่ได้ เหมาะสำหรับมือถือ ปกติใช้ false  
    //  language ภาษา th ,en เป็นต้น  
    //  callback ให้เรียกใช้ฟังก์ชันแสดง แผนที่ initialize  
    $("<script/>", {  
      "type": "text/javascript",  
      src: "//maps.google.com/maps/api/js?v=3.2&key=AIzaSyAQXosTo6eybkdXeg18K9wEds1n7SOxfiw&sensor=false&language=th&callback=initialize"
    }).appendTo("body");      
});
</script> 
@endsection