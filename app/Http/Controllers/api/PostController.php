<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // post list page
    public function postList()
    {
        $posts = Post::get();
        return response()->json([
            'message' => 'success',
            'posts' => $posts,
        ]);
    }

    // post details
    public function postDetails(Request $request)
    {
        $post = Post::where('id', $request->postId)->first();
        if (empty($post)) {
            return response()->json(['post'=>null]);
        }
        return response()->json([
                'post' => $post,
                'status' => '200'
            ]);



        // $post = Post::where('id', $id)->first();
        // return response()->json([
        //     'post' => $post,
        // ]);
    }

    // search post
    public function searchPost(Request $request)
    {
        // $request->key is from vue
        $posts = Post::where('title', 'like', '%' . $request->key . '%')
            ->orwhere('description', 'like', '%' . $request->key . '%')->get();

        return response()->json([
            'posts' => $posts,
            'message' => 'success',
        ]);
    }
}
