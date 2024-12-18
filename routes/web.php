<?php

use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/message',[MessageController::class,'index'])->name('message.index');
Route::post('/message-create',[MessageController::class,'store'])->name('message.store');