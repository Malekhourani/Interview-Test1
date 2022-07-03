<?php 

namespace App\Actions\Blog;

use App\Actions\Handler;
use App\Models\VideoBlog;

class StoreVideoBlog implements Handler
{
    public function handel($command = null)
    {
        $videoBlog = VideoBlog::create([]);

        return $videoBlog;
    }
}