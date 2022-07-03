<?php 

namespace App\Actions\Blog;

use App\Actions\Handler;
use App\Models\TextBlog;

class StoreTextBlog implements Handler
{
    public function handel($command)
    {
        $textBlog = TextBlog::create([
            'content' => $command->content
        ]);

        return $textBlog;
    }
}