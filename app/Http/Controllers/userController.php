<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userController extends Controller
{

    public function show()
    {

        return view('profile');
    }
}
