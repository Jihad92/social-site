<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $users = User::factory(5)
            ->has(
                Post::factory(3)
                ->has(
                    Comment::factory(3)
                )
            )
            ->create();

        $comments = Comment::all();
        foreach ($comments as $comment) {
            $comment->user_id = User::all()->random()->id;
            $comment->save();
        }
    }
}
