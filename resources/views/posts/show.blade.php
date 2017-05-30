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

            @if($post->comments()->count())
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4>Comments</h4>
                    </div>
                </div>
                @foreach($post->comments()->latest()->get() as $comment)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{ $comment->user->name }} said on {{ $comment->created_at->toFormattedDateString() }}
                        </div>
                        <div class="panel-body">
                            {!! nl2br($comment->body) !!}
                        </div>
                    </div>
                @endforeach
            @endif

            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4>Submit a Comment</h4>
                </div>
                <div class="panel-body">
                    <form action="{{ route('comments.store', $post) }}" method="post">
                        <div class="form-group">
                            <label for="postBody">Your Comment</label>
                            <textarea name="body" class="form-control" id="postBody" placeholder="Comment" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Submit Comment</button>
                        {!! csrf_field() !!}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
