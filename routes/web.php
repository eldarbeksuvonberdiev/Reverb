<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReadMessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/message',[MessageController::class,'index'])->name('message.index');
Route::post('/message-create',[MessageController::class,'store'])->name('message.store');

Route::get('/admin',[AdminController::class,'index'])->name('admin.index');
Route::get('/read-message/{message}',[ReadMessageController::class,'readMessage'])->name('read.message');

Route::get('/employee',[EmployeeController::class,'index'])->name('employee.index');
Route::post('/employee-create',[EmployeeController::class,'store'])->name('employee.store');