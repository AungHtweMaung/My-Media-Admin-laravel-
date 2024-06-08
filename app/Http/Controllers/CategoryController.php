<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // direct category page
    public function index()
    {
        $categories = Category::get();
        // dd($categories);
        return view('admin.category.list', compact('categories'));
    }

    // search category
    public function searchCategory(Request $request)
    {
        $categories = Category::orwhere('title', 'like', '%'. $request->categorySearch.'%')
            ->get();
        return view('admin.category.list', compact('categories'));

    }

    // create category
    public function createCategory(Request $request)
    {
        $validator = $this->checkCategoryValidation($request);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $category = $this->getCategoryData($request);
        Category::create($category);
        return back();
    }

    // category edit page
    public function editCategory($id)
    {
        $categories = Category::get();  // get all categories
        $category = Category::where('id', $id)->firstOrFail(); // get edit category data

        return view('admin.category.edit', compact('category', 'categories'));
    }

    // update category
    public function updateCategory(Request $request, $id)
    {
        $validator = $this->checkCategoryValidation($request);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $categoryUpdateData = [
            'title' => $request->categoryTitle
        ];

        Category::where('id', $id)->update($categoryUpdateData);
        return redirect()->route('admin#category')->with(['updateSuccess' => 'Category updated!']);


    }


    // delete category
    public function deleteCategory($id)
    {
        // $category = Category::findOrFail($id);
        // dd($category);

        Category::where('id', $id)->delete();
        return redirect()->route('admin#category')->with(['deleteSuccess' => 'Category deleted!']);
    }


    // check category validation
    private function checkCategoryValidation($request)
    {
        $validationMessage = [
            'categoryTitle.required' => 'Title is required',
            // 'categoryDescription.required' => 'Description is required'
        ];

        return Validator::make($request->all(), [
            'categoryTitle' => 'required|unique:categories,title,'. $request->category_id,
            // 'categoryDescription' => 'required'
        ], $validationMessage);
    }

    // get category data
    private function getCategoryData($request)
    {
        return [
            'title' => $request->categoryTitle,
            'description' => $request->categoryDescription,

        ];
    }
}
