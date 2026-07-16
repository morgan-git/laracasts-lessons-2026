<?php

namespace App\Jobs;

use App\Models\FeedPost;
use App\Models\FeedSource;
use App\Services\RedditService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SyncFeedSource implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;
    public int $backoff = 60;

    public function __construct(
        public readonly FeedSource $source
    ) {}

    public function handle(RedditService $reddit): void
    {
        if (! $this->source->active) {
            return;
        }

        match ($this->source->provider) {
            'reddit' => $this->syncReddit($reddit),
            default  => null,
        };

        $this->source->update(['last_fetched_at' => now()]);
    }

    private function syncReddit(RedditService $reddit): void
    {
        $posts = $reddit->subreddit($this->source->handle);

        if ($posts->get('throttled')) {
            $this->release(300); // retry in 5 minutes if throttled
            return;
        }

        foreach ($posts as $post) {
            FeedPost::updateOrCreate(
                [
                    'feed_source_id' => $this->source->id,
                    'external_id'    => $post['id'],
                ],
                [
                    'title'     => $post['title'],
                    'url'       => $post['url'],
                    'author'    => $post['author'],
                    'image_url' => $post['image'],
                    'content'   => $post['content'],
                    'posted_at' => $post['updated'],
                ]
            );
        }
    }
}
