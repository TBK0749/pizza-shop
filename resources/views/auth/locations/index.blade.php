<!DOCTYPE html>
<html>
  <head>
    <title>TheBaka Pizza Shop</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./googlemaps/user/style.css" />
    <script src="./googlemaps/user/index.js"></script>

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

            <div id="map" class="my-3" style="height: 78%"></div>

            <hr>
            <form action="{{ route('locations.store') }}" method="POST">
                @csrf
                @method('POST')
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
  </body>
</html>

