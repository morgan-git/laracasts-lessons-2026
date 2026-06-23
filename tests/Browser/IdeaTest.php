<?php

use App\Models\Idea;
use App\Models\User;
use Tests\TestCase;

beforeEach(function () {
    /** @var TestCase $this */
    $this->user = User::factory()->create();
    $this->actingAs($this->user);

    $this->idea = Idea::factory()->for($this->user)->create();
});

it('shows all ideas', function () {
    visit('/ideas')
        ->assertSee($this->idea->description);
});

it('shows a single idea', function () {
    visit('/ideas/'.$this->idea->id)
        ->assertSee($this->idea->description);
});

it('shows an edit form to update an idea', function () {
    visit('/ideas/'.$this->idea->id.'/edit')
        ->assertSee('update');
});

it('creates a new idea', function () {
    visit('/ideas')
        ->click('@create-idea-button')
        ->fill('title', 'Braised Beef is Brilliant')
        ->click('@idea-status-btn-complete')
        ->fill('description', 'skoopski')
        ->click('@save-idea-button')
        ->assertPathIs('/ideas');
    // ->debug();

    expect(Idea::count())->toBe(2);
    expect($this->user->ideas()->latest()->first())->toMatchArray([
        'title' => 'Braised Beef is Brilliant',
        'description' => 'skoopski',
        'state' => 'complete',
    ]);
});

it('doesn\'t show an edit form to update an idea thats not the viewing user', function () {
    // Create a second separate user and sign them in to override the beforeEach user
    $user2 = User::factory()->create();
    $this->actingAs($user2);

    visit('/ideas/'.$this->idea->id.'/edit')
        ->assertSee('404');
});
