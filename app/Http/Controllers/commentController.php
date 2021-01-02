<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Doctrine\DBAL\Query\QueryException;

class commentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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

            try {
                $comment->save();
            } catch (QueryException $ex) {
                return redirect()->back()
                    ->with('message', 'failed to update data')
                    ->with('status', 400);
            }
            return redirect()->back()->with('message', 'comment added')->with('status', 200);
        }
    }

    private function validateComment(Request $request)
    {
        return Validator::make($request->all(), [
            'content' => 'required',

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
