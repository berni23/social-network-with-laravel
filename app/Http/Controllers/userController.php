<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Relationship;
use App\Models\User;
use arrayTools;

class userController extends Controller
{
    public function show()
    {
        $user = $this->user();
        $user->numFriends = $user->numFriends();
        $user->numPosts = $user->numPosts();
        $user->show = true;
        $user->self = true;
        return view('profile', compact('user'));
    }

    public function showUser($username)
    {
        $self = $this->user();
        if ($self->name == $username) return redirect('profile');
        $friendsId = $self->friendsId();
        $user = User::where('name', $username)->get()->first();
        if (!$user) return redirect()->back()->with('message', 'user not found');
        $user->numFriends = $user->numFriends();
        $user->numPosts = $user->numPosts();
        $user->self = false;
        $user->relStatus = $self->relStatus($user->id);
        $user->friendshipStatus = $this->friendshipStatus($user->id);
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
        $user = $this->user();
        $userPosts = $user->posts();
        $friendsId = $user->friendsId();
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
        return in_array($id, $this->user()->friendsList());
    }

    public function user()
    {
        return  User::find(auth()->user()->id);
    }
    public function friendshipStatus($id)
    {
        $status =  $this->user()->relStatus($id);

        // echo $status;
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

    function blockUser(Request $request, $id)
    {

        $user = $this->user();
        $user_id = $user->id;
        $rel = $user->relationship($id);

        if (!$rel) {
            $rel = new Relationship();
            $rel->user_one_id = $user_id;
            $rel->user_two_id = $id;
        }

        $rel->status = 3;
        $rel->save();
        return redirect()->back()
            ->with('message', 'user blocked')
            ->with('status', 200);
    }


    function respondRequest(Request $request, $id)
    {
        $user = User::find($id);

        $rel = $this->user()->relationship($id);

        if (isset($request->decline)) {

            $rel->status = 2;
            $rel->save();
            return  redirect('user/' . $user->name)
                ->with('message', 'request declined')
                ->with('status', 200);
        } else {

            $rel->status = 1;
            $rel->save();

            return  redirect('user/' . $user->name)->with('message', 'request accepted')
                ->with('status', 200);
        }
    }
}
