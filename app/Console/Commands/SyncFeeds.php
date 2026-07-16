<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Jobs\SyncFeedSource;
use App\Models\FeedSource;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Description('Sync all active feed sources')]
#[Signature('feeds:sync {provider? : Only sync a specific provider}')]
class SyncFeeds extends Command
{
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
