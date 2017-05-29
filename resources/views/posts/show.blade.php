@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="pull-right"><em>By {{ $post->author->name }} on {{ $post->created_at->toFormattedDateString() }}</em></div>
                    {{ $post->title }}
                </div>
                <div class="panel-body">
                    {!! nl2br($post->body) !!}
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4>Comments</h4>
                </div>
            </div>
            @foreach($post->comments as $comment)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $comment->user->name }} said on {{ $comment->created_at->toFormattedDateString() }}
                    </div>
                    <div class="panel-body">
                        {!! nl2br($comment->body) !!}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
