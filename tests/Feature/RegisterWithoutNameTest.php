<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('a user can be registered without providing a name', function () {
    // Mirrors the insert performed by the registration component when the
    // optional name field is disabled (the default): email + password, no name.
    $user = User::create([
        'email' => 'newuser@example.com',
        'password' => Hash::make('password123'),
    ]);

    expect($user->name)->toBeNull();

    $this->assertDatabaseHas('users', [
        'email' => 'newuser@example.com',
        'name' => null,
    ]);
});
