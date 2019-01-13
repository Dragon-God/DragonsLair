@extends('_resources.layouts.master')

@section('title')
    Foo
@endsection

@section('content')
    @if(Session::has('foo'))
        {{Session::get('foo')}}
    @endif
@endsection
