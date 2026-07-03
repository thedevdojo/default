<?php

test('web responses declare builder frame ancestors', function () {
    $this->get('/')
        ->assertOk()
        ->assertHeader('Content-Security-Policy', 'frame-ancestors '.config('platform.frame_ancestors'));
});

test('the status endpoint rejects requests when no token is configured outside local', function () {
    $this->getJson('/platform/api/status')->assertUnauthorized();
});

test('the status endpoint rejects an invalid token', function () {
    config(['platform.token' => 'secret-token']);

    $this->getJson('/platform/api/status', ['X-Platform-Token' => 'wrong-token'])->assertUnauthorized();
});

test('the status endpoint reports app details with a valid token', function () {
    config(['platform.token' => 'secret-token']);

    $this->getJson('/platform/api/status', ['X-Platform-Token' => 'secret-token'])
        ->assertOk()
        ->assertJsonStructure(['name', 'environment', 'laravel', 'php', 'features', 'time'])
        ->assertJsonPath('environment', 'testing');
});
