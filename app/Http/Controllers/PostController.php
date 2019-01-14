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
        return redirect()->route('dashboard');
    }
    public function deletePost($postID)
    {
        /* if(DB::table('posts')->where('id', $postID)->value('user_id') == (Auth::user()->id))
        {
            DB::table('posts')->where('id', $postID)->delete();
            return redirect()->route('deleteSuccess');
        } */
        if(Post::where('id', $postID)->value('user_id') == (Auth::user()->id))
        {
            $postToDelete = Post::where('id', $postID)->first();
            $postToDelete->delete();
            return redirect()->route('postDeleteSuccess');
        }
        else
        {
            return redirect()->route('wrongPermissions');
        }
    }
    public function editPost($postID)
    {
        if (Post::where('id', $postID)->value('user_id') == (Auth::user()->id))
        {
            $postToEdit = Post::where('id', $postID)->first();
            $postToEdit->delete();
            return redirect()->route('deleteSuccess');
        } else {
            return redirect()->route('wrongPermissions');
        }
    }
    public function indexes($postID)
    {
        return view('posts.getPost', ['post' => DB::table('posts')->where('id', $postID)->first()]);
    }
    public function getPost()
    {
        return $this->indexes($_POST['getPostID']);
    }
}
