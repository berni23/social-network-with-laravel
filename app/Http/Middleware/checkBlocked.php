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
        $rel = User::find(auth()->user()->id)->relationship($request->route('id'));
        if ($rel && $request->id == $rel->user_one_id && $rel->status == 3) {
            return redirect('/home')->with('message', 'user not found');
        }
        return $next($request);
    }
}
