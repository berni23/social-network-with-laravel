<?php

namespace App\Http\Controllers;

use App\Models\User;
use arrayTools;

class userController extends Controller
{
    public function show()
    {
        $user = User::find(auth()->user()->id);
        $user->numFriends = $user->numFriends();
        $user->numPosts = $user->numPosts();
        $user->show = true;
        $user->self = true;
        return view('profile', compact('user'));
    }

    public function showUser($username)
    {
        $self = User::find(auth()->user()->id);
        if ($self->name == $username) return redirect('profile');
        $friendsId = $self->friendsId();
        $user = User::where('name', $username)->get()->first();
        $user->numFriends = $user->numFriends();
        $user->numPosts = $user->numPosts();
        $user->self = false;
        if (in_array($user->id, $self->friendsId())) $user->show = true;
        else $user->show = false;
        return view('profile', compact('user'));
    }
    public function paginatePosts($group = "all", $offset, $limit)
    {
        // offset starts at 0
        // limit start at 1
        // if the end is reached, the slice returns the elements until the last one

        $posts = "";
        switch ($group) {
            case 'all':
                $posts =  $this->postsToSee();
                break;
            case 'user';
                $posts = arrayTools::objectToArray(User::find(auth()->user()->id)->posts()->orderBy('created_at', 'DESC')->get());
                break;
            default:
                $posts = arrayTools::objectToArray(User::find($group)->posts()->orderBy('created_at', 'DESC')->get());
                break;
        }

        if (count($posts) < ($offset + $limit)) $posts = array_slice($posts, $offset);
        else $posts = array_slice($posts, $offset, $limit);
        if (empty($posts)) return '0';
        return view('postPopulate', compact('posts'));
    }

    public function home()
    {
        return view('home');
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
    }

    public function isFriend($id)
    {
        return in_array($id, User::find(auth()->user()->id)->friendsList());
    }


    public function user()
    {

        return  User::find(auth()->user()->id);
    }
    public function frienshipRequest($id)
    {

        $rel = $this->user()->relationship($id);


        if ($rel) {


            switch ($rel->status) {



                case 0: // request was pending




                    //                     0	Pending
                    // 1	Accepted
                    // 2	Declined
                    // 3	Blocked

                    //  break;
            }
        }

        return 0;



        //  if (isFriend($id))

    }
}
