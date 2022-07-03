<?php

namespace App\Http\Middleware;

use App\Exceptions\OnlyResourceOwnerAndAdminCanEditOrDeleteItException;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdminOrTheResourceCreatorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $otherAcceptedUserType)
    {
        $isAdmin = Auth::user()->hasAnyRole([User::ADMIN]);

        if($isAdmin) return $next($request);

        $this->checkIfTheCreatorOfThisResource($request, $otherAcceptedUserType);
        
        return $next($request);
    }

    private function checkIfTheCreatorOfThisResource($request, $resource_key)
    {
        if($request->get($resource_key)->user_id != Auth::id()) throw new OnlyResourceOwnerAndAdminCanEditOrDeleteItException($resource_key);
    }
}
