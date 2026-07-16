<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\FeedPost;
use App\Models\Reddit;
use App\Services\RedditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RedditController extends Controller
{
    public function index(string $subreddit = 'foodporn')
    {
        if (! in_array($subreddit, RedditService::ALLOWED_SUBREDDITS)) {
            $subreddit = 'foodporn';
        }

        $posts = Cache::remember(
            RedditService::CACHE_PREFIX.$subreddit,
            now()->addMinutes(30),
            fn () => FeedPost::whereHas(
                'source',
                fn ($q) => $q
                    ->where('provider', 'reddit')
                    ->where('handle', $subreddit)
            )
                ->orderByDesc('posted_at')
                ->get()
                ->toArray()
        );

        $posts = collect($posts);

        //dd($posts);
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
