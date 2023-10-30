<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ReviewsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Open reviews dashboard
     */
    public function test_open_review_dashboard(): void
    {
        $user = User::factory()->create(['type' => 'reviewer']);

        $response = $this->actingAs($user)->get('/reviewer/dashboard')->assertOk();
    }

    /**
     * Submit reviews search
     */
    public function test_submit_reviews_search(): void
    {
        $user = User::where('type', 'reviewer')->first();

        $payload = ['q' => 'speaker:speaker tag:Tech'];

        $response = $this->actingAs($user)->get('/reviewer/dashboard', $payload);
        $response->assertStatus(200);
    }
}
