<?php

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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
Route::get('/users/{id}/subscriptions', [App\Http\Controllers\SubscriptionController::class, 'index'])->name('subscriptions.index');
Route::get('/users/{id}/subscriptions/{subscription}/edit', [App\Http\Controllers\SubscriptionController::class, 'edit'])->name('subscriptions.edit');
Route::put('/users/{id}/subscriptions/{subscription}', [App\Http\Controllers\SubscriptionController::class, 'update'])->name('subscriptions.update');
Route::resource('plans', App\Http\Controllers\PlanController::class);
