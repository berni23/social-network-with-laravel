<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class commentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $this->validateComment($request);
        if ($validation->fails()) {
            return redirect('/home')
                ->with('post_id', $request->post_id)
                ->withErrors($validation);
        } else {
            $comment = new Comment;
            $comment->post_id = $request->post_id;
            $comment->content = $request->content;
            $comment->user_id = auth()->user()->id;
            return $comment->saveComment();
        }
    }
    private function validateComment(Request $request)
    {
        return Validator::make($request->all(), [
            'content' => 'required',

        ]);
    }
}
