<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class checkFriendStatus
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
        if ((!$rel && $request->relStatus == -1) || ($rel->status == $request->relStatus)) {
            return $next($request);
        }

        return redirect()->back()->with('message', 'please,try again');
    }
}
