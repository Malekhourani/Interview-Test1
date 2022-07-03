<?php

namespace App\Actions\Comments;

use App\Actions\Handler;
use App\Models\Comment;

class UpdateComment implements Handler
{
    public function handel($command = null)
    {
        Comment::where('id', $command->id)
            ->update([
                'content' => $command->content
            ]);
    }
}
