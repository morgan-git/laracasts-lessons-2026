<?php

use Illuminate\Support\Facades\Route;


Route::view('/', 'welcome', [
    "greeting" => "Hey mustache, what's up?",
    "person" => request('person') ?? 'Larry',
    "tasks" => ["Dadood Frumcheers", "Count Ravioli", "Disfatt Bidge", "Diddy Doodat"],
]);
Route::view('/contact', 'contact');
Route::view('/about', 'about');
