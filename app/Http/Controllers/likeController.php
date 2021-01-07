<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Models\Like;
use arrayTools;

class likeController extends Controller
{

    function toggleLike($likeable, $id)
    {
        $model = "";
        $likeable_type = 'App\\Models\\Comment';
        switch ($likeable) {
            case 'comment':
                $model = Comment::find($id);
                break;
            case 'post':
                $model = Post::find($id);
                $likeable_type = 'App\\Models\\Post';
                break;
        }
        // store the relation between user and liked comment, in order to paint it in red or not

        $queryLike = Like::queryLike($model->id, $likeable_type);
         if (isset($queryLike)) {
            if($queryLike->like) {
            $model->likes -= 1;
            $like=false;
            }
            else {
                $like=true;
                $model->likes += 1;
            }
            DB::table('likes')
            ->where('likeable_id',$id)
            ->where('likeable_type',$likeable_type)
            ->where('user_id',auth()->user()->id)
            ->update(['like'=>$like]);
             $model->save();
             return '1';
         }
        $likeRel = new Like;
        $likeRel->likeable_id = $model->id;
        $likeRel->likeable_type = $likeable_type;
        $likeRel->like = true;
        $likeRel->user_id = auth()->user()->id;
        $likeRel->save();
        $model->likes += 1;
        $model->save();
        return '1';
    }

    function changeLike($likeRel)
    {
        $likeRel->like = !$likeRel->like;
        $likeRel->save();
        return $likeRel->like;
    }
}
