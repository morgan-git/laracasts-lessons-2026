<?php

use Illuminate\Support\Facades\Route;


Route::view('/', 'welcome', [
    "greeting" => "Hey mustache, what's up?",
    "person" => request('person') ?? 'Larry',
]);
Route::view('/contact', 'contact');
Route::view('/about', 'about');
