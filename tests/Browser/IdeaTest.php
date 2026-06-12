<?php
use App\Models\User;
use App\Models\Idea;


it('shows all ideas', function () {

    $user = User::factory()->create();
    $this->actingAs($user);
    $idea = Idea::factory()->for($user)->create();
    $user->ideas()->create([
        'description' => $idea->description,
    ]);

    visit('/ideas')->assertSee($idea->description);
});

it('shows a single idea', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    $idea = Idea::factory()->for($user)->create();
    $user->ideas()->create([
        'description' => $idea->description,
    ]);

    visit('/ideas/' . $idea->id)->assertSee($idea->description);
});

it('shows an edit form to update an idea', function () {

    $user = User::factory()->create();
    $this->actingAs($user);
    $idea = Idea::factory()->for($user)->create();
    $user->ideas()->create([
        'description' => $idea->description,
    ]);

    visit('/ideas/' . $idea->id . '/edit')->assertSee('update');


});
