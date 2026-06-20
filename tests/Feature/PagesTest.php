<?php

use App\Models\User;

test('the home page renders the hero', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('Build something great, faster.');
});

test('the dashboard redirects guests to login', function () {
    $this->get('/dashboard')->assertRedirect();
});

test('authenticated users can view the dashboard', function () {
    $user = User::factory()->create(['name' => 'Ada Lovelace', 'email' => 'ada@example.com']);

    $this->actingAs($user)
        ->get('/dashboard')
        ->assertOk()
        ->assertSee('No projects created yet')
        ->assertSee('All Projects')
        ->assertSee('ada@example.com');
});
