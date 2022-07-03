<?php

namespace App\Actions\Blog;

use App\Actions\Handler;
use App\Actions\Media\StoreMedia;
use App\Models\Blog;
use App\Models\TextBlog;
use App\Models\VideoBlog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreBlog implements Handler
{
    private StoreMedia $storeMediaAction;

    public function __construct()
    {
        $this->storeMediaAction = new StoreMedia;
    }

    public function handel($command)
    {
        DB::beginTransaction();

        if ($command->blog_type === Blog::VIDEO_BLOG) {
            $blogable = (new StoreVideoBlog)->handel();
            $blogable_type = VideoBlog::class;
        } 
        else if ($command->blog_type === Blog::CONTENT_BLOG) {
            $blogable = (new StoreTextBlog)->handel((object) ['content' => $command->content]);
            $blogable_type = TextBlog::class;
        }

        $blog = Blog::create([
            'title' => $command->title,
            'user_id' => Auth::id(),
            'blogable_type' => $blogable_type,
            'blogable_id' => $blogable->id
        ]);

        $this->storeMediaAction->handel((object)[
            'media' => $command->default_media,
            'mediable_type' => Blog::class,
            'mediable_id' => $blog->id,
            'is_default' => true
        ]);

        if ($blogable instanceof VideoBlog) $this->storeMediaAction->handel((object)[
            'media' => $command->video,
            'mediable_type' => Blog::class,
            'mediable_id' => $blog->id,
            'is_default' => false
        ]);

        DB::commit();

        return $blog;
    }
}
