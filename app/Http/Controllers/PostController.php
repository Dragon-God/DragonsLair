<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Post;
use App\models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

/*
*   A controller for making posts.
*/
class PostController extends Controller
{
    public function dashboard()
    {
        $user = DB::table('users')->where('email', Auth::user()->email)->first();     //Extracts the data of the currently logged in user.
        $posts = DB::table('posts')->orderBy('created_at', 'DESC')->get();
        $posts = DB::table('posts')->orderBy('created_at', 'DESC')->paginate(3);
        return view('home.dashboard')->with(['user' => $user, 'posts' => $posts]);
    }
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
