<?php

namespace App\Http\Controllers;

use App\Actions\Blog\StoreBlog;
use App\Actions\Blog\UpdateBlog;
use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use Illuminate\Http\Response;

class BlogController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
        $blog = (new StoreBlog)->handel($request);

        return response([
            'id' => $blog->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return response($blog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogRequest  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        (new UpdateBlog)->handel((object) [
            'default_media' => $request->file('default_media'),
            'blog_info' => $request->validated()
        ]);

        return response('updated', Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return response('removed', Response::HTTP_NO_CONTENT);
    }
}
