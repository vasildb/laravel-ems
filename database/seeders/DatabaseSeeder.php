<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Speaker;
use Illuminate\Support\Facades\Hash;
use \App\Models\Tag;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Add users
        User::factory()->create([
            'name' => 'Reviewer',
            'email' => 'reviewer@email.com',
            'type' => 'reviewer',
            'password' => Hash::make('123456')
        ]);

        $speaker = User::factory()->create([
            'name' => 'Speaker',
            'email' => 'speaker@email.com',
            'type' => 'speaker',
            'password' => Hash::make('123456')
        ]);

        // Make one user a Speaker
        $sp = new Speaker;
        $sp->user_id = $speaker->id;
        $sp->save();

        // Add tags
        foreach (['Technology', 'Health', 'Business'] as $tag) {
            Tag::factory()->create([
                'title' => $tag
            ]);
        }
    }
}
