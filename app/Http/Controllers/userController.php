<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use arrayTools;
use Illuminate\Http\Request;


class userController extends Controller
{

    public function show()
    {
        return view('profile');
    }

    public function home()
    {
        $posts = $this->postsToSee();
        return view('home', compact('posts'));
    }

    private function postsById(int $id)
    {
        return  User::find($id)->posts;
        //->sortByDesc('created_at');
    }

    public function postsToSee()
    {
        $userId = auth()->user()->id;
        $userPosts =  $this->postsById($userId);
        $friendsId = User::find($userId)->friendsId();
        $friendsPosts = [];
        foreach ($friendsId as $id) {
            array_push($friendsPosts, $this->postsById($id));
        }
        $postsToSee = arrayTools::merge($userPosts, $friendsPosts);

        echo json_encode($postsToSee);
        //return usort($postsToSee, array('arrayTools', 'newFirst'));
    }
}
