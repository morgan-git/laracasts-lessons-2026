<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Support\Collection;

interface FeedProvider
{
    public function fetch(string $handle): Collection;
}
