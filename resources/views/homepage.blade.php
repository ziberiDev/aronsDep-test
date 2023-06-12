@extends('app/main')

@section('content')
    <form class="form" method="POST" action="{{route('submit')}}" enctype='multipart/form-data' >
        @csrf
        <div class="mb-3">
            <input name="csv" accept="text/csv" type="file" class="form-control" aria-label="file example" required>
            <div class="invalid-feedback">Example invalid form file feedback</div>
        </div>

        <div class="mb-3">
            <button class="btn btn-primary" type="submit">Submit form</button>
        </div>
    </form>


    <div class="container">
        <h1>User List</h1>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Full Name</th>
                <th scope="col">Company</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)

                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->worker}}</td>
                    <td>{{$user->company}}</td>
                    <td><a href="{{route('user.show' , ['id' => $user->id])}}" class="btn btn-primary">view</a></td>
                </tr>




            @endforeach

            </tbody>
        </table>

        <div class="pagination">
            {{ $users->links() }}
        </div>
    </div>
@endsection
