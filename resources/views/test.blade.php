<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="{!! url('assets/css/card.css') !!}"rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <div class="row product_data">
            <div class="col">
                @foreach ($cartItems as $Item)
                    <div class="col-4 d-flex justify-content-center">
                        <div class="d-lg-flex">
                            <div class="card border-0 me-lg-4 mb-lg-0 mb-4 text-center">
                                <div class="backgroundEffect"></div>
                                <div class="pic"><img src="{{ asset($Item->pizzas->image) }}" class="card-img-top" alt="..." height="250px">
                                </div>
                                <div class="content">
                                    <h5 class="card-title">{{ $Item->pizzas->name }}</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <h5 class="card-title">Price : <font color="red">{{$Item->pizzas->price}}</font></h5>
                                    <a href="" class="btn ">ADD</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
