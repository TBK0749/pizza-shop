<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

@extends('layout')

@section('content')
    <!-- https://getbootstrap.com/docs/5.1/getting-started/introduction/ -->

    <div class="row mb-2">
        <div class="col-md-3">
            <div class="card ">
                <div class="card-header d-flex justify-content-center">
                    <h1>Pizzas list</h1>
                </div>
            </div>
        </div>
        <div class="col-md-1 align-self-end">
            <div class="card ">
                <a class=" btn btn-outline-success " href="/admin/pizzas/create" >Create</a>
            </div>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4">
            @if(session("success"))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
        </div>
    </div>

    <div class="row ">
        <div class="col">
            @if ($pizzas->count() === 0)
                <p class="my-3"><h2>There is no pizza on the list.</h2></p>
            @else
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
                        @foreach ($pizzas as $pizza)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td><a href="{{ route('pizzas.show', $pizza->id)}}">{{ $pizza->name }}</a></td>
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
            @endif
        </div>
    </div>


@endsection
