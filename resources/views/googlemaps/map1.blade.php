<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  </head>

  <style>

  </style>

  <body>

    <div class="content">
        <div class="m-3 border border-5 fs-2 d-flex justify-content-center">Google Map</div>
        <div class="m-3">
            <form action="">
                @csrf
                <div>
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" class="form-control" placeholder="lat" name="lat" id="lat">
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control" placeholder="lng" name="lng" id="lng">
                        </div>

                        <div id="map" style="height: 400px; width: 800px;" class="my-3"></div>

                        <script>
                            let map;
                            let marker;

                            function initMap() {
                                const myLatlng = {lat: 8.746592470204606, lng: 99.87857421278036 };

                                map = new google.maps.Map(document.getElementById("map"), {
                                    zoom: 13,
                                    center: myLatlng,
                                });

                                marker = new google.maps.Marker({
                                    position: myLatlng,
                                    map,
                                    draggable: true,
                                });

                                google.maps.event.addListener(marker, 'position_changed',
                                    function () {
                                        let lat = marker.position.lat()
                                        let lng = marker.position.lng()
                                        $('#lat').val(lat)
                                        $('#lng').val(lng)
                                    });

                                google.maps.event.addListener(map, 'click',
                                    function (event) {
                                        pos = event.latLng
                                        marker.setPosition(pos)
                                    });
                            }

                        </script>
                        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7xCPyRD465AUCEwfAqB2Pz9TKu8Qa2Tc&callback=initMap"
                        async defer></script>
                    </div>
                    <input type="submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

</body>
</html>
