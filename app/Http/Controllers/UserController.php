<?php

namespace App\Http\Controllers;

use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function usermanagementindex()
    {
        $userm = User::all();
        return view('admin.usermanagement', compact('userm'));
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        Alert::success('Congrats', 'User has been delete!');
        return redirect()->back();
    }
}
