<?php

namespace App\Http\Middleware;

use App\Models\Blog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SetBlogTypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->has(Blog::VIDEO_BLOG) || !$request->has(Blog::CONTENT_BLOG)) throw ValidationException::withMessages(['you should provide either video or content']);

        $request->blog_type = $this->setBlogType($request);
    
        return $next($request);
    }

    private function setBlogType($request)
    {
        if($request->has(Blog::VIDEO_BLOG)) return Blog::VIDEO_BLOG;

        return Blog::CONTENT_BLOG;
    }
}
