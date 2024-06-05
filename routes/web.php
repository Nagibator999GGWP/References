<?php

use App\Http\Controllers\AuthContoller;
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;


Route::get('/register', [AuthContoller::class, 'register']);
Route::post('/register', [AuthContoller::class, 'registerUser']);