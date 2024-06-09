<?php

use App\Http\Controllers\AdminController;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Mockery\Matcher\Subset;

Route::get('user', [App\Http\Controllers\userControllers::class, 'index'])->name('home');

Route::post('user/login', [App\Http\Controllers\userControllers::class, 'loginPage']);

Route::middleware(['guest'])->prefix('user')->group(function () {
    Route::get('login', [App\Http\Controllers\userControllers::class, 'login'])->name('login');
    Route::post('login', [App\Http\Controllers\userControllers::class, 'loginPage']);
    Route::get('create', [App\Http\Controllers\userControllers::class, 'create'])->name('register');
    Route::post('create', [App\Http\Controllers\userControllers::class, 'store']);
});


Route::post('user/logout', [App\Http\Controllers\userControllers::class, 'logout'])->middleware('auth');
Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::delete('/user/{user}/delete', [\App\Http\Controllers\Admin\UserController::class, 'delete']);
    Route::put('/user/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit']);
});

Route::get('test1', function () {

    User::whereId(3)->first()->student()->create();

    // Subject::create(['name' => 'math', 'min_mark' => 60]);
});

Route::get('test', function () {
    $subject = Subject::whereId(1)->first();

    // $studenta = $student->subjects;
    //student_subject
    $studenta = $subject->student()->withPivot(['mark'])->get()->toArray();

    dd($studenta);
});
