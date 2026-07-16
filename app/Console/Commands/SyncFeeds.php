<?php

namespace App\Console\Commands;

use App\Jobs\SyncFeedSource;
use App\Models\FeedSource;
use Illuminate\Console\Command;

class SyncFeeds extends Command
{
    protected $signature = 'feeds:sync {provider? : Only sync a specific provider}';
    protected $description = 'Sync all active feed sources';

    public function handle(): void
    {
        $query = FeedSource::active();

        if ($this->argument('provider')) {
            $query->forProvider($this->argument('provider'));
        }

        $sources = $query->get();

        $this->info("Dispatching sync for {$sources->count()} sources...");

        $sources->each(fn ($source) => SyncFeedSource::dispatch($source));

        $this->info('Done.');
    }
}
