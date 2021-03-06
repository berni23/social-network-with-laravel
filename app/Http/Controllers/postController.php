<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class postController extends Controller
{

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */

    public function new()
    {
        return view('newPost');
    }


    /* calculate time elapsed since post creation.
       display such difference in seconds, minutes, hours or days depending
       on the order of magnitude */


    static function timeElapsed($timestamp)
    {
        $d1 = new DateTime($timestamp);
        $d2 = new DateTime();
        $interval = $d1->diff($d2);
        $totalDiff = abs(time() - strtotime($timestamp)); // diff in seconds
        if ($totalDiff < 60) return "seconds ago";
        if ($totalDiff >= 60 && $totalDiff < 3600) return $interval->i . " minutes ago";
        if ($totalDiff >= 3600 && $totalDiff < 86400) return $interval->h . " hours ago";
        if ($totalDiff >= 86400) return $interval->d . " days ago";
    }
    public function store(Request $request)
    {
        $validation = $this->validatePost($request);
        if ($validation->fails()) {
            return redirect('/posts/new')
                ->withErrors($validation)
                ->withInput();
        }
        $post = new Post;
        $post->description = $request->description;
        $post->user_id = auth()->user()->id;
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->store('public/post-photos');
            $post->image  = str_replace('public/', '', $path);
        }
        return $post->savePost('/home');
    }
    private function validatePost(Request $request)
    {
        return Validator::make($request->all(), [
            'image' => 'mimes:jpeg,png,jpg|max:507|nullable',
            'description' => 'required'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editPost = Post::find($id);
        return view('newPost', compact('editPost'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation =  $this->validatePost($request);
        if ($validation->fails()) {
            return redirect('/posts/edit/' . $id)
                ->withErrors($validation);
        }
        $post = Post::find($id);
        $post->description = $request->description;
        $post->user_id = auth()->user()->id;
        if ($request->hasFile('image')) {
            $path  =  $request->file('image')->store('public/post-photos');
            $post->image  = str_replace('public/', '', $path);
        }
        return $post->savePost('/home');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $post = Post::find($id);
            $comments = $post->comments;
            foreach ($comments as $comment) {
                Comment::find($comment->id)->delete();
            }
            $post->delete();
        } catch (QueryException $ex) {
            return redirect()->back()
                ->with('message', 'failed to delete')
                ->with('status', 400);
        }
        return redirect('/home')
            ->with('message', 'post deleted')
            ->with('status', 200);
    }

    /* recieve an string with post ids and send back the number
     of likes for each one
     */
    public function updateLikes(Request $request)
    {
        $posts = explode(',', $request->posts);
        $likes = array();
        $user = User::find(auth()->user()->id);
        foreach ($posts as $postId) {
            $post = Post::find($postId);
            if (!$post) continue;
            if ($post->user->id == $user->id || $user->isFriend($post->user->id)) {
                $likes[$postId] = $post->likes;
            }
        }
        return json_encode($likes);
    }

    public function getCommentsView($postId)
    {

        return view('components.comments')->with('post', Post::find($postId));
    }
}
