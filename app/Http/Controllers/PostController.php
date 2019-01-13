<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Post;
//use App\models\User;

/*
*   A controller for making posts.
*/
class PostController extends Controller
{
    //Validations
    public function createPost(Request $request)
    {
        $this->validate($request,
        [
            'body' => 'required|min:3|max:3000'
        ]);
        $post = new Post($request['body']);
        $request->user()->posts()->save($post);
        return redirect()->route('postSuccess');
    }
}
