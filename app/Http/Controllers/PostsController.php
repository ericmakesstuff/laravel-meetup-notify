<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        auth()->user()->posts()->save(new Post($request->only('title', 'body')));

        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if (auth()->user()) {
            auth()->user()->notifications
                ->filter(function ($notification) use ($post) {
                    return $notification->data['post_id'] == $post->id;
                })
                ->each(function ($notification) {
                    // $notification->markAsRead();
                    $notification->delete();
                });
        }

        return view('posts.show', compact('post'));
    }
}
