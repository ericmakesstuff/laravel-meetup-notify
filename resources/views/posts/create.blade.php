@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Create Post
                </div>
                <div class="panel-body">
                    <form action="{{ route('posts.store') }}" method="post">
                        <div class="form-group">
                            <label for="postTitle">Post Title</label>
                            <input type="text" name="title" class="form-control" id="postTitle" placeholder="Post Title">
                        </div>
                        <div class="form-group">
                            <label for="postBody">Post Body</label>
                            <textarea name="body" class="form-control" id="postBody" placeholder="Post Body" rows="6"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Create Post</button>
                        {!! csrf_field() !!}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
