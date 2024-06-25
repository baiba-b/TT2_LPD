<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', '/homepage');

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/homepage', function () {
    return view('homepage');
});