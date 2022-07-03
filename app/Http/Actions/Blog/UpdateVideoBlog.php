<?php

namespace App\Actions\Blog;

use App\Actions\Handler;
use App\Helpers\MediaHelper;

class UpdateVideoBlog implements Handler
{
    public function handel($command)
    {
        if (!$command->video) return;

        $filename = MediaHelper::storeMedia($command->video);

        $command->blog->video->update([
            'path' => $filename
        ]);
    }
}
