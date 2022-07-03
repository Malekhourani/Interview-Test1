<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Media;
use App\Models\TextBlog;
use App\Models\User;
use App\Models\VideoBlog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('email', 'editor@email.com')->get();
        $textBlogs = TextBlog::all();
        $videoBlogs = VideoBlog::all();

        $allBlogs = $textBlogs->merge($videoBlogs);

        foreach ($allBlogs as $blog) {
            Blog::factory()->createOne([
                'user_id' => $users->random()->id,
                'blogable_type' => $blog->getNameOfClass(),
                'blogable_id' => $blog->id
            ]);
        }
    }
}
