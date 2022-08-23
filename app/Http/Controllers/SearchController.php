<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => ['required'],
        ]);

        $search = $request->search;

        $posts = Post::where('body', 'LIKE', '%' . $search . '%')->get();
        $users = User::where('first_name', 'LIKE', '%' . $search . '%')
            ->whereOr('last_name', 'LIKE', '%' . $search . '%')
            ->whereOr('username', 'LIKE', '%' . $search . '%')
            ->get();

        return view('search', [
            'posts' => $posts,
            'users' => $users,
            'search' => $search,
        ]);
    }
}
