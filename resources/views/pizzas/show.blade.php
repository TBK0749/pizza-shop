
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
                        <h2>"{{$pizza->name}}"</h2>
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
                        <li><b>Name:</b> {{ $pizza->name }}</li>
                        <li><b>Create at:</b> {{ $pizza->created_at }}</li>
                        <li><b>Update at:</b> {{ $pizza->updated_at }}</li>

                        <li><b>Ingredients:</b>
                        @if($pizza->ingredients->count() == 0)
                            <p>
                                Pizza don't have ingredients!!
                            </p>
                        @else
                            {{  $pizza->ingredients->pluck('name')->implode(', ') }}
                        @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Pizza image<h4>
                </div>
                <div class="card-body d-flex justify-content-center">
                    <img src="{{asset($pizza->image)}}" alt="" width="500px" height="500px">
                </div>
            </div>
        </div>
    </div>

<hr>
    <form method="POST" action="/admin/pizzas/{{$pizza->id}}">

        @csrf
        @method('DELETE')

        <div class="d-flex justify-content-between">
            <div>
                <a type="button" class="btn btn-info" href="{{ route('pizzas.index') }}">Back to all pizzas</a>
                <a type="button" class="btn btn-secondary" href="{{ route('pizzas.edit', $pizza->id) }}">Edit pizza</a>
            </div>

            <input type="submit" class="btn btn-danger" value="Delete this pizza" onclick="return confirm('Are you sure?')">
        </div>

    </form>

@endsection
