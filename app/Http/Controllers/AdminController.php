<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('admin.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return back()->with('status', 'Password berhasil diubah!');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/login');
    }
}
