<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Gita Ulos</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }
        .container {
            display: flex;
            height: 100vh;
        }
        .left {
            flex: 1;
            background-color: #D6FCF4;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
        }
        .left h1 {
            font-size: 2em;
            text-align: center;
        }
        .left p {
            text-align: center;
            margin-top: 10px;
        }
        .right {
            flex: 1;
            background-color: #000;
            color: #fff;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-top-right-radius: 30px;
            border-bottom-right-radius: 30px;
        }
        .logo {
            width: 120px;
            margin-bottom: 20px;
        }
        .right h2 {
            margin-bottom: 10px;
        }
        .form-group {
            margin-top: 20px;
            width: 100%;
            max-width: 300px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: none;
        }
        .form-group button {
            margin-top: 20px;
            width: 100%;
            padding: 10px;
            background-color: #1e50ff;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
        .success {
            color: green;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left">
            <h1>SELAMAT DATANG DI<br>GITA ULOS</h1>
            <p>Sebuah website penjualan ulos batak dengan bahan ulos terbaik dengan produksi asli warga lokal</p>
            <img src="{{ asset('assets/gambar/rumahadat.png') }}" alt="Rumah Adat" width="200">
        </div>
        <div class="right">
            <img src="{{ asset('assets/gambar/logo.png') }}" alt="Logo" class="logo">
            <h2>Lupa Password</h2>
            <p>Silakan untuk memasukkan email yang anda gunakan</p>
            <form action="{{ route('forgot.password.send') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label><br>
                    <input type="email" name="email" placeholder="Masukkan email" required>
                    @if(session('error'))
                        <div class="error">{{ session('error') }}</div>
                    @endif
                    @if(session('success'))
                        <div class="success">{{ session('success') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" {{ session('locked') ? 'disabled' : '' }}>Kirim</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
