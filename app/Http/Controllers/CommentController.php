<?php

namespace App\Http\Controllers;

use App\Actions\Comments\DeleteComment;
use App\Actions\Comments\GetBlogComments;
use App\Actions\Comments\StoreComment;
use App\Actions\Comments\UpdateComment;
use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Blog;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request)
    {
        return (new StoreComment)->handel((object) [
            'content' => $request->content,
            'blog_id' => $request->blog_id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return response($comment);
    }

    public function blogComments(Blog $blog)
    {
        $comments = (new GetBlogComments)->handel($blog);

        return response($comments);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        return (new UpdateComment)->handel((object) [
            'id' => $comment->id,
            'content' => $request->content
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        return (new DeleteComment)->handel($comment);
    }
}
