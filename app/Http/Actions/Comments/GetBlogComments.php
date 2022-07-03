<?php

namespace App\Actions\Comments;

use App\Actions\Handler;
use App\Models\Comment;

class GetBlogComments implements Handler
{
    public function handel($command = null)
    {
        return Comment::where('blog_id', $command->blog->id)
            ->orderBy('created_at', 'desc')
            ->paginate();
    }
}
