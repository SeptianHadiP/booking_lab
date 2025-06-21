<?php

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    testLog('Starting registration test');
    
    $userData = [
        'name' => 'Test User',
        'username' => 'testuser',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ];
    
    testLog('Registration data: ' . json_encode($userData));
    
    $response = $this->post('/register', $userData);
    
    // Log response details to debug authentication issue
    testLog('Response status: ' . $response->status());
    testLog('Response content: ' . $response->getContent());
    testLog('Response headers: ' . json_encode($response->headers->all()));
    
    // Check if there are any validation errors
    if ($response->status() !== 302) {
        testLog('Registration failed - not a redirect response', 'warning');
        testLog('Full response content: ' . $response->getContent(), 'warning');
    }
    
    // Check if user was created in database
    $user = \App\Models\User::where('email', 'test@example.com')->first();
    if ($user) {
        testLog('User created successfully in database: ' . json_encode($user->toArray()));
    } else {
        testLog('User was NOT created in database', 'error');
    }
    
    // Check authentication state before assertion
    testLog('Is authenticated before assertion: ' . (auth()->check() ? 'YES' : 'NO'));
    testLog('Current user: ' . (auth()->user() ? json_encode(auth()->user()->toArray()) : 'NULL'));
    
    // Check session data
    testLog('Session data: ' . json_encode(session()->all()));
    
    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
    
    testLog('Registration test completed successfully');
});
