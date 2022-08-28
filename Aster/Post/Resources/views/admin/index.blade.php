@extends('admin::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This is posts page. This view is loaded from module: {!! config('post.name') !!}
    </p>
@endsection
