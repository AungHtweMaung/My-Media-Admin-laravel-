<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // category list
    public function categoryList()
    {
        $categories = Category::get();
        return response()->json(['categories' => $categories]);
    }

    // filtering posts with category
    public function searchCategory(Request $request)
    {

        // if ($request->key != '') {
        //     $posts = Post::where('category_id', $request->key)->get();
        //     logger($posts);
        // } else {
        //     $posts = Post::get();
        // }

        // table join လို့ match ဖြစ်တဲ့ record တွေထဲကမှ category title နဲ့တူတဲ့ post တွေကို ပြတာ
        $posts = Category::select('posts.*')
            ->join('posts', 'posts.category_id', 'categories.id')
            ->where('categories.title', 'like', '%' . $request->key . '%')
            ->get();

        // logger($posts);

        return response()->json([
            'posts' => $posts,
        ]);
    }
}
