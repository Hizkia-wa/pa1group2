<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
            return redirect()->route('homeCustomer');
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

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
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

    public function showOTPForm()
    {
        return view('auth.formotp'); // Pastikan kamu memiliki file otp.blade.php
    }

    public function showResetPasswordForm()
    {
        return view('auth.resetpassword'); // Pastikan kamu memiliki file otp.blade.php
    }

    public function handleForgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $email = $request->email;
        $customer = Customer::where('Email', $email)->first();
        
        if (!$customer) {
            return back()->with('error', 'Email tidak ditemukan');
        }
    
        $otp = random_int(100000, 999999); // OTP 6 digit
    
        DB::table('password_resets')->updateOrInsert(
            ['email' => $email],
            ['otp' => $otp, 'created_at' => now()]
        );
    
        // Kirim ke email
        Mail::raw("Kode OTP Anda untuk reset password adalah: $otp", function ($message) use ($email) {
            $message->to($email)->subject('Kode OTP Reset Password');
        });
    
        // Set session email untuk digunakan di halaman OTP
        return redirect()->route('otp.form')->with('email', $email);
    }    

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric',
        ]);
    
        $email = $request->email;
        $otp = $request->otp;
    
        // Cek apakah OTP sesuai dengan yang ada di database
        $record = DB::table('password_resets')->where('email', $email)->first();
    
        if (!$record || $record->otp != $otp) {
            return back()->with('error', 'Kode OTP tidak valid');
        }
    
        // OTP valid, arahkan ke halaman reset password
        return redirect()->route('reset.password.form')->with('reset_email', $email);
    }    

    public function submitNewPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
            'email' => 'required|email'
        ]);
    
        $Customer = Customer::where('email', $request->email)->first();
    
        if (!$Customer) {
            return back()->with('error', 'Email tidak ditemukan.');
        }
    
        $Customer->password = Hash::make($request->password);
        $Customer->save();
    
        session()->forget('reset_email');
    
        return redirect()->route('login')->with('success', 'Password berhasil direset.');
    }      
}
