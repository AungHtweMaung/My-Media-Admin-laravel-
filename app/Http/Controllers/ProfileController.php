<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    // direct admin profile
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::where('id', $id)->first();
        // dd($user);
        return view('admin.profile.index',)->with(['user' => $user]);
    }

    // update admin account
    public function adminUpdateAccount(Request $request)
    {
        $validator = $this->checkAccountValidation($request);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $adminData = $this->getAdminData($request);
        User::where('id', Auth::user()->id)->update($adminData);

        return back()->with([
            "accountUpdateSuccess" => "Admin Account Updated!"
        ]);

        // return redirect()->route('admin#profile')
        //         ->with(["accountUpdateSuccess" => "Admin Account Updated!"]);
    }

    // direct change password page
    public function changePasswordPage()
    {
        return view('admin.profile.changePassword');
    }

    // change password
    public function changePassword(Request $request)
    {
        $validator = $this->checkPasswordValidation($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $dbUser = User::where('id', Auth::user()->id)->first();
        $dbPassword = $dbUser->password;

        if (Hash::check($request->oldPassword, $dbPassword)) {
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword)
            ]);

            return redirect()->route('admin#dashboard');
        }
        return back()->with(['changePasswordFail' => 'Old Password does not match!']);
    }


    // check validation for update accoount
    private function checkAccountValidation($request)
    {
        $validator = Validator::make($request->all(), [
            'adminName' => "required",
            "adminEmail" => "required"
        ]);
        return $validator;
    }

    // get admin account data
    private function getAdminData($request)
    {
        return [
            'name' => $request->adminName,
            'email' => $request->adminEmail,
            'phone' => $request->adminPhone,
            'address' => $request->adminAddress,
            'gender' => $request->adminGender,
        ];
    }

    // check password validation
    private function checkPasswordValidation($request)
    {

        return Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8|max:15',
            'confirmPassword' => 'required|same:newPassword|min:8|max:15',
        ]);
    }
}
