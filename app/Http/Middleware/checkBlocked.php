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
        $name = $request->route('username');
        $friend =  User::where('name', $name)->get()->first();
        if (!$friend) return redirect('/home')->with('message', 'user not found');

        $friendId = $friend->id;
        $rel = User::find(auth()->user()->id)->relationship($friendId);
        if ($rel && $friendId == $rel->user_one_id && $rel->status == 3) {
            return redirect('/home')->with('message', 'user not found');
        }
        return $next($request);
    }
}
