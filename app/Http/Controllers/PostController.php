<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // direct post page
    public function index()
    {
        $categories = Category::get();
        $posts = Post::paginate(3);
        // dd($categories->toArray());
        return view('admin.post.index', compact('categories', 'posts'));
    }

    // create post
    public function create(Request $request)
    {
        // dd($request->all());
        $validator = $this->postValidationCheck($request);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();  // This will repopulate the form fields with the old input
        }

        if ($request->has('postImage')) {
            $image = uniqid() . '_' . $request->postImage->getClientOriginalName();
            $request->file('postImage')->storeAs('public/postImage', $image);
            $data = $this->getPostData($request);
            $data['image'] = $image;
        } else {
            $data = $this->getPostData($request);
        }

        Post::create($data);
        return back();
    }

    // direct edit post page
    public function edit(Request $request, $id)
    {
        $categories = Category::get();
        $posts = Post::get();

        $post = Post::where('id', $id)->firstOrFail();


        return view('admin.post.edit', compact('categories', 'posts', 'post'));
    }

    // update post
    public function updatePost(Request $request, $id)
    {
        $validator = $this->postValidationCheck($request);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $post = Post::where('id', $id)->first();

        if ($request->hasFile('postImage')) {
            // get image from db if requested image exists
            $post = Post::where('id', $id)->first();
            $dbImage = $post->image;
            // delete image from db
            if ($dbImage != null) {
                Storage::delete('public/postImage/'. $dbImage);
            }

            $image = uniqid(). '_'. $request->postImage->getClientOriginalName();
            $request->postImage->storeAs('public/postImage/'. $image);
            $data = $this->getPostData($request);   // prepare data to insert
            $data['image'] = $image;    // insert image name in db

        } else {
            $data = $this->getPostData($request);
        }

        $post->update($data);
        return back();

    }



    // delete post
    public function deletePost($id)
    {
        $post = Post::where('id', $id)->firstOrFail();
        $dbImage = $post->image;
        // dd($dbImage);

        if (File::exists(public_path('storage/postImage/' . $dbImage))) {
            File::delete(public_path('storage/postImage/' . $dbImage));
        }

        DB::table('posts')->where('id', $id)->delete();

        return redirect()->route('admin#post');
    }


    // get post data
    private function getPostData($request)
    {
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'category_id' => $request->postCategoryId
        ];
    }

    // check post validation
    private function postValidationCheck($request)
    {
        return Validator::make($request->all(), [
            'postTitle' => 'required',
            'postDescription' => 'required',
            'postCategoryId' => 'required',
        ]);
    }
}
