<?php

namespace App\Http\Controllers;


use App\Models\Reddit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\RedditService;
class RedditController extends Controller
{

    public function index(RedditService $reddit, string $subreddit = 'foodporn')
    {
        if ( !in_array($subreddit, ['foodporn', 'foodcrime', 'meme', 'dankmemes'])) {
           $subreddit = 'foodporn';
        }

        $posts = $reddit->subreddit($subreddit);

        return view('reddit.index', compact('posts', 'subreddit'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Reddit $reddit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reddit $reddit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reddit $reddit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reddit $reddit)
    {
        //
    }
}
