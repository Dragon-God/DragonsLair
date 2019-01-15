@extends('_resources.layouts.master')

@section('title')
    Post: {{$post->id}}
@endsection

@section('content')
    <section class="row posts">
        <div class="col-md-6 col-md-3-offset">
            @include('_resources.includes._post')
        </div>
        @include('_resources.includes._editPostModal')
    </section>
@endsection
