<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Media;
use App\Models\TextBlog;
use App\Models\VideoBlog;
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
        $this->call([
            UserSeeder::class,
            MediaSeeder::class,
            TextBlogSeeder::class,
            VideoBlogSeeder::class,
            BlogSeeder::class,
            CommentSeeder::class
        ]);
    }
}
