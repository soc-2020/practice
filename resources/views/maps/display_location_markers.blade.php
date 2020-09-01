<!DOCTYPE html>
<html>
  <head>
    <style>
       /* Set the size of the div element that contains the map */
      #map {
        height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
    </style>
  </head>
  <body>
    <h3>My Google Maps Demo</h3>
    <!--The div element for the map -->
    <div id="map"></div>

    <div>
      <form id="descr-form" method='post' action="{{ url('map/add/point') }}">
        @csrf
        Description: <input type='text' name="description"> 
        Lon: <input id='lon-field' type='text' name="lon"> 
        Lat: <input id='lat-field' type='text' name="lat"> 
        <button type='submit'>Submit</button>
      </form>
    </div>
    <script>
        // Initialize and add the map
        var map;
        var markers = [];
        var pos = {lat: -34.397, lng: 150.644};

        function initMap() {
          
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {  
              pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
              };
              map = new google.maps.Map(document.getElementById('map'), {
                center: pos,
                zoom: 6
              });
              console.log(pos);

              google.maps.event.addListener(map, 'click', function(mapsMouseEvent) {
                document.getElementById('lon-field').value = mapsMouseEvent.latLng.lng();
                document.getElementById('lat-field').value = mapsMouseEvent.latLng.lat();
              });

              google.maps.event.addListener(map, "dragend", function() {
                var center = this.getCenter();
                var latitude = center.lat();
                var longitude = center.lng();
                console.log("current latitude is: " + latitude);
                console.log("current longitude is: " + longitude);
                loadMarkers();
              });

              loadMarkers();
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

      function loadMarkers() {
        console.log(pos);
          // Remove any existing markers
          for (let i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
          }
          markers = [];
          console.log(map.getBounds());
          var bounds = map.getBounds();
          var ne = bounds.getNorthEast();
          var sw = bounds.getSouthWest();

          //  console.log("NE " + ne.lat() + " " + ne.lng());
          //  console.log("SW " + sw.lat() + " " + sw.lng());
          

          var xmlhttp = new XMLHttpRequest();
          var url = "http://localhost/soc2020/practice/public/map/api/points/"+
                    ne.lat()+"/"+ne.lng()+"/"+sw.lat()+"/"+sw.lng();

          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var json = JSON.parse(this.responseText);
                for(i = 0; i < json.length; i++) {
                    console.log(json[i].description);
                    var myLatlng = new google.maps.LatLng(json[i].lat, json[i].lon);
                    console.log(myLatlng);
                    var marker = new google.maps.Marker({
                        position: myLatlng,
                        map: map,
                    });
                    markers.push(marker);
                    
                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                            var infowindow = new google.maps.InfoWindow();
                            infowindow.setContent(json[i].description);
                            infowindow.open(map, marker);
                        }
                    })(marker, i));
          
                }
            }
          };
          xmlhttp.open("GET", url, true);
          xmlhttp.send();
      }
      
    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script defer
    src="https://maps.googleapis.com/maps/api/js?key={{ $google_maps_api_key }}&callback=initMap">
    </script>
  </body>
</html>