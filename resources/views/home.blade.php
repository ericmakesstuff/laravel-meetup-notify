@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach($posts as $post)
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="pull-right"><em>By {{ $post->author->name }} on {{ $post->created_at->toFormattedDateString() }}</em></div>
                        <a href="{{ route('posts.view', $post) }}" style="color: white">{{ $post->title }}</a>
                    </div>
                    <div class="panel-body">
                        {!! nl2br($post->body) !!}
                    </div>
                    <div class="panel-footer"><a href="{{ route('posts.view', $post) }}">Read / Comment</a> - {{ $post->comments()->count() }} Comments</div>
                </div>
            @endforeach

            {!! $posts->render() !!}
        </div>
    </div>
</div>
@endsection
