<?php

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;

test('email verification screen can be rendered', function () {
    $user = User::factory()->unverified()->create();
    //testLog("Response: " .json_encode($user));    
    $response = $this->actingAs($user)->get('/verify-email');
    //testLog("Response: " . $response->getContent());    
    $response->assertStatus(200);
});

test('email can be verified', function () {
    $user = User::factory()->unverified()->create();
    testLog("Response: " .json_encode($user));    
    
    Event::fake();

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1($user->email)]
    );
    testLog("Response: " .json_encode($verificationUrl));    
  
    $response = $this->actingAs($user)->get($verificationUrl);
    ///testLog("Response: " . $response->assert());    
    //$response->dump();
    Event::assertDispatched(Verified::class);
    testLog("Response: " .json_encode($user));    
    
    expect($user->fresh()->hasVerifiedEmail())->toBeTrue();
    testLog("Response: " .json_encode($user));    
    
    $response->assertRedirect(route('dashboard', absolute: false).'?verified=1');
});

test('email is not verified with invalid hash', function () {
    $user = User::factory()->unverified()->create();

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1('wrong-email')]
    );

    $this->actingAs($user)->get($verificationUrl);

    expect($user->fresh()->hasVerifiedEmail())->toBeFalse();
});
