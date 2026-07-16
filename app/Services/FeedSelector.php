<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\FeedPost;

class FeedSelector
{
    public function random(string $provider, string $handle): ?FeedPost
    {
        return FeedPost::query()
            ->whereHas('source', function ($query) use ($provider, $handle) {
                $query
                    ->where('provider', $provider)
                    ->where('handle', $handle);
            })
            ->inRandomOrder()
            ->first();
    }
}
