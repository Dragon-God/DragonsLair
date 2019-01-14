{{-- The post template that is used to present all posts on the site. --}}
<?php
    use App\models\User;
    use App\models\Post;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
?>

<article class="post">
    <p>
        {{$post->body}}
    </p>
    <div class="info">
<?php
    $postAuthor = DB::table('users')->where('id', $post->user_id)->first();
?>
        Posted by {{$postAuthor->userName}} on {{$post->created_at}}.
    </div>
    <div class="interaction">
        <form action="{{route('deletePost', ['postID' => $post->id])}}" method="post">
            <a href="posts/{{$post->id}}">&nbsp;&nbsp;&nbsp;Permalink</a> |
            <a href="#">&nbsp;&nbsp;&nbsp;Like</a> |
            <a href="#">&nbsp;&nbsp;&nbsp;Disike</a> |
            @if(Auth::user()->id == $post->user_id)
                <a href="{{route('deletePost', ['postID' => $post->id])}}">&nbsp;&nbsp;&nbsp;Edit</a> |
                <button type="submit" class="btn btn-link">Delete</button>
                <input type="hidden" name="_token" value={{Session::token()}}>
                {{-- <a href="/posts/deletePost/{{$post->id}}">Delete</a> --}}
            @endif
        </form>
    </div>
</article>
