<?php

declare(strict_types=1);

use App\Http\Controllers\RedditController;
use App\Services\FeedSelector;
use Illuminate\Support\Facades\Route;

Route::get('/reddit/{subreddit?}', [RedditController::class, 'index'])->name('reddit.index');

Route::get('/test/{subreddit}', fn (string $subreddit, FeedSelector $selector) => $selector->random('reddit', $subreddit));
