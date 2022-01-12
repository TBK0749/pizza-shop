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
                        <h1>ingredients list</h1>
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
                        @php($i=1)
                        @foreach ($ingredients as $row)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td><a href="{{ route('ingredients.show', $row->id)}}">{{ $row->name }}</a></td>
                                <td>{{ $row->price }}</td>
                                <td>{{ $row->created_at }}</td>
                                <td>{{ $row->updated_at }}</td>
                                <td>
                                    <form method="POST" action="/ingredients/{{$row->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-primary btn-sm" href="{{ route('ingredients.show', $row->id) }}">View</a>
                                        <a class="btn btn-secondary btn-sm" href="{{ route('ingredients.edit', $row->id) }}">Edit</a>
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
                        <h4><b>ingredient editing form</b></h4>
                    </div>
                    <div class="card-body ">
                        <form action="/ingredients/{{$ingredient->id}}" method="POST">
                            @csrf
                            @method('PUT')
                                <div class="form-group mb-2">
                                    <label for="name"><b>Name</b></label>
                                    <input type="text" name="name" class="form-control" value="{{ $ingredient->name }}">
                                </div>
                            @error('name')
                                <div >
                                    <font color="red">{{$message}}</font>
                                </div>
                            @enderror
                                <div class="form-group mb-2">
                                    <label for="price"><b>Price</b></label>
                                    <input type="number" name="price" class="form-control" value="{{ $ingredient->price }}">
                                </div>
                            @error('price')
                                <div >
                                    <font color="red">{{$message}}</font>
                                </div>
                            @enderror
                            <hr>
                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                    <a type="button" class="btn btn-info" href="{{ route('ingredients.index') }}">Back to all ingredients</a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endsection
