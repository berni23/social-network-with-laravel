<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\User;

class checkBlocked
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
        $friendId = $request->route('id');
        if ($friendId == auth()->user()->id) return redirect()->back();
        $rel = User::find(auth()->user()->id)->relationship($friendId);
        if ($rel && $request->id == $rel->user_one_id && $rel->status == 3) {
            return redirect('/home')->with('message', 'user not found');
        }
        return $next($request);
    }
}
