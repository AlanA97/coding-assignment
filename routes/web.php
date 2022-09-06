<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', static function () {
    return redirect('/dashboard');
});

Route::middleware('auth')->group(static function(){
    Route::get('/dashboard', static function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware('can:isAdmin')->group(function(){
        Route::resource('users', UserController::class)->except('show');
    });

    Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
    Route::middleware('can:isAdmin')->group(function() {
        Route::resource('courses', CourseController::class)->except('show', 'index');
    });
});

require __DIR__.'/auth.php';
