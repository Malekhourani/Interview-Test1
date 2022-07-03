<?php

namespace App\Actions\Blog;

use App\Actions\Handler;
use App\Helpers\MediaHelper;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;

class UpdateBlog implements Handler
{
    public function handel($command)
    {
        DB::beginTransaction();

        if ($command->default_media) {
            $defaultMediaName = MediaHelper::storeMedia($command->default_media);
            $command->blog->defaultImage->path = $defaultMediaName;
        }

        $command->blog->update([
            'title' => $command->blogInfo->title,
        ]);

        if ($command->blogInfo->blog_type === Blog::CONTENT_BLOG) (new UpdateTextBlog)->handel((object) [
            'content' => $command->blogInfo->content,
            'blogable' => $command->blog->blogable
        ]);

        else if ($command->blogInfo->blog_type === Blog::VIDEO_BLOG) (new UpdateVideoBlog)->handel((object) [
            'video' => $command->blogInfo->video,
            'blog' => $command->blog
        ]);

        DB::commit();
    }
}
