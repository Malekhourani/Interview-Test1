<?php 

namespace App\Actions\Comments;

use App\Actions\Handler;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class StoreComment implements Handler
{
    public function handel($command = null)
    {
        Blog::where('id', $command->blog_id)->firstOrFail();

        $comment = Comment::create([
            'content' => $command->content,
            'user_id' => Auth::id(),
            'blog_id' => $command->blog_id
        ]);

        return $comment;
    }
}