<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post, Request $request)
    {
        if ($post->likedBy(auth()->user())) {
            return response(null, 409);
        }

        $post->likes()->create(['user_id' => $request->user()->id]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Request $request)
    {
        $request
            ->user()
            ->likes()
            ->where('post_id', $post->id)
            ->delete();

        return back();
    }
}
