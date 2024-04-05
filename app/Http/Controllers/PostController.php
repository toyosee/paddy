<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        // $posts = Post::all();
            // Fetch posts with comments in descending order of date and time
        $posts = Post::with(['comments' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])
        ->orderBy('created_at', 'desc')
        ->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'content' => 'required|string',
            // Add more validation rules as needed
        ]);
    
        $post = new Post();
        $post->content = $validatedData['content'];
        // Set other attributes from request

            // Set the user_id to the authenticated user's ID
        $post->user_id = Auth::id();
        $post->save();    

        return redirect('/dashboard')->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        // Validate request data
        
        $validatedData = $request->validate([
            'content' => 'required|string',
            // Add more validation rules as needed
        ]);

        $post->content = $validatedData['content'];
        // Update other attributes from request
        $post->save();    

        return redirect('/dashboard')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/dashboard')->with('success', 'Post deleted successfully.');
    }

    // Section for comment
    public function addComment(Request $request, Post $post)
    {
        // Validate request data
        $validatedData = $request->validate([
            'content' => 'required|string',
            // Add more validation rules as needed
        ]);

        $comment = new Comment();
        $comment->content = $validatedData['content'];
        $comment->user_id = Auth::id();
        $comment->post_id = $post->id;
        $comment->save();

        return redirect('/dashboard')->with('success', 'Comment added successfully.');
    }

    public function editComment(Request $request, Comment $comment)
    {
        // Validate request data
        $validatedData = $request->validate([
            'content' => 'required|string',
            // Add more validation rules as needed
        ]);

        $comment->content = $validatedData['content'];
        $comment->save();    

        return redirect('/dashboard')->with('success', 'Comment updated successfully.');
    }

    public function deleteComment(Comment $comment)
    {
        $postId = $comment->post_id;
        $comment->delete();
        return redirect('/dashboard')->with('success', 'Comment deleted successfully.');
    }
}
