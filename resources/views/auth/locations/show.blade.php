<!DOCTYPE html>
<html>
  <head>
    <title>TheBaka Pizza Shop</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="{!! url('assets/css/styles.css') !!}" rel="stylesheet">
    <link href="{!! url('assets/css/signin.css') !!}" rel="stylesheet">
    <link href="{!! url('assets/css/cumtom.css') !!}" rel="stylesheet">

    {{-- icon --}}
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
        /* #map {
            height: 100%;
            width: 100%;
            display: block;
            margin-left: auto;
            margin-right: auto;
        } */

        /* Optional: Makes the sample page fill the window. */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #description {
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
        }

        #infowindow-content .title {
            font-weight: bold;
        }

        #infowindow-content {
            display: none;
        }

        #map #infowindow-content {
            display: inline;
        }

        .pac-card {
            background-color: #fff;
            border: 0;
            border-radius: 2px;
            box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
            margin: 10px;
            padding: 0 0.5em;
            font: 400 18px Roboto, Arial, sans-serif;
            overflow: hidden;
            font-family: Roboto;
            padding: 0;
        }

        #pac-container {
            padding-bottom: 12px;
            margin-right: 12px;
        }

        .pac-controls {
            display: inline-block;
            padding: 5px 11px;
        }

        .pac-controls label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }

        #pac-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 400px;
        }

        #pac-input:focus {
            border-color: #4d90fe;
        }

        #title {
            color: #fff;
            background-color: #4d90fe;
            font-size: 25px;
            font-weight: 500;
            padding: 6px 12px;
        }
    </style>

  </head>
  <body style="background-image: url('/images/home/background-home.jpg')" class="pizza-font">

    <div class="d-flex flex-column h-100">
        {{-- navbar --}}
        <div>
          @include('layouts.partials.navbar')
        </div>

        {{-- maps --}}
        <div class="flex-fill container bg-light">
            <div class="row border border">
                <div class="col-md fs-3">Your Location</div>
            </div>

            <div class="pac-card" id="pac-card">
                <div>
                <div id="title">Autocomplete search</div>
                <div id="type-selector" class="pac-controls">
                    <input
                    type="radio"
                    name="type"
                    id="changetype-all"
                    checked="checked"
                    />
                    <label for="changetype-all">All</label>

                    <input type="radio" name="type" id="changetype-establishment" />
                    <label for="changetype-establishment">establishment</label>

                    <input type="radio" name="type" id="changetype-address" />
                    <label for="changetype-address">address</label>

                    <input type="radio" name="type" id="changetype-geocode" />
                    <label for="changetype-geocode">geocode</label>

                    <input type="radio" name="type" id="changetype-cities" />
                    <label for="changetype-cities">(cities)</label>

                    <input type="radio" name="type" id="changetype-regions" />
                    <label for="changetype-regions">(regions)</label>
                </div>
                <br />
                <div id="strict-bounds-selector" class="pac-controls">
                    <input type="checkbox" id="use-location-bias" value="" checked />
                    <label for="use-location-bias">Bias to map viewport</label>

                    <input type="checkbox" id="use-strict-bounds" value="" />
                    <label for="use-strict-bounds">Strict bounds</label>
                </div>
                </div>
                <div id="pac-container">
                <input id="pac-input" type="text" placeholder="Enter a location" />
                </div>
            </div>

            <!-- CSS Device Breakpoint -->
            <div id="map" class="my-3" style="height: 500px"></div>

            <hr>
            <form action="{{ route('locations.update', $location->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-5">
                        <input type="hidden" class="form-control" placeholder="lat" name="lat" id="lat">
                    </div>
                    <div class="col-md-5">
                        <input type="hidden" class="form-control" placeholder="lng" name="lng" id="lng">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-end">Confirm</button>
            </form>
        </div>

        {{-- footer --}}
        <div>
            @include('layouts.partials.footer')
        </div>
    </div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCuP8WHzFL9cEB5VwB79FsyKxc0etvrTI&callback=initMap&libraries=places&v=weekly"
      async
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- MapJs --}}
    <script>
        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

        let map;
        let marker;
        let oldLat = <?php echo json_encode($location->latitude) ?>;
        let oldLng = <?php echo json_encode($location->longitude) ?>;

        function initMap() {
            const userLatlng = { lat: oldLat , lng: oldLng };

            map = new google.maps.Map(document.getElementById("map"), {
                center: userLatlng,
                zoom: 13,
                mapTypeControl: false,
            });

            const svgMarker = {
                path: "M10.453 14.016l6.563-6.609-1.406-1.406-5.156 5.203-2.063-2.109-1.406 1.406zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z",
                fillColor: "Green",
                fillOpacity: 0.6,
                strokeWeight: 0,
                rotation: 0,
                scale: 2,
                anchor: new google.maps.Point(15, 30),
            };

            const oldMarker = new google.maps.Marker({
                position: userLatlng,
                map,
                icon: svgMarker,
            });

            google.maps.event.addListener(map, 'click',
                function (event) {
                    pos = event.latLng
                    marker.setPosition(pos)
                });

            const card = document.getElementById("pac-card");
            const input = document.getElementById("pac-input");
            const biasInputElement = document.getElementById("use-location-bias");
            const strictBoundsInputElement = document.getElementById("use-strict-bounds");
            const options = {
                fields: ["formatted_address", "geometry", "name"],
                strictBounds: false,
                types: ["establishment"],
            };

            map.controls[google.maps.ControlPosition.TOP_LEFT].push(card);

            const autocomplete = new google.maps.places.Autocomplete(input, options);

            // Bind the map's bounds (viewport) property to the autocomplete object,
            // so that the autocomplete requests use the current map bounds for the
            // bounds option in the request.
            autocomplete.bindTo("bounds", map);

            marker = new google.maps.Marker({
                map,
                anchorPoint: new google.maps.Point(0, -29),
                draggable: true,
            });

            autocomplete.addListener("place_changed", () => {
                marker.setVisible(false);

                const place = autocomplete.getPlace();

                if (!place.geometry || !place.geometry.location) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }

                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
            });

            // Sets a listener on a radio button to change the filter type on Places
            // Autocomplete.
            function setupClickListener(id, types) {
                const radioButton = document.getElementById(id);

                radioButton.addEventListener("click", () => {
                    autocomplete.setTypes(types);
                    input.value = "";
                });
            }

            setupClickListener("changetype-all", []);
            setupClickListener("changetype-address", ["address"]);
            setupClickListener("changetype-establishment", ["establishment"]);
            setupClickListener("changetype-geocode", ["geocode"]);
            setupClickListener("changetype-cities", ["(cities)"]);
            setupClickListener("changetype-regions", ["(regions)"]);
            biasInputElement.addEventListener("change", () => {
                if (biasInputElement.checked) {
                    autocomplete.bindTo("bounds", map);
                } else {
                    // User wants to turn off location bias, so three things need to happen:
                    // 1. Unbind from map
                    // 2. Reset the bounds to whole world
                    // 3. Uncheck the strict bounds checkbox UI (which also disables strict bounds)
                    autocomplete.unbind("bounds");
                    autocomplete.setBounds({ east: 180, west: -180, north: 90, south: -90 });
                    strictBoundsInputElement.checked = biasInputElement.checked;
                }

                input.value = "";
            });
            strictBoundsInputElement.addEventListener("change", () => {
                autocomplete.setOptions({
                    strictBounds: strictBoundsInputElement.checked,
                });
                if (strictBoundsInputElement.checked) {
                    biasInputElement.checked = strictBoundsInputElement.checked;
                    autocomplete.bindTo("bounds", map);
                }

                input.value = "";
            });

            google.maps.event.addListener(marker, 'position_changed',
                function () {
                    let lat = marker.position.lat()
                    let lng = marker.position.lng()
                    $('#lat').val(lat)
                    $('#lng').val(lng)
                });
        }
    </script>
  </body>
</html>

