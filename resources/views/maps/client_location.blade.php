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
        var map, infoWindow;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 6
          });
          infoWindow = new google.maps.InfoWindow;
          google.maps.event.addListener(map, "dragend", function() {
            var center = this.getCenter();
            var latitude = center.lat();
            var longitude = center.lng();
            console.log("current latitude is: " + latitude);
            console.log("current longitude is: " + longitude);
          });
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
        }

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

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
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