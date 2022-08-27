<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
        $this->middleware('auth' /*->except(['index'])*/);
    }

    public function index()
    {
        $posts = Post::latest()
            ->with('user', 'likes', 'comments')
            ->paginate(5);

        // dd($posts[0]->comments[0]);
        return view('home', [
            "posts" => $posts,
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.post', [
            "post" => $post,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => ['required', 'min:1'],
        ]);

        $request
            ->user()
            ->posts()
            ->create($request->only('body'));

        return back();
    }

    public function destroy(Post $post)
    {
        if (Gate::forUser(auth()->user())->allows('delete_post', $post)) {
            $post->delete();
        }

        return redirect('/');
    }

    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'body' => ['required'],
        ]);

        if (Gate::forUser(auth()->user())->allows('update_post', $post)) {
            $post->update();
        }

        $post->update($request->only('body'));

        return redirect('/post/' . $post->id);
    }
}
