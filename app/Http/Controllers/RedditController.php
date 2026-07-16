<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Reddit;
use App\Services\RedditService;
use Illuminate\Http\Request;

class RedditController extends Controller
{
    public function index(RedditService $reddit, string $subreddit = 'foodporn')
    {
        if (! in_array($subreddit, RedditService::ALLOWED_SUBREDDITS)) {
            $subreddit = 'foodporn';
        }

        $posts = $reddit->subreddit($subreddit);

        return view('reddit.index', ['posts' => $posts, 'subreddit' => $subreddit]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Reddit $reddit): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reddit $reddit): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reddit $reddit): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reddit $reddit): void
    {
        //
    }
}
