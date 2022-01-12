
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

@extends('layout')

@section('content')

    <div class="row mb-2">
        <div class="col-md-3">
            <div class="card ">
                <div class="card-header d-flex justify-content-center">
                    <h1>Pizzas list</h1>
                </div>
            </div>
        </div>
        <div class="col-md-5"></div>
        <div class="col-md-4">
            @if(session("success"))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Create_at</th>
                        <th scope="col">Update_at</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach ($pizzas as $pizza)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td><a href="{{ route('pizzas.show', $pizza->id)}}">{{ $pizza->name }}</a></td>
                            <td>{{ $pizza->created_at }}</td>
                            <td>{{ $pizza->updated_at }}</td>
                            <td>
                                <form method="POST" action="/pizzas/{{$pizza->id}}">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-primary btn-sm" href="{{ route('pizzas.show', $pizza->id) }}">View</a>
                                    <a class="btn btn-secondary btn-sm" href="{{ route('pizzas.edit', $pizza->id) }}">Edit</a>
                                    <input type="submit" class="btn btn-danger btn-sm" value="Remove" onclick="return confirm('Are you sure?')">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <div class="card ">
                <div class="card-header ">
                    <h4><b>Pizza creating form</b></h4>
                </div>
                <div class="card-body ">
                    <form action="{{ route('pizzas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                            <div class="form-group mb-2">
                                <label for="name"><b>Name</b></label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                            </div>
                        @error('name')
                            <div >
                                <font color="red">{{$message}}</font>
                            </div>
                        @enderror
                            <div class="form-group mb-2">
                                <label for="pizza_image"><b>Pizza image</b></label>
                                <input type="file" name="pizza_image" class="form-control" >
                            </div>
                        @error('pizza_image')
                            <div >
                                <font color="red">{{$message}}</font>
                            </div>
                        @enderror
                            <table>
                                <b>Ingredients for pizza</b>
                                @foreach($ingredients as $ingredient)
                                    <tr>
                                        <td><input {{ $ingredient->value ? 'checked' : null }} data-id="{{ $ingredient->id }}" name="ingredients[{{ $ingredient->id }}]" type="checkbox" class="ingredient-enable"></td>
                                        <td>{{ $ingredient->name }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @error('ingredients')
                            <div >
                                <font color="red">{{$message}}</font>
                            </div>
                        @enderror
                        <hr>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">Create</button>
                                <a type="button" class="btn btn-info" href="{{ route('pizzas.index') }}">Back to all pizzas</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection