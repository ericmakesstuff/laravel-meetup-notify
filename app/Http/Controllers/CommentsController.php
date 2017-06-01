<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Notifications\CommentAddedToPost;
use App\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post, Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);

        $post->comments()->save($comment = new Comment([
            'user_id' => auth()->user()->id,
            'body' => $request->get('body')
        ]));

        $post->author->notify(new CommentAddedToPost($comment));

        return redirect()->back();
    }
}
