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
    <script>
        // Initialize and add the map
        var map;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 6
          });


          

          /*
          var marker = new google.maps.Marker({
            position: {lat: 37.601346, lng: 22.944505},
            map: map,
            title: 'Hello World!'
          });
          var infowindow = new google.maps.InfoWindow({
            content: "Asklipiio"
          });
          marker.addListener('click', function() {
            infowindow.open(map, marker);
          });
          */
        }

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            map.setCenter(pos);
            loadMarkers();
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }

      function loadMarkers() {

        var xmlhttp = new XMLHttpRequest();
          var url = "http://localhost/soc2020/practice/public/map/api/points/all";

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
                        title: 'Hello World!'
                    });
                    /*
                    var infowindow = new google.maps.InfoWindow({
                        content: json[i].description
                    });
                    marker.addListener('click', function() {
                        infowindow.open(map, marker);
                    });
                    */
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