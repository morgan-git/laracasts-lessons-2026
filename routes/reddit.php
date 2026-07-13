<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedditController;


 Route::get('/reddit', [RedditController::class, 'index'])->name('reddit.index');
