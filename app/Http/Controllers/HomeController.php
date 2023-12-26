<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with('comments')->orderBy('created_at', 'desc')->paginate(10);

        return view('home', compact('posts'));
    }

    public function storeComment(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|min:5',
        ]);

        $comment = new Comment([
            'content' => $request->content,
            'user_id' => auth()->id(),  // Assuming user authentication is implemented
            'post_id' => $post->id,
        ]);

        $comment->save();

        return redirect()->back()->with('success', 'Comment posted successfully!');
    }
}

