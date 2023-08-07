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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('todos')->as('todos.')->group(function (){
    Route::get('index', [App\Http\Controllers\TodoController::class, 'index'])->name('index');
    Route::get('create', [App\Http\Controllers\TodoController::class, 'create'])->name('create');
    Route::post('store', [App\Http\Controllers\TodoController::class, 'store'])->name('store');
    Route::get('show/{id}', [App\Http\Controllers\TodoController::class, 'show'])->name('show');
    Route::get('{id}/edit', [App\Http\Controllers\TodoController::class, 'edit'])->name('edit');
    Route::put('update', [App\Http\Controllers\TodoController::class, 'update'])->name('update');
    Route::delete('destroy', [App\Http\Controllers\TodoController::class, 'destroy'])->name('destroy');
});


