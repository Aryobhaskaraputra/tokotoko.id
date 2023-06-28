<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function indexforgot()
    {
        return view('forgotpassword');
    }
    public function confirmEmail(Request $req){
        $email = User::where("email", "=", $req->email)->first();

        if($email != NULL){
            return view('changePassword', compact('email'));
        }else{
            return redirect()->back()->withErrors(['Email is not Exists!']);
        }
    }
    public function updatePassword(Request $req){
        $req->validate([
            'new_pass' => 'required|min:5|max:20',
        ]);

        try{
            User::where('email', '=', $req->email_id)->update([
                'password' => Hash::make($req->new_pass)
            ]);
        } catch(QueryException){
            return redirect()->back()->withErrors(['Something went wrong']);
        }

        return redirect('/login')->with('success', 'Password Reset Success!');
    }
}
