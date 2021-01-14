<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Like;
use Illuminate\Database\QueryException;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'image',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {

        $comments =  $this->hasMany(Comment::class);

        return $comments;
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
    function savePost(string $direction)
    {
        try {
            $this->save();
        } catch (QueryException $ex) {
            return redirect()->back()
                ->with('message', 'failed to post')
                ->with('status', 400);
        }
        return redirect($direction)
            ->with('message', 'post successfully added')
            ->with('status', 200);
    }
}
