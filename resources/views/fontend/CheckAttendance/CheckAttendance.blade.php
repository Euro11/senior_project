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

                <div class="card-body">
                    <div class="card-title">
                        <h2>เช็คชื่อ</h2>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 text-center">                            
                            <h3>ราดละเอียดวิชา</h3>
                            <p><b>ชื่อวิชา : </b>Numerical Method</p>
                            <p><b>รหัสวิชา : </b>12345678</p>
                        </div>
                        <div class="col-md-12 text-center">
                            <div id="map" style="width:100%;height:400px;"></div>
                        </div>     
                        <div class="col-md-12 text-center">
                            <!-- Check-in Button -->
                            <div class="checkin-button">
                            </div>
                            <p class="checkin-text">
                               Check-in
                            </p><br>
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
    var map, infoWindow;
    function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 13.8117778, lng: 100.5640357},
                zoom: 20
            });
        infoWindow = new google.maps.InfoWindow;
         // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                  lat: position.coords.latitude,
                  lng: position.coords.longitude
                };
            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

           function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      } 
    </script>

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQXosTo6eybkdXeg18K9wEds1n7SOxfiw&callback=initMap">
    </script>
@endsection