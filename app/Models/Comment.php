<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Comment extends Model
{
    use HasFactory;
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function saveComment()
    {
        try {
            $this->save();
        } catch (QueryException $ex) {
            return redirect()->back()
                ->with('message', 'failed to add comment')
                ->with('status', 400);
        }
        return redirect()->back()->with('message', 'comment added')->with('status', 200);
    }
}
