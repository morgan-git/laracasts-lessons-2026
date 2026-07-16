<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface FeedProvider
{
    public function fetch(string $handle): Collection;
}
