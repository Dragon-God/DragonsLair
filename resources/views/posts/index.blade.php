@extends('_resources.layouts.master')

@section('title')
    Post: {{$post->id}}
@endsection

@section('content')
<?php

?>
    <section class="row posts">
        <div class="col-md-6 col-md-3-offset">
            @include('_resources.includes._post')
        </div>
    </section>
@endsection
