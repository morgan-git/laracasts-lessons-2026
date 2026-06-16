<?php

declare(strict_types=1);

it('returns a successful response', function (): void {
    visit('/')->assertSee('stop');

    // ->debug() add this to see the window popup and see what it sees
});
