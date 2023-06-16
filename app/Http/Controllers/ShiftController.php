<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShiftRequest;
use App\Http\Requests\UpdateShiftRequest;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;

class ShiftController extends Controller
{

    public function create(User $id)
    {
        return view('shifts.create' , compact('id'));
    }

    public function save(User $id , CreateShiftRequest $request)
    {
        $validated = $request->validated();

        $date = $validated['date'];
//        $onDateShifts = $id->load([
//            'shifts' => function ($query) use ($date) {
//                $query->where('date', $date);
//        }
//        ]);

       $user = $id->shifts()->create(
           [
               "date" => $validated['date'],
               "hours" => $validated['hours'],
               "rate_per_hour" => $validated['rate_per_hour'],
               "taxable" => $validated['taxable'],
               "status" => $validated['status'],
               "shift_type" => $validated['shift_type'],
               "paid_at" => $validated['paid_at'] !== null ?: '',
               "total_pay" => $validated['rate_per_hour'] * $validated['hours']
           ]
        );

    return redirect()->route('user.show', ['id' => $id->id])->with('success', 'Shift created');
    }
    public function show(User $id, Request $request)
    {
        $validated = $request->validate(['filter' => ['nullable', 'numeric']]);
        $filter = $validated['filter'] ?? null;
        $user = $id->load('shifts');


        $shifts = $user->shifts;

        $completedShifts = $shifts->where('status', 'Complete')->take(5);

        $user->setAttribute('average_rate', round($shifts->avg('rate_per_hour'), 2));
        $user->setAttribute('average_total_pay', round($shifts->avg('total_pay'), 2));
        if (isset($filter)) {
            $shifts = $shifts->where('total_pay', '>', $filter);
            $user->setAttribute('shifts', $shifts);
        }

        return view('users.show', compact('user', 'filter', 'completedShifts'));
    }
    public function update(Shift $id, UpdateShiftRequest $request)
    {
        $validated = $request->validated();
        $id->update(
            [
                "date" => $validated['date'],
                "hours" => $validated['hours'],
                "rate_per_hour" => $validated['rate_per_hour'],
                "taxable" => $validated['taxable'],
                "status" => $validated['status'],
                "shift_type" => $validated['shift_type'],
                "paid_at" => $validated['paid_at'] ?? ''
            ]
        );
        return redirect()->route('user.show', ['id' => $id->user_id])->with('success', 'Shift updated');
    }

    public function destroy(Shift $id)
    {
        $id->delete();
        return redirect()->route('user.show', ['id' => $id->user_id])->with('success', 'Shift deleted');
    }
}
