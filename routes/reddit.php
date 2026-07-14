<?php

declare(strict_types=1);

use App\Http\Controllers\RedditController;
use Illuminate\Support\Facades\Route;

Route::get('/reddit/{subreddit?}', [RedditController::class, 'index'])->name('reddit.index');
