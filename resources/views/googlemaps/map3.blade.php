<!DOCTYPE html>
<html>
  <head>
    <title>Place Autocomplete and Directions</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./googleMaps/shop/style.css" />
    <script src="./googleMaps/shop/index.js"></script>

  </head>

  <body>
    <div style="display: none">
      <input
        id="origin-input"
        class="controls"
        type="text"
        placeholder="Enter an origin location"
      />

      <div id="mode-selector" class="controls">
        <input
          type="radio"
          name="type"
          id="changemode-walking"
          checked="checked"
        />
        <label for="changemode-walking">Walking</label>

        <input type="radio" name="type" id="changemode-transit" />
        <label for="changemode-transit">Transit</label>

        <input type="radio" name="type" id="changemode-driving" />
        <label for="changemode-driving">Driving</label>
      </div>
    </div>

    <div id="map"></div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUNiTpF5LVdc3ExdxZSdrVcu1Zzgqe6Zo&callback=initMap&libraries=places&v=weekly"
      async
    ></script>

  </body>
</html>
