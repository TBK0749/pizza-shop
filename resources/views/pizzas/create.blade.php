
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
                        <th scope="col">Price</th>
                        <th scope="col">Create_at</th>
                        <th scope="col">Update_at</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pizzas as $pizza)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td><a href="{{ route('pizzas.show', $pizza->id) }}">{{ $pizza->name }}</a></td>
                            <td>{{ $pizza->price }}</td>
                            <td>{{ $pizza->created_at }}</td>
                            <td>{{ $pizza->updated_at }}</td>
                            <td>
                                <form method="POST" action="/admin/pizzas/{{$pizza->id}}">
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
                                <label for="image"><b>Pizza image</b></label>
                                <input type="file" name="image" class="form-control">
                            </div>
                        @error('image')
                            <div >
                                <font color="red">{{$message}}</font>
                            </div>
                        @enderror
                        <div>
                            <b>Ingredients for pizza</b>
                        </div>
                        <select id="ingredient-select" name="ingredients[]" multiple="multiple" class="form-control">
                            @foreach($ingredients as $ingredient)
                                <option value="{{ $ingredient->id }}"> {{ $ingredient->name  }}</option>
                            @endforeach
                        </select>
                        @error('ingredients')
                            <div >
                                <font color="red">{{$message}}</font>
                            </div>
                        @enderror
                            <div class="form-group mb-2">
                                <label for="price"><b>Price</b></label>
                                <input type="number" name="price" class="form-control" min="1" value="{{ old('price') }}">
                            </div>
                        @error('price')
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

@section('script')
<script>
    $(document).ready(function() {
        $('#ingredient-select').select2();
    });

    // Basic:
    // 1. Create new page and route /shop
    // 2. The shop page display pizza as a grid (3 columns). Each column show pizza name, image, and 'Add to cart' button.
    // 3. Add price column to ingredients.

    // Extra:
    // 1. Design data tables for storing cart, cart items, order, order items
    // 2. Create cart page with checkout button. After checkout the cart should be created as an order
</script>
@endsection
