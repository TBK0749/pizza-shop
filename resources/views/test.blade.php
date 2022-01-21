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

<div class="container">

@foreach($pizzas->chunk(3) as $items)
    <div class="container">
        <div class="row mb-5">
          @foreach($items as $pizza)
            <div class="col-4 d-flex justify-content-center">
                <div class="d-lg-flex" data-toggle="modal" data-target="#myModal">
                    <div class="card border-0 me-lg-4 mb-lg-0 mb-4 text-center">
                        <div class="backgroundEffect"></div>
                        <div class="pic"><img src="{{ asset($pizza->image) }}" class="card-img-top" alt="..." height="250px">
                        </div>
                        <div class="content">
                            <h5 class="card-title">{{ $pizza->name }}</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <h5 class="card-title">Price : <font color="red">{{$pizza->price}}</font></h5>
                            <a href="" class="btn pizza-font">ADD</a>
                        </div>
                    </div>
                </div>
            </div>
          @endforeach
        </div>
    </div>
@endforeach

  <h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{ $pizza->name }}</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

</div>
</body>
</html>
