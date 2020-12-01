<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function index() {
        $posts = Post::with('user:id,name')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return PostResource::collection($posts);
    }

    function me() {
        $posts = Auth::user()
            ->posts()
            ->with('user:id,name')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return PostResource::collection($posts);
    }

    function create(Request $request) {
        $validated = $request->validate([
            'content' => 'required|string|max:280'
        ], [], [
            'content' => 'conteúdo'
        ]);
        $post = Auth::user()->posts()->create($validated);
        return new PostResource($post->load('user:id,name'));
    }

    function update($id, Request $request) {
        $validated = $request->validate([
            'content' => 'required|string|max:280'
        ], [], [
            'content' => 'conteúdo'
        ]);
        $post = Auth::user()->posts()->findOrFail($id);
        $post->content = $validated['content'];
        $post->save();
        return new PostResource($post->load('user'));
    }

    function delete($id) {
        $post = Auth::user()->posts()->findOrFail($id);
        $post->delete();
        return response()->json(true);
    }
}
