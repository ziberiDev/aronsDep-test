@extends('app/main')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col border border-primary-subtle">Name : {{$user->worker}}</div>
            <div class="col border border-primary-subtle">AVG rate: {{$user->average_rate}}</div>
            <div class="col border border-primary-subtle">AVG total pay: {{$user->average_total_pay}}</div>
        </div>
    </div>
    @if ($errors->any())
        <div class="container">
            <div class="row">
                <div class="col-6 mx-auto">


                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <p>{{$error}}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <div class="container">
        <h1>Shifts List</h1>
        <div class="row">
            {{$filter}}
            <div class="col-6 mx-auto">
                <form action="{{route('user.show' , ['id' => $user->id])}}" >
                    <input name="filter" type="number" value="{{$filter}}">
                    <input type="submit" value="Filter">
                </form>
            </div>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Hours</th>
                <th scope="col">Rate per Hour</th>
                <th scope="col">Taxable</th>
                <th scope="col">Status</th>
                <th scope="col">Shift Type</th>
                <th scope="col">Paid At</th>
                <th scope="col">Total</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>


            @foreach($user->shifts as $shift)

                <tr>
                    <th scope="row">{{$shift->id}}</th>
                    <td>{{$shift->hours}}</td>
                    <td>{{$shift->rate_per_hour}}</td>
                    <td>{{$shift->taxable}}</td>
                    <td>{{$shift->status}}</td>
                    <td>{{$shift->shift_type}}</td>
                    <td>{{$shift->paid_at}}</td>
                    <td>{{$shift->total_pay}}</td>
                    <td>
                        {{--                        <a href="{{route('shift.edit' , ['id' => $user->id])}}" class="btn btn-warning">edit</a>--}}
                        {{--                        <a href="{{route('user.delete' , ['id' => $user->id])}}" class="btn btn-danger">delete</a>--}}
                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>

@endsection
