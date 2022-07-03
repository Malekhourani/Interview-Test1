<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blogs = Blog::take(10)->get();
        $users = User::take(10)->get();

        foreach ($blogs as $blog) {
            Comment::factory()->count(5)->create([
                'user_id' => $users->random()->id,
                'blog_id' => $blog->id
            ]);
        }
    }
}
