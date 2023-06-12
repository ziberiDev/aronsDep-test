<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function (Request $request) {
    $users = User::query()->paginate(10);

    return view('homepage' , compact('users'));
});

Route::get('/user/{id}', function (User $id, Request $request) {
    $validated = $request->validate(['filter' => ['nullable', 'numeric']]);
    $filter = $validated['filter'] ?? null;
    $user = $id->load([
        'shifts' => function ($query) use ($filter) {
            if (isset($filter)) {
                $query->where('total_pay', '>', $filter);
            }
            $query->where('status', 'Complete')->limit(5);
        }
    ]);
    $shifts = $user->shifts;

    $user->setAttribute('average_rate', round($shifts->avg('rate_per_hour'), 2));
    $user->setAttribute('average_total_pay', round($shifts->avg('total_pay'), 2));
    return view('users.show', compact('user', 'filter'));
})->name('user.show');

Route::post('save' ,[\App\Http\Controllers\CSVController::class , 'save'])->name('submit');


