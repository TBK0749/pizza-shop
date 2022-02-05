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
            <div class="row">
                <input type="text"required id="autocomplete">
                <script>
                let autocomplete
                function initAutocomplete() {
                   autocomplete = new google.maps.places.Autocomplete(
                          (document.getElementById('autocomplete')),
                          {types: ['geocode']}
                   );
                    console.log(autocomplete);
                }
                </script>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCuP8WHzFL9cEB5VwB79FsyKxc0etvrTI&libraries=places&callback=initAutocomplete"
                async defer></script>

            </div>
        </div>
    </div>

</body>
</html>
