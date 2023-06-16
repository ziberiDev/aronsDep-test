@extends('app/main')

@section('content')
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
        <div class="row">
            <div class="col-6 mx-auto mt-5">
                <h3>Create Shift for {{$id->worker}}@ {{ $id->company }}</h3>
                <form method="POST"  action="{{route('shift.save' , ['id' => $id->id])}}">
                    {{--action="{{route('shift.save' , ['id' => $id->id])}}"--}}
                    @csrf
                    <input type="hidden" name="shift_id" value="{{$id->id}}">
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" name="date" id="date" value="{{old('hours')}}">
                        @error('date')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="worker">Worker</label>
                        <input disabled type="text" class="form-control" id="worker" value="{{$id->worker}}">
                    </div>
                    <div class="form-group">
                        <label for="company">Company</label>
                        <input disabled type="text" class="form-control" id="company" value="{{$id->company}}">

                    </div>
                    <div class="form-group">
                        <label for="hours">Hours</label>
                        <input type="number" class="form-control" name="hours" id="hours" value="{{old('hours')}}">
                        @error('hours')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="rate_per_hour">Rate per Hour</label>
                        <input type="text" class="form-control" name="rate_per_hour" id="rate_per_hour" value="{{old('rate_per_hour')}}">
                        @error('rate_per_hour')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="taxable">Taxable</label>
                        <select class="form-control" name="taxable" id="taxable">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                        @error('taxable')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status">
                            @foreach(\App\Enums\ShiftsStatus::cases() as $status)
                                <option @selected(old('status') == $status) value="{{$status}}">{{$status}}</option>
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
                                <option @selected(old('shift_type') == $type) value="{{$type}}">{{$type}}</option>
                            @endforeach
                        </select>
                        @error('shift_type')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="paid_at">Paid At</label>
                        <input type="datetime-local" class="form-control" name='paid_at' id="paid_at"
                                value="{{old('paid_at')}}">
                        @error('paid_at')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary my-5">Create Shift</button>
                    <a href="{{ url()->previous() }}" class="btn btn-success">Go Back</a>
                </form>
            </div>
        </div>
    </div>

@endsection
