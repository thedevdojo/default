<?php

use App\Models\User;

test('the home page welcomes the developer', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('Welcome to your new')
        ->assertSee('Start building')
        ->assertSee(config('platform.builder_url'));
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
