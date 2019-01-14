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
    public function deletePost($postID)
    {
        if((DB::table('posts')->where('id', $postID)->value('user_id')) == (Auth::user()->id))  //Chceks if the current user is the owner of the post.
        {

        }
    }
    public function index($postID)
    {
        return view('posts.index', ['post' => DB::table('posts')->where('id', $postID)->first()]);
    }
    public function getPost()
    {
        return $this->index($_POST['postID']);
    }
}
