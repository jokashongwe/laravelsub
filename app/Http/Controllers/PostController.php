<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Show the posts for a given user.
     */
    public function show(string $id)
    {
        return response()->json(Post::findOrFail($id));
    }

    /**
     * Show the posts for a given user.
     */
    public function all()
    {
        return response()->json(Post::all());
    }

    /**
     * Show the posts for a given user.
     */
    public function new(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:200',
            'content' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $Post = Post::create($validator->validated());
        return response()->json([
            'message' => 'Post successfully registered',
            'Post' => $Post
        ], 201);
    }
}
