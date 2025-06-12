<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Cart;
use Gloudemans\Shoppingcart\Facades\Cart;

class CustomLoginController extends Controller
{
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

public function login(Request $request)
{
    // Validasi input login
    $request->validate([
        'Email' => 'required|email',
        'Password' => 'required',
    ], [
        'Email.required' => 'Email wajib diisi.',
        'Email.email' => 'Format email tidak valid.',
        'Password.required' => 'Password wajib diisi.',
    ]);

    $email = $request->Email;
    $password = $request->Password;

    // Cek login sebagai Admin
    $admin = Admin::where('Email', $email)->first();
    if ($admin && Hash::check($password, $admin->Password)) {
        // Login Admin
        Auth::guard('admin')->login($admin);
        return redirect()->route('admin.homepage');
    }

    // Cek login sebagai Customer
    $customer = Customer::where('Email', $email)->first();
    if ($customer && Hash::check($password, $customer->Password)) {
        // Login Customer
        Auth::guard('customer')->login($customer);

        // Cek apakah ada produk yang tersimpan di session (pending_cart)
        if (session()->has('pending_cart')) {
            // Ambil data produk dari session
            $pending = session()->get('pending_cart');
            $userId = $customer->id;

            // Cek apakah produk sudah ada di keranjang
            $cartItem = Cart::where('UserId', $userId)
                ->where('ProductId', $pending['ProductId'])
                ->where('Size', $pending['Size'])
                ->first();

            // Jika produk sudah ada di keranjang, update jumlah
            if ($cartItem) {
                $cartItem->Quantity += $pending['Quantity'];
                $cartItem->save();
            } else {
                // Jika produk belum ada di keranjang, buat entri baru
                Cart::create([
                    'UserId' => $userId,
                    'ProductId' => $pending['ProductId'],
                    'Quantity' => $pending['Quantity'],
                    'Size' => $pending['Size'],
                ]);
            }

            // Hapus data pending_cart setelah ditambahkan ke keranjang
            session()->forget('pending_cart');
            return redirect()->route('customer.cart')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
        }

        // Jika tidak ada produk pending, redirect ke halaman home customer
        return redirect()->route('homeCustomer');
    }

    // Jika login gagal, tampilkan pesan error
    return back()->with('error', 'Email dan password tidak ditemukan, harap registrasi terlebih dahulu.');
}



    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:customers,Email',
            'password' => 'required|string|confirmed|min:6',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid. Pastikan menggunakan "@" dan domain yang benar.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'email.unique' => 'Email ini sudah terdaftar. Silakan gunakan email lain.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'password.min' => 'Password minimal harus terdiri dari 6 karakter.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Registrasi gagal. Periksa kembali data yang diisi.');
        }
    
        customer::create([
            'CustomerName' => $request->name,
            'Email' => $request->email,
            'Password' => Hash::make($request->password),
        ]);
    
        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function showForgotPasswordForm(): View
    {
        return view('auth.lupapassword');
    }

    public function handleForgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $email = $request->email;
    
        // Cari customer berdasarkan email
        $customer = customer::where('Email', $email)->first();
        if (!$customer) {
            return back()->with('error', 'Email tidak ditemukan.');
        }
    
        // Generate OTP
        $otp = random_int(100000, 999999);
    
        // Gunakan tabel dengan nama sesuai migration
        DB::table('passwordresets')->updateOrInsert(
            ['Email' => $email],  // Menggunakan nama kolom yang benar
            ['Otp' => $otp, 'CreatedAt' => now()]  // Menyesuaikan dengan kolom di tabel
        );
    
        // Kirim email berisi OTP
        Mail::html("Kode OTP Anda untuk reset password adalah: <b>$otp</b>", function ($message) use ($email) {
            $message->to($email)
                    ->subject('Kode OTP Reset Password')
                    ->from('siahaanhizkia06@gmail.com', 'Laporan password');
        });
        
    
        return redirect()->route('otp.form')->with('email', $email);
    }    

    public function showOTPForm()
    {
        return view('auth.formotp');
    }    

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric',
        ]);
    
        // Ambil record berdasarkan email yang diberikan
        $record = DB::table('passwordresets')->where('Email', $request->email)->first();
    
        // Cek apakah record ditemukan dan OTP cocok
        if (!$record || $record->Otp != $request->otp) {
            return back()->with('error', 'Kode OTP tidak valid.');
        }
    
        return redirect()->route('reset.password.form')->with('reset_email', $request->email);
    }    
    

    public function showResetPasswordForm()
    {
        return view('auth.resetpassword');
    }    

    public function submitNewPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);
    
        // Cari customer berdasarkan email
        $customer = Customer::where('Email', $request->email)->first();
        if (!$customer) {
            return back()->with('error', 'Email tidak ditemukan.');
        }
    
        // Update password customer
        $customer->Password = Hash::make($request->password);
        $customer->save();
    
        // Hapus record OTP setelah password di-reset
        DB::table('passwordresets')->where('Email', $request->email)->delete();
    
        return redirect()->route('login')->with('success', 'Password berhasil direset.');
    }    
}    