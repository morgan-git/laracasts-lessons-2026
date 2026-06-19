<?php

use App\Models\Idea;
use App\Models\User;

beforeEach(function () {
    /** @var Tests\TestCase $this */

    $this->user = User::factory()->create();
    $this->actingAs($this->user);

    $this->idea = Idea::factory()->for($this->user)->create();
});

it('shows all ideas', function () {
    visit('/ideas')
        ->assertSee($this->idea->description);
});

it('shows a single idea', function () {
    visit('/ideas/' . $this->idea->id)
        ->assertSee($this->idea->description);
});

it('shows an edit form to update an idea', function () {
    visit('/ideas/' . $this->idea->id . '/edit')
        ->assertSee('update');
});

it('doesn\'t show an edit form to update an idea thats not the viewing user', function () {
    // Create a second separate user and sign them in to override the beforeEach user
    $user2 = User::factory()->create();
    $this->actingAs($user2);

    visit('/ideas/' . $this->idea->id . '/edit')
        ->assertSee('404');
});
