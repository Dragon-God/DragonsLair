@extends('_resources.layouts.master')

@section('title')
    Dashboard
@endsection

@section('content')
<?php
    use App\models\User;
    use Illuminate\Support\Facades\DB;
    use App\models\Post;
?>
    <h1>Dashboard</h1>
    <h2>Welcome {{$user->userName}}</h2>
<?php
    $errs = $errors->all();
?>
    @if ($errs != [])
        <div class="row">
            <div class="col-md-4 col-md-offset-4 error">
                <ul>
                    @foreach ($errs as $err)
                        <li>
                            @switch($err)
                                @case('validation.required')
                                    Sorry, the post body cannot be empty.
                                    @break
                                @case('validation.min.string')
                                    Sorry, your post cannot be less than 3 characters.
                                    @break
                                @case('validation.max.string')
                                    Sorry, your post cannot be more than 3000 characters.
                                @break
                                @default
                                    {{$err}}
                                    @break
                            @endswitch
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif


    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header>
                <h3>What do you have to say?</h3>
                <form action="{{route('post.create')}}" method="POST">
                    <div class="form-group {{($errs != [])?'has-error':''}}">
                        <textarea class="form-control" name="body" id="new-post" rows="5" placeholder="Your Post" value=""></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Post</button>
                    <input type="hidden" name="_token" value="{{Session::token()}}">
                </form>
            </header>
        </div>
    </section>
    <section class="row posts">
        <div class="col-md-6 col-md-3-offset">
            <header>
                <h3>What other people are saying...</h3>
            </header>
            @forelse ($posts as $post)
                @include('_resources.includes._post')
            @empty
                <p>
                    Sorry, there are no posts to display.
                </p>
            @endforelse
            {!!$posts->links('_resources.vendor.pagination.bootstrap-4')!!}
        </div>
    </section>
@endsection
