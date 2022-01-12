    <script>
    if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
    }
    </script>

    @extends('layout')


    @section('content')

        <div class="row mb-2 d-flex justify-content-center">
            <div class="col-6">
                <div class="card ">
                    <div class="card-header ">
                        <div class="d-flex justify-content-center">
                            <h2>"{{$ingredient->name}}"</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <hr>

        <div class="row">
            <div class='col-4'>
                <div class="card">
                    <div class="card-header">
                        <h4>Details<h4>
                    </div>
                    <div class="card-body">
                        <ul class="lead">
                            <li><b>Name:</b> {{ $ingredient->name }}</li>
                            <li><b>Price:</b> {{ $ingredient->price }}</li>
                            <li><b>Create at:</b> {{ $ingredient->created_at }}</li>
                            <li><b>Update at:</b> {{ $ingredient->updated_at }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    <hr>
        <form method="POST" action="/ingredients/{{$ingredient->id}}">

            @csrf
            @method('DELETE')

            <div class="d-flex justify-content-between">
                <div>
                    <a type="button" class="btn btn-info" href="{{ route('ingredients.index') }}">Back to all ingredients</a>
                    <a type="button" class="btn btn-secondary" href="{{ route('ingredients.edit', $ingredient->id) }}">Edit ingredient</a>
                </div>

                <input type="submit" class="btn btn-danger" value="Delete this ingredient" onclick="return confirm('Are you sure?')">
            </div>

        </form>

    @endsection
