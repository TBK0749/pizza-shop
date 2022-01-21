<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>TheBaka Pizza Shop</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="{!! url('assets/css/styles.css') !!}" rel="stylesheet">
    <link href="{!! url('assets/css/signin.css') !!}" rel="stylesheet">

    {{-- icon --}}
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    {{-- card --}}
    {{-- <link href="{!! url('assets/css/app.css') !!}" rel="stylesheet"> --}}
    <link href="{!! url('assets/css/card.css') !!}"rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

    </style>


    <!-- Custom styles for this template -->

</head>
<body style="background-image: url('images/home/background-home.jpg')">

    @include('layouts.partials.navbar')

    <main class="container">
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- <script>
      $(function() {
        const pizzaModal = document.getElementById("pizza-modal-2");

        pizzaModal.addEventListener('shown.bs.modal', function() {
          console.log("Modal is showing");
        });

        $("#pizza-modal-2").on('shown.bs.modal', function() {
          console.log("Modal is showing");
        });

        const tag = $("#cat").parent();
        console.log(tag);
      });
    </script> --}}
</body>
</html>
