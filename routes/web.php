<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SessionsController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/ideas.php';



Route::view('/', 'index', [
    "greeting" => "Don't stop letting people not help",
    "person" => request('person') ?? 'Larry',
    "tasks" => ["Dadood Frumcheers", "Count Ravioli", "Disfatt Bidge", "Diddy Doodat"],
]);



//Registration
Route::get("/register", [RegisteredUserController::class, 'create']);
Route::post("/register", [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionsController::class, 'create']);
Route::post('/login', [SessionsController::class, 'store']);

Route::delete('/logout', [SessionsController::class, 'destroy']);


Route::view('/contact', 'contact');
Route::view('/about', 'about');

