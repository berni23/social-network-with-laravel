<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class postController extends Controller
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

    public function new()
    {
        return view('newPost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        if ($request->hasFile('image'))
            $post->image  = Storage::putFile('posts', $request->file('image'));


        echo json_encode($request->image);
        //return redirect('/home');
    }
    private function validatePost(Request $request)
    {

        return Validator::make($request->all(), [
            'image' => 'max:507',

            //mimes:jpeg,png|
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
