<?php 

namespace App\Actions\Comments;

use App\Actions\Handler;
use App\Models\Comment;

class DeleteComment implements Handler
{
    public function handel($command = null)
    {
        Comment::where('id', $command->id)->delete();
    }
}