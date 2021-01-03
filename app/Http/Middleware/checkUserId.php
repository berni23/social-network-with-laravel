<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\Post;

class checkUserId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $idPost = $request->route('id');
        $userId = Post::find($idPost)->user->id;
        if (auth()->user()->id == $userId) return $next($request);
        else redirect('home');
    }
}
