<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Media;
use App\Models\User;
use App\Models\VideoBlog;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    const MODEL_CAN_HAVE_MEDIA = [Blog::class, VideoBlog::class, Comment::class, User::class];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $videoBlogs = VideoBlog::all();
        $comments = Comment::all();
        $all = $videoBlogs->merge($comments);

        foreach ($all as $item) {
            Media::factory()->createOne([
                'mediable_type' => $item->getNameOfClass(),
                'mediable_id' => $item->id
            ]);
        }

        $blogs = Blog::all();

        foreach ($blogs as $blog) {
            Media::factory()->createOne([
                'mediable_type' => Blog::class,
                'mediable_id' => $blog->id
            ]);
        }
    }
}
