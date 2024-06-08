<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ListController extends Controller
{
    // direct admin list
    public function index()
    {
        $users = User::select(
            'id',
            'name',
            'email',
            'phone',
            'address',
            'gender',
            'role',
        )
            ->get();

        // dd($users->toArray());
        return view('admin.list.index', compact('users'));
    }

    // delete account
    public function deleteAccount($id)
    {
        $user = User::findOrFail($id);
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Admin account deleted!']);
    }

    // search admin list
    public function adminListSearch(Request $request)
    {
        $users = User::orwhere('name', 'like', '%' . $request->adminSearchKey . '%')
            ->orwhere('email', 'like', '%' . $request->adminSearchKey . '%')
            ->orwhere('phone', 'like', '%' . $request->adminSearchKey . '%')
            ->orwhere('address', 'like', '%' . $request->adminSearchKey . '%')
            ->orwhere('gender', 'like', '%' . $request->adminSearchKey . '%')
            ->get();
        return view('admin.list.index', compact('users'));
    }
}
