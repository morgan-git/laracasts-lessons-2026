<?php

use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function(){
    Route::get("/ideas", [IdeaController::class, 'index']);
    Route::get("/ideas/create", [IdeaController::class, 'create']);
    Route::get("/ideas/{idea}", [IdeaController::class, 'show']);
    Route::get("/ideas/{idea}/edit", [IdeaController::class, 'edit'])->name('idea.show');
    Route::patch("/ideas/{idea}", [IdeaController::class, 'update']);
    Route::post("/ideas", [IdeaController::class, 'store']);
    Route::delete("/ideas/{idea}",[IdeaController::class, 'destroy']);
});
