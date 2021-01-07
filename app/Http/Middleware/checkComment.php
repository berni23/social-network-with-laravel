<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

// check if the owner of the post being commented is a friend (or the same user)

class checkComment
{
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $userId = auth()->user()->id;
        $postCreator = Post::find($request->post_id)->user_id;
        $friendsList = User::find($userId)->friendsId();
        if($postCreator==$userId||in_array($postCreator,$friendsList)){
        return $next($request);
        }
        else redirect()->back();
    }
}
