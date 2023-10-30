<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;

class TalkProposalTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Open add talk proposal form
     */
    public function test_open_add_talk_proposal_form(): void
    {
        $user = User::factory()->create(['type' => 'speaker']);

        $response = $this->actingAs($user)->get('/speaker/add-talk-proposal')->assertOk();
    }

    /**
     * Submit talk proposal form
     */
    public function test_submit_talk_proposal_form(): void
    {
        $user = User::where('type', 'speaker')->first();

        $file = UploadedFile::fake()->image('file.pdf');

        $payload = ['title' => 'Test talk proposal', 'file' => $file, 'tags' => [1]];

        $response = $this->actingAs($user)->post('/speaker/add-talk-proposal', $payload);
        $response->assertStatus(200);
        $this->assertDatabaseHas('talk_proposals', ['title' => 'Test talk proposal']);
    }

    /**
     * Submit invalid talk proposal form
     */
    public function test_submit_invalid_talk_proposal_form(): void
    {
        $user = User::where('type', 'speaker')->first();

        $file = UploadedFile::fake()->image('file.jpg');

        $payload = ['title' => 'Test talk proposal', 'file' => $file, 'tags' => [1]];

        $response = $this->actingAs($user)->post('/speaker/add-talk-proposal', $payload);
        $response->assertInvalid(['file']);
    }
}
