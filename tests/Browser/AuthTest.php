<?php

use App\Models\User;

it('registers a user', function (): void {
    // When I visit the registration page
    visit('/register')
        ->fill('name', 'Tanka Jahari')
        ->fill('email', 'Tanka@afterthesyntax.com')
        ->fill('password', 'ShaxxBodySpray123')
        ->press('@register-button') // which register button? beware. @ indicates data-test property
        ->assertPathIs('/ideas');

    // expect(User::count())->toBe(1); //generic check
    expect(User::where('email', 'Tanka@afterthesyntax.com')->exists())->toBe(true);

    $this->assertAuthenticated();

});

it('fails to register with a duplicate email', function (): void {
    // 1. Arrange: Create the initial user in the database
    $existingUser = User::factory()->create([
        'email' => 'duplicate@example.com',
    ]);

    // 2. Act: Attempt to register a new user using the same email
    visit('/register')
        ->fill('name', 'Tanka Jahari')
        ->fill('email', 'duplicate@example.com')
        ->fill('password', 'ShaxxBodySpray123')
        ->press('@register-button') // which register button? beware. @ indicates data-test property
        ->assertPathIs('/register')
        ->assertSee('email has already been taken');

});
