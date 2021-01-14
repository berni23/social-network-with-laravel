<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Relationship;
use App\Models\User;
use arrayTools;


class userController extends Controller
{

    // show the user profile

    public function show()
    {
        $user = $this->user();
        $user->numFriends = $user->numFriends();
        $user->numPosts = $user->numPosts();
        $user->show = true;
        $user->self = true;
        return view('profile', compact('user'));
    }

    // show a user profile in general

    public function showUser($username)
    {
        $self = $this->user();
        if ($self->name == $username) return redirect('/profile');
        $friendsId = $self->friendsId();
        $user = User::where('name', $username)->get()->first();
        if (!$user) return redirect()->back()->with('message', 'user not found');

        // populate data to be  displayed in the profile view

        // number of friends
        $user->numFriends = $user->numFriends();
        // number of posts
        $user->numPosts = $user->numPosts();
        // user profile not the logged one
        $user->self = false;
        // which status the user holds with this one
        $user->relStatus = $self->relStatus($user->id);

        // an action will be available for the user depending on the friendship status

        // block user
        // remove friendship
        // request friendship
        // decline request

        $user->friendshipStatus = $this->friendshipStatus($user->id);

        // user is able to see their posts if it is a friend
        if (in_array($user->id, $self->friendsId())) $user->show = true;
        else $user->show = false;
        return view('profile', compact('user'));
    }


    // show a list of user friends
    public function showFriends()
    {
        $friendsId = $this->user()->friendsId();
        $friends = [];
        for ($i = 0; $i < count($friendsId); $i++) {
            $friend = User::find($friendsId[$i]);
            $friends[$i] = $friend;
        }
        return view('friendsList', compact('friends'));
    }

    // post pagination depending on the offset and limit defined in  post.js

    public function paginatePosts(Request $request)

    {
        $posts = [];

        // retrieve the posts based on the content variable, which matches the content with post description
        if (isset($request->content)) {
            $posts = $this->postsByContent($request->content);

            if (empty($posts)) return  view('postPopulate')->with('noPosts', 'no posts containing \'' . $request->content . '\'');
        } else {
            switch ($request->group) {
                    // retrieve all the posts the user is able to see ( homepage)
                case 'all':
                    $posts =  $this->postsToSee();
                    break;

                    // retrieve only a single user posts (profile page)
                case 'user';
                    $posts = arrayTools::objectToArray(User::find(auth()->user()->id)->posts()->orderBy('created_at', 'DESC')->get());
                    break;
                default:

                    // retrieve posts given a user id
                    $posts = arrayTools::objectToArray(User::find($request->group)->posts()->orderBy('created_at', 'DESC')->get());
                    break;
            }
        }

        // split the posts based on limit and offset
        if (count($posts) < ($request->offset + $request->limit)) $posts = array_slice($posts, $request->offset);
        else $posts = array_slice($posts, $request->offset, $request->limit);


        // add user mentions ( @name -> <a href = user/name>@name</a>)

        foreach ($posts as $post) {
            $post->description = arrayTools::addMentions($post->description);
        }
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

    // retrieve posts the user is able to see ( own posts + friend posts)

    public function postsToSee()
    {
        $user = $this->user();
        $userPosts = arrayTools::objectToArray($this->postsById(auth()->user()->id));
        $friendsId = $user->friendsId();

        for ($i = 0; $i < count($friendsId); $i++) {

            $userPosts = arrayTools::merge($userPosts, $this->postsById($friendsId[$i]));
        }


        usort($userPosts, array('arrayTools', 'newFirst'));
        return $userPosts;
    }

    // check if user is friend or not

    public function isFriend($id)
    {
        return in_array($id, $this->user()->friendsId());
    }

    // retrieve logged user

    public function user()
    {
        return  User::find(auth()->user()->id);
    }

    // message depending on relationship status with a user
    public function friendshipStatus($id)
    {
        $status =  $this->user()->relStatus($id);
        switch ($status) {
            case 0:
                return 'request pending .. ';
            case 1:
                return 'remove friendship';
            case 3:
                return 'click to unblock user';
            case -1:
            case  2:
            default:
                return 'send friendship request';
        }
    }

    // handle friendship request

    public function friendshipRequest(Request $request, $id)
    {
        /*Relationship status
        -------------
         0	Pending
         1	Accepted
         2	Declined
         3	Blocked
        -------------

        */

        $user = $this->user();
        $user_id = $user->id;
        $rel = $user->relationship($id);
        if (!$rel) {
            $rel = new Relationship();
            $rel->status = 0;
            $rel->user_one_id = $user_id;
            $rel->user_two_id = $id;
            $rel->save();
            return redirect()->back()
                ->with('message', ' friendship requested')
                ->with('status', 200);
        }

        if ($rel->status == 2) {
            $rel->status = 0;
            $rel->user_one_id = $user_id;
            $rel->user_two_id = $id;
            $rel->save();
            return redirect()->back()
                ->with('message', ' friendship requested')
                ->with('status', 200);
        }

        if ($rel->status == 1) {
            $rel->delete();
            return redirect()->back()
                ->with('message', ' friendship removed')
                ->with('status', 200);
        }

        if ($rel->user_one_id == $user_id && $rel->status == 0) {
            $rel->delete();
            return redirect()->back()->with('message', 'request canceled');
        }
        if ($rel->user_two_id == $user_id && $rel->status == 0) {
            return redirect()->back()
                ->with('modal-accept', true);
        }
        if ($rel->user_one_id == $user_id && $rel->status == 3) {
            $rel->delete();
            return redirect()->back()
                ->with('message', 'user blocking stopped');
        }
    }


    // block a user

    function blockUser(Request $request, $id)
    {
        $user = $this->user();
        $user_id = $user->id;
        $rel = $user->relationship($id);

        if (!$rel)  $rel = new Relationship();

        $rel->user_one_id = $user_id;
        $rel->user_two_id = $id;
        $rel->status = 3;
        $rel->save();
        return redirect()->back()
            ->with('message', 'user blocked')
            ->with('status', 200);
    }


    // respond a friendship request ( accept or decline)

    function respondRequest(Request $request, $id)
    {
        $rel = $this->user()->relationship($id);
        if (isset($request->decline)) {
            $rel->status = 2;
            $rel->save();
            return  redirect()->back()
                ->with('message', 'request declined')
                ->with('status', 200);
        } else {

            $rel->status = 1;
            $rel->save();
            return  redirect()->back()->with('message', 'request accepted')
                ->with('status', 200);
        }
    }


    // retrieve notifications with status 0 ( pending)

    function getNotifications()
    {
        return json_encode($this->user()->pendingNotifications());
    }


    // handle user search

    function search(Request $request)
    {

        if (str_starts_with($request->search, '@')) {
            $name = substr($request->search, 1);
            $user = User::where('name', $name)->get()->first();
            if ($user) return redirect('/user/' . $user->name);
            else return redirect()->back()->with('message', 'user not found');
        }

        return redirect('/home')->with('content', $request->search);
    }


    // retrieve posts if the content is found in post description
    function postsByContent($content)
    {
        $posts = $this->postsToSee();
        $matchingPosts = [];
        foreach ($posts as $post) {
            if (str_contains($post->description, $content)) {
                $matchingPosts[] = $post;
            }
        }
        return $matchingPosts;
    }
}
