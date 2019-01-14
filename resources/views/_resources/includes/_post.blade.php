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
        <a href="posts/{{$post->id}}">Permalink</a> |
        <a href="#">Like</a> |
        <a href="#">Disike</a> |
        @if(Auth::user()->id == $post->user_id)
            <a href="{{route('deletePost', ['postID' => $post->id])}}">Edit</a> |
            {{-- <form action="delete"></form> --}}
            <a href="/posts/deletePost/{{$post->id}}">Delete</a>
        @endif
    </div>
</article>
