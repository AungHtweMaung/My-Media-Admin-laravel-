<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    // direct login page
    public function loginPage() {
        return view('auth.login');
    }

    // public function registerPage(){
    //     return view("auth.register");
    // }

    // register
    public function register(Request $request)
    {
        // fields can't be blank
        if ($request->name == "" || $request->email == "" || $request->password == "") {
            return response()->json(["error_message" => "Username, email, password can't be blank!"]);
        }

        // check user email already exist or not
        $user_email = User::where('email', $request->email)->first();
        if (isset($user_email)) {
            return response()->json(["error_message" => "email already exists"]);
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ];

        // creating user in db
        User::create($data);

        $user = User::where('email', $request->email)->first();

        return response()->json([
            'user' => $user,
            'token' => $user->createToken(time())->plainTextToken
        ]);
    }


    // login
    public function login(Request $request)
    {
        // check fields are blank or not
        if (
            ($request->email != "" && $request->password != '')
            && ($request->email != null && $request->password != null)
        ) {
            $user = User::where('email', $request->email)->first();
            // if user exists with requested email, then check password
            if (isset($user)) {
                if (Hash::check($request->password, $user->password)) {
                    return response()->json([
                        'user' => $user,
                        'token' => $user->createToken(time())->plainTextToken
                    ]);
                }
                return response()->json(['user' => null, 'token' => null, 'error_message' => "Email and password doesn't match"]);
            }

            return response()->json(['user' => null, 'token' => null, 'error_message' => "There is no user with this email"]);
        }

        return response()->json(['user' => null, 'token' => null, 'error_message' => "Email and Password require to login"]);
    }

    // categoryList
    public function categoryList()
    {

        return response()->json([
            'token_test' => 'Token is included.',
            'status' => 'ok'
        ]);
    }
}
