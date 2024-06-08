<?php

namespace App\Http\Controllers\api;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    // get Comments
    public function getComments(Request $request)
    {
        $comments = Comment::where('post_id', $request->postId)->get();
        return response()->json(['comments'=>$comments]);
    }


    // create comment
    public function createComment(Request $request)
    {
        // logger($request->all());
        $comment = Comment::create([
            "user_id" => $request->user_id,
            "post_id" => $request->post_id,
            "description" => $request->post_comment
        ]);


        return response()->json(['comment'=>$comment, 'status'=>200]);
    }
}
