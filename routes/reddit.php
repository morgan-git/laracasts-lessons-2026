<?php

declare(strict_types=1);

use App\Http\Controllers\RedditController;
use Illuminate\Support\Facades\Route;
use App\Services\FeedSelector;

Route::get('/reddit/{subreddit?}', [RedditController::class, 'index'])->name('reddit.index');

Route::get('/test/{subreddit}', function (
    string $subreddit,
    FeedSelector $selector
) {
    return $selector->random('reddit', $subreddit);
});
