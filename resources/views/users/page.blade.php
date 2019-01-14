@extends('_resources.layouts.master')

@section('title')
    Page of {{$username}}
@endsection

@section('content')
<?php
    use App\models\User;
?>
    <h1>Page of {{$username}}</h1>

    <section class="row posts">
        <div class="col-md-6 col-md-3-offset">
            @forelse ($posts as $post)
                <article class="post">
                    <p>
                        {{$post->body}}
                    </p>
                    <div class="info">
                        Posted by {{$username}} on {{$post->created_at}}.
                    </div>
                    <div class="interaction">
                        <a href="#">Like</a> |
                        <a href="#">Disike</a> |
                        <a href="#">Edit</a> |
                        <a href="#">Delete</a>
                    </div>
                </article>
            @empty
                <h3>Sorry, this user has no posts to display.</h3>
            @endforelse
        </div>
    </section>
@endsection
