<?php
use App\Models\User;

//TODO make an idea factory to auto create an idea for future testing

it('shows all ideas', function () {

    $this->actingAs($user = User::factory()->create());

    $idea = "Look up my butt and to the left and verify there is nothing there once and for all";
    $user->ideas()->create([
        'description' => $idea,
    ]);

    visit('/ideas')->assertSee($idea);
});

it('shows a single idea', function () {
     $this->actingAs($user = User::factory()->create());

    $desc = "Look up my butt and to the left and verify there is nothing there once and for all";
    $idea = $user->ideas()->create([
        'description' => $desc,
    ]);

    visit('/ideas/' . $idea->id)->assertSee($desc);
});

it('shows an edit form to update an idea', function () {

     $this->actingAs($user = User::factory()->create());

    $desc = "Look up my butt and to the left and verify there is nothing there once and for all";
    $idea = $user->ideas()->create([
        'description' => $desc,
    ]);

    visit('/ideas/' . $idea->id . '/edit')->assertSee($desc);
    visit('/ideas/' . $idea->id . '/edit')->assertSee('update');


});
