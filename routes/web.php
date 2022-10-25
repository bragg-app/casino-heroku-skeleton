<?php

use Illuminate\Support\Facades\Route;

Route::get('/simple-overview', function() {
    return view('simple-overview');
});

Route::get('/', function () {
    return view('welcome');
});
