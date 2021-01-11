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

        $friendId = $request->route('id');
        if ($friendId == auth()->user()->id) redirect()->back();
        $rel = User::find(auth()->user()->id)->relationship($friendId);

        if ($rel && $this->isBlocked($rel, $friendId))  return redirect('/home')->with('message', 'user not found');

        if ((!$rel && $request->input('relStatus') == -1) || (isset($rel) && $rel->status == $request->input('relStatus')))  return $next($request);
        return redirect()->back()->with('message', 'please,try again');
    }

    public function isBlocked($rel, $friendId)
    {

        return $rel->status == 3 && $rel->user_one_id == $friendId;
    }
}
