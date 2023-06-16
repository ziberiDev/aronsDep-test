<?php

use App\Models\Shift;
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

Route::get('/user/{id}', [\App\Http\Controllers\ShiftController::class , 'show'])->name('user.show');

Route::get('/user/{id}/shift/create' , [\App\Http\Controllers\ShiftController::class , 'create'])->name('shift.create');
Route::post('/user/{id}/shift/save' , [\App\Http\Controllers\ShiftController::class , 'save'])->name('shift.save');

Route::get('/shift/{id}/edit', function (Shift $id) {
   $id = $id->load('user');
    return view('shifts.edit', compact('id' ));
})->name('shift.edit');
Route::put('/shift/{id}/update', [\App\Http\Controllers\ShiftController::class , 'update'])->name('shift.update');
Route::get('/user/{id}/delete', [\App\Http\Controllers\ShiftController::class , 'destroy'])->name('shift.delete');




