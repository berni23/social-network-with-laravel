<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;
use DateTime;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class postController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */

    public function new()
    {
        return view('newPost');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

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
     * Display the  resources.
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
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
}
