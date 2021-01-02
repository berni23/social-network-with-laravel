<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use arrayTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        usort($postsToSee, array('arrayTools', 'newFirst'));
        return $postsToSee;

        // TODO: Only load the x first posts, dinamical upload as the user scrolls
    }
}
