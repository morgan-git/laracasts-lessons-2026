<?php

use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;
use App\Models\Idea;

require __DIR__.'/ideas.php';



Route::view('/', 'index', [
    "greeting" => "Hey mustache, what's up?",
    "person" => request('person') ?? 'Larry',
    "tasks" => ["Dadood Frumcheers", "Count Ravioli", "Disfatt Bidge", "Diddy Doodat"],
]);


Route::view('/contact', 'contact');
Route::view('/about', 'about');

