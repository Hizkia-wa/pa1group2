<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use App\Models\Admin;
use App\Models\Customer;

class CustomLoginController extends Controller
{
    public function showLoginForm(): View
    {
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'Email' => 'required|email',
            'Password' => 'required',
        ]);
    
        $email = $request->input('Email');
        $password = $request->input('Password');
    
        // Cek ke Admin
        if ($email == 'admingitaulos@gmail.com' && Hash::check($password, '$2y$12$QW76vRDtZ3hGrtOhZDyx4OlrDkIa3gZ2YaTtYyBqH.vIFgz4jsDcq')) {
            // Admin login berhasil, arahkan ke halaman Admin homepage
            Auth::guard('admin')->loginUsingId(1);  // Pastikan ID admin default sesuai
            return redirect()->route('admin.homepage');  // Ganti dengan rute yang sesuai
        }
    
        // Cek ke Customer
        $customer = Customer::where('Email', $email)->first();
        if ($customer && Hash::check($password, $customer->Password)) {
            Auth::guard('web')->login($customer);
            return redirect()->route('home');
        }
    
        return back()->with('error', 'Email atau password salah');
    }

    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers,Email',
            'password' => 'required|string|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        Customer::create([
            'CustomerName' => $request->name,
            'Email' => $request->email,
            'Password' => Hash::make($request->password),
        ]);

        return redirect()->route('login.custom')->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function showLinkRequestForm(): View
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function showForgotPasswordForm(): View
    {
        return view('auth.lupapassword');
    }

    public function handleForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->email;
        $attempts = Cache::get("forgot_attempts_$email", 0);
        $locked = Cache::get("forgot_locked_$email");

        if ($locked) {
            return redirect()->back()->with('error', 'Email anda salah, coba setelah 1 jam')->with('locked', true);
        }

        $customer = Customer::where('Email', $email)->first();

        if (!$customer) {
            $attempts++;
            Cache::put("forgot_attempts_$email", $attempts, 3600); // simpan 1 jam

            if ($attempts >= 2) {
                Cache::put("forgot_locked_$email", true, now()->addHour());
            }

            return redirect()->back()->with('error', 'Email anda salah');
        }

        // Buat password baru
        $newPassword = substr(str_shuffle('abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 8);

        // Simpan password baru ke DB
        $customer->Password = Hash::make($newPassword);
        $customer->save();

        // Kirim via email
        Mail::raw("Password baru Anda adalah: $newPassword", function ($message) use ($email) {
            $message->to($email)->subject('Reset Password - Gita Ulos');
        });

        // Reset percobaan
        Cache::forget("forgot_attempts_$email");
        Cache::forget("forgot_locked_$email");

        return redirect()->back()->with('success', 'Password baru berhasil dikirim ke email Anda.');
    }
}
