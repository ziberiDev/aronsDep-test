@extends('app/main')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-6 mx-auto mt-5">

            <h3>Edit Shift for {{$id->user->worker}}@ {{ $id->user->company }}</h3>
            <form method="POST"  action="{{route('shift.update' , ['id' => $id->id])}}">
                @method('PUT')
                @csrf
                <input type="hidden" name="shift_id" value="{{$id->id}}">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" name="date" id="date" value="{{$id->date}}">
                    @error('date')
                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>
{{--                <div class="form-group">--}}
{{--                    <label for="worker">Worker</label>--}}
{{--                    <select class="form-control" name="worker" id="worker">--}}
{{--                        @foreach($users as $user)--}}
{{--                            <option @selected($id->worker == $user->worker) value="{{$user->id}}">{{$user->worker}} ({{$user->company}})</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
                <div class="form-group">
                    <label for="company">Company</label>
                    <input disabled type="text" class="form-control" id="company" value="{{$id->user->company}}">

                </div>
                <div class="form-group">
                    <label for="hours">Hours</label>
                    <input type="number" class="form-control" name="hours" id="hours" value="{{$id->hours}}">
                    @error('hours')
                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="rate_per_hour">Rate per Hour</label>
                    <input type="text" class="form-control" name="rate_per_hour" id="rate_per_hour" value="{{$id->rate_per_hour}}">
                    @error('rate_per_hour')
                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="taxable">Taxable</label>
                    <select class="form-control" name="taxable" id="taxable">
                        <option @selected($id->taxable == 'Yes') value="Yes">Yes</option>
                        <option @selected($id->taxable == 'No')  value="No">No</option>
                    </select>
                    @error('taxable')
                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" name="status" id="status">
                        @foreach(\App\Enums\ShiftsStatus::cases() as $status)
                        <option @selected($id->status == $status) value="{{$status}}">{{$status}}</option>
                        @endforeach
                    </select>
                    @error('status')
                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="shift_type">Shift Type</label>
                    <select class="form-control" name="shift_type" id="shift_type">
                        @foreach(\App\Enums\ShiftType::cases() as $type)
                            <option @selected($id->shift_type == $type) value="{{$type}}">{{$type}}</option>
                        @endforeach
                    </select>
                    @error('shift_type')
                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="paid_at">Paid At</label>
                    <input type="datetime-local" class="form-control" name='paid_at' id="paid_at" value="{{$id->paid_at}}">
                    @error('paid_at')
                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary my-5">Update Shift</button>
                <a href="{{ url()->previous() }}" class="btn btn-success">Go Back</a>
            </form>
        </div>
    </div>
</div>


@endsection
