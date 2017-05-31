<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/posts/new', 'PostsController@create')->name('posts.create');
Route::post('/posts/new', 'PostsController@store')->name('posts.store');
Route::get('/posts/{post}', 'PostsController@show')->name('posts.view');

Route::post('/comments/{post}/new', 'CommentsController@store')->name('comments.store');

Route::get('/api/user/notifications', function() {
    if (!($user = auth()->user())) {
        return [
            'unread_notification_count' => 0,
            'notification_count' => 0,
            'notifications' => [],
        ];
    }

    return [
        'unread_notification_count' => $user->unreadNotifications()->count(),
        'notification_count' => $user->notifications()->count(),
        'notifications' => $user->notifications->map(function ($notification) {
            return [
                'post_id'    => $notification->data['post_id'],
                'post_title' => $notification->data['post_title'],
                'user'       => $notification->data['user'],
                'comment'    => $notification->data['comment'],
            ];
        })->take(5),
    ];
});
