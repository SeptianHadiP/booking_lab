<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    // Create user with known password
    $user = User::factory()->create([
        'username' => 'testuser',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);
    
    testLog('User created: ' . json_encode($user->toArray()));
    testLog('User password hash: ' . $user->password);
 
    // Use id_user field (not email) as per LoginRequest
    $loginData = [
        'id_user' => $user->email, // Can be email or username
        'password' => 'password',
    ];
    
    testLog('Login data: ' . json_encode($loginData));
 
    $response = $this->post('/login', $loginData);
 
    // Log response details to debug authentication issue
    testLog('Response status: ' . $response->status());
    testLog('Response content: ' . $response->getContent());
    testLog('Response headers: ' . json_encode($response->headers->all()));
    
    // Check authentication state before assertion
    testLog('Is authenticated before assertion: ' . (auth()->check() ? 'YES' : 'NO'));
    testLog('Current user: ' . (auth()->user() ? json_encode(auth()->user()->toArray()) : 'NULL'));
    
    // Check session data
    testLog('Session data: ' . json_encode(session()->all()));
    
    // Check if there are any validation errors
    if ($response->status() !== 302) {
        testLog('Login failed - not a redirect response', 'warning');
        testLog('Full response content: ' . $response->getContent(), 'warning');
    }
 
    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
    
    testLog('Authentication test completed successfully');
});

test('users can authenticate using username', function () {
    // Create user with known password
    $user = User::factory()->create([
        'username' => 'testuser2',
        'email' => 'test2@example.com',
        'password' => Hash::make('password'),
    ]);
    
    testLog('User created with username: ' . json_encode($user->toArray()));
 
    // Use username instead of email
    $loginData = [
        'id_user' => $user->username,
        'password' => 'password',
    ];
    
    testLog('Login data with username: ' . json_encode($loginData));
 
    $response = $this->post('/login', $loginData);
 
    testLog('Response status: ' . $response->status());
    testLog('Is authenticated: ' . (auth()->check() ? 'YES' : 'NO'));
 
    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create([
        'password' => Hash::make('password'),
    ]);
    
    testLog('Testing invalid password for user: ' . json_encode($user->toArray()));

    $response = $this->post('/login', [
        'id_user' => $user->email,
        'password' => 'wrong-password',
    ]);
    
    testLog('Invalid password response status: ' . $response->status());
    testLog('Is authenticated after invalid password: ' . (auth()->check() ? 'YES' : 'NO'));

    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');
    
    testLog('Logout response status: ' . $response->status());
    testLog('Is authenticated after logout: ' . (auth()->check() ? 'YES' : 'NO'));

    $this->assertGuest();
    $response->assertRedirect('/');
});
