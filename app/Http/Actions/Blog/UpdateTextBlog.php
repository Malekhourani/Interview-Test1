<?php

namespace App\Actions\Blog;

use App\Actions\Handler;

class UpdateTextBlog implements Handler
{
    public function handel($command)
    {
        $command->blogable->update(['content' => $command->content]);
    }
}