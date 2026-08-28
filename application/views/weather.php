<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Document</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 50%;
        width: 50%;
        margin: 0 auto;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0 ;
        padding: 0;
       
      }
    </style>
</head>
<body>
<section class="vh-100">
  <div class="container py-5 h-100">

    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-8 col-lg-6 col-xl-4">

        <h3 class="mb-4 pb-2 fw-normal">Check the weather forecast</h3>

        <div class="input-group rounded mb-3">
          <input type="search" class="form-control rounded" placeholder="City" aria-label="Search"
            aria-describedby="search-addon" />
          <a href="#!" type="button">
            <span class="input-group-text border-0 fw-bold" id="search-addon">
              Check!
            </span>
          </a>
        </div>

        <div class="mb-4 pb-2">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
              value="option1" checked />
            <label class="form-check-label" for="inlineRadio1">Celsius</label>
          </div>

          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
              value="option2" />
            <label class="form-check-label" for="inlineRadio2">Farenheit</label>
          </div>
        </div>

        <div class="card shadow-0 border">
          <div class="card-body p-4">

            <h4 class="mb-1 sfw-normal" id="result1">New York, US</h4>
            <p class="mb-2" id="result2">Current temperature: <strong>5.42°C</strong></p>
            <p id="result3">Feels like: <strong>4.37°C</strong></p>
            <p id="result4">Max: <strong>6.11°C</strong>, Min: <strong>3.89°C</strong></p>

            <div class="d-flex flex-row align-items-center">
              <p class="mb-0 me-4">Scattered Clouds</p>
              <i class="fas fa-cloud fa-3x" style="color: #eee;"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<div id="map"></div>
    <script>
        var map;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 16
            });
        const locationButton = document.createElement("button");
        infoWindow = new google.maps.InfoWindow();
        locationButton.textContent = "Pan to Current Location";
        locationButton.classList.add("custom-map-control-button");
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
        locationButton.addEventListener("click", () => {
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                infoWindow.setPosition(pos);
                infoWindow.setContent("Location found.");
                infoWindow.open(map);
                map.setCenter(pos);
                },
                () => {
                handleLocationError(true, infoWindow, map.getCenter());
                }
            );
            } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
            }
        });
        }

            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(
                browserHasGeolocation
                ? "Error: The Geolocation service failed."
                : "Error: Your browser doesn't support geolocation."
            );
            infoWindow.open(map);
            }

            window.initMap = initMap;
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAD3YvnVh0YkKJ-vBZ5p5U6AdovieTfYl0&callback=initMap"
    async defer></script>

</body>
<script>
    $.ajax({
      url:"https://api.openweathermap.org/data/3.0/onecall?lat=33.44&lon=-94.04&exclude=hourly,daily&appid=f5aa88da964068202b5fbf3bf2a9e9bc",
      method:"GET",
      success:function(response){
        var obj1 = response.timezone;
        var obj2 = response.current;
        var obj3 = response.lat;
        var obj4 = response.lon;

        $('#result1').text("The current timezone is "+obj1);
        $('#result2').text("The current humidity is "+obj2.humidity); 
        $('#result3').text("The current latitude is "+obj3); 
        $('#result4').text("The current longitude is "+obj4);   
      }
     })
    
</script>
</html>