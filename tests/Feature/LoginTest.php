<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * Speaker login test
     */
    public function test_speaker_login(): void
    {
        $response = $this->get('/login');

        $credentials = ['email' => 'speaker@email.com', 'password' => '123456'];
        $this->post('/login', $credentials)->assertRedirect('/speaker/dashboard');
    }

    /**
     * Speaker reviewer test
     */
    public function test_reviewer_login(): void
    {
        $response = $this->get('/login');

        $credentials = ['email' => 'reviewer@email.com', 'password' => '123456'];
        $this->post('/login', $credentials)->assertRedirect('/reviewer/dashboard');
    }
}
