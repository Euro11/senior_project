@extends('frontend.inc.template')

@section('content')
<div class="container">
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
                        <h2><a href="{{ route('viewsubject.showMember', [Auth::user()->id, $classroom->section_id] ) }}"><button class="btn btn-light"><i class="fas fa-arrow-left"></i></button></a>
                        เช็คชื่อ</h2>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 text-center">                            
                            <h3>ราดละเอียดวิชา</h3>
                            <b>รหัสวิชา : </b>{{ $classroom->sub_id }}<br>
                            <b>ชื่อวิชา : </b>{{ $classroom->sub_name }}<br><br>
                        </div>
                        <div class="col-md-6 text-center">
                            <div id="map_canvas" class="shadow rounded" style="width:100%;height:400px;"></div>
                        </div> 
                        <div class="col-md-6">
                            <form method="POST" action="{{ route('checkattendance.check', $classroom->id)}}">
                            @csrf
                                <label for="user_lat">Latitude</label>  
                                <input name="user_lat" type="text" id="lat_value" value="0" class="form-control" readonly><br>
                                <label for="user_lon">Longitude</label>  
                                <input name="user_lon" type="text" id="lon_value" value="0" class="form-control" readonly><br> 
                                <label for="distance">ระยะห่าง</label>  
                                <input name="distance" type="text" id="distance-between" value="0" class="form-control " readonly><br>
                                <div class="text-center">
                                    @if($classroom->check_button_status == 1 || $classroom->check_button_status == 2)
                                        <button type="submit" class="btn btn-danger btn-lg">Check-in</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script>
var arr_Destination = [
    {id:1,title:'Place A',lat:{!! $classroom->sec_lat !!},lng:{!! $classroom->sec_lon !!}}
];
var place_Marker = [];
var pos;
var posPlace;
var map; // กำหนดตัวแปร map ไว้ด้านนอกฟังก์ชัน เพื่อให้สามารถเรียกใช้งาน จากส่วนอื่นได้  
var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น  
var my_Marker;  // กำหนดตัวแปรเก็บ marker ตำแหน่งปัจจุบัน หรือที่ระบุ  
var service;
var origins = [];
var destinations = [];
function initialize() { // ฟังก์ชันแสดงแผนที่  
    GGM=new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM  
    
   service = new GGM.DistanceMatrixService();
    // เรียกใช้คุณสมบัติ ระบุตำแหน่ง ของ html 5 ถ้ามี    
    if(navigator.geolocation){
            // หาตำแหน่งปัจจุบันโดยใช้ getCurrentPosition เรียกตำแหน่งครั้งแรกครั้งเดียวเมื่อเปิดมาหน้าแผนที่
            navigator.geolocation.getCurrentPosition(function(position){    
                var myPosition_lat=position.coords.latitude; // เก็บค่าตำแหน่ง latitude  ปัจจุบัน  
                var myPosition_lon=position.coords.longitude;  // เก็บค่าตำแหน่ง  longitude ปัจจุบัน           
                  
                // สรัาง LatLng ตำแหน่ง สำหรับ google map  
                pos = new GGM.LatLng(myPosition_lat,myPosition_lon);    
                origins = [];
                origins.push(pos);             
                  
                // กำหนด DOM object ที่จะเอาแผนที่ไปแสดง ที่นี้คือ div id=map_canvas  
                var my_DivObj=$("#map_canvas")[0];   
                  
                // กำหนด Option ของแผนที่  
                var myOptions = {  
                    zoom: 13, // กำหนดขนาดการ zoom  
                    center: pos , // กำหนดจุดกึ่งกลาง  เป็นจุดที่เราอยู่ปัจจุบัน
                };  
           
                map = new GGM.Map(my_DivObj,myOptions);// สร้างแผนที่และเก็บตัวแปรไว้ในชื่อ map                      
                
                my_Marker = new GGM.Marker({ // สร้างตัว marker  
                    position: pos,  // กำหนดไว้ที่เดียวกับจุดกึ่งกลาง  
                    map: map, // กำหนดว่า marker นี้ใช้กับแผนที่ชื่อ instance ว่า map  
                    icon:"//www.ninenik.com/demo/google_map/images/male-2.png",  
                    draggable:true, // กำหนดให้สามารถลากตัว marker นี้ได้  
                    title:"คลิกลากเพื่อหาตำแหน่งจุดที่ต้องการ!"
                });
                    
                posPlace = new GGM.LatLng(arr_Destination[0].lat,arr_Destination[0].lng);     
                destinations.push(posPlace);

                place_Marker[0] = new GGM.Marker({ // สร้างตัว marker  
                    position: posPlace,  // กำหนดไว้ที่เดียวกับจุดกึ่งกลาง  
                    map: map, // กำหนดว่า marker นี้ใช้กับแผนที่ชื่อ instance ว่า map  
                    icon:"//www.ninenik.com/iconsdata/letter_red/letter_a.png",
                    title:"เรียนที่นี่นะครับนักศึกษา"
                });       
                 
                service.getDistanceMatrix(
                {
                    origins: origins,
                    destinations: destinations,
                    travelMode: 'DRIVING',
                    avoidHighways: true,
                    avoidTolls: true,
                }, callback);                      
                //Current User location 
                $("#lat_value").val(myPosition_lat);
                $("#lon_value").val(myPosition_lon);
                  
                // กำหนด event ให้กับตัว marker เมื่อสิ้นสุดการลากตัว marker ให้ทำงานอะไร
                GGM.event.addListener(my_Marker, 'dragend', function() {
                    var my_Point = my_Marker.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
                    map.panTo(my_Point);  // ให้แผนที่แสดงไปที่ตัว marker           
                    origins = [];
                    origins.push(my_Point);     
                    service.getDistanceMatrix(
                    {
                        origins: origins,
                        destinations: destinations,
                        travelMode: 'DRIVING',
                        avoidHighways: true,
                        avoidTolls: true,
                    }, callback);                          
                    //Update User location
                    $("#lat_value").val(my_Point.lat());
                    $("#lon_value").val(my_Point.lng());
                });     
            },function() {    
                // คำสั่งทำงาน ถ้า ระบบระบุตำแหน่ง geolocation ผิดพลาด หรือไม่ทำงาน    
            });              
            // ให้อัพเดทตำแหน่งในแผนที่อัตโนมัติ โดยใช้งาน watchPosition
            // ค่าตำแหน่งจะได้มาเมื่อมีการส่งค่าตำแหน่งที่ถูกต้องกลับมา
            navigator.geolocation.watchPosition(function(position){    
   
                var myPosition_lat=position.coords.latitude; // เก็บค่าตำแหน่ง latitude  ปัจจุบัน  
                var myPosition_lon=position.coords.longitude;  // เก็บค่าตำแหน่ง  longitude ปัจจุบัน  
                                 
                // สรัาง LatLng ตำแหน่งปัจจุบัน watchPosition
                pos = new GGM.LatLng(myPosition_lat,myPosition_lon);     
                orgins = [];
                origins.push(pos);    
                         
                service.getDistanceMatrix(
                {
                    origins: origins,
                    destinations: destinations,
                    travelMode: 'DRIVING',
                    avoidHighways: true,
                    avoidTolls: true,
                }, callback);

                // ให้ marker เลื่อนไปอยู่ตำแหน่งปัจจุบัน ตามการอัพเดทของตำแหน่งจาก watchPosition
                my_Marker.setPosition(pos);
                map.panTo(pos); // เลื่อนแผนที่ไปตำแหน่งปัจจุบัน  
                map.setCenter(pos);  // กำหนดจุดกลางของแผนที่เป็น ตำแหน่งปัจจุบัน
            },function() {    
                // คำสั่งทำงาน ถ้า ระบบระบุตำแหน่ง geolocation ผิดพลาด หรือไม่ทำงาน    
            });
    }else{    
         // คำสั่งทำงาน ถ้า บราวเซอร์ ไม่สนับสนุน ระบุตำแหน่ง    
    }   
}  
function callback(response, status) {
    if(status=='OK'){       
        console.log(response.rows);
        $.each(response.rows[0].elements,function(i,elm){
            console.log(elm);
            $("#distance-between").val(elm.distance.text);
        });
    }
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
      src: "//maps.google.com/maps/api/js?v=3.2&key=AIzaSyCHFYchVRd2Z8w1WzLtQNA9krlwk8Up25Q&sensor=false&language=th&callback=initialize"
    }).appendTo("body");      
});
</script>
@endsection