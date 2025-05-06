<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - Gita Ulos</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
        }

        .container {
            display: flex;
            min-height: 100vh;
            flex-wrap: wrap;
        }

        .left, .right {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .left {
            background-color: #f0e6d6;
            color: #6b4c2a;
        }

        .left h1 {
            font-size: 2.5em;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .left p {
            max-width: 450px;
            line-height: 1.6;
            margin-bottom: 30px;
            font-size: 1.1em;
        }

        .logo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid #DAA520;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .rumah-adat {
            width: 200px;
            margin-top: 20px;
            filter: drop-shadow(0 5px 15px rgba(0,0,0,0.1));
        }

        .right {
            background-color: #6b4c2a;
            color: #fff;
        }

        .right h2 {
            font-size: 2em;
            margin-bottom: 15px;
            color: #e3b341;
            font-weight: 600;
        }

        .right p {
            margin-bottom: 30px;
            max-width: 300px;
            line-height: 1.5;
        }

        .form-group {
            margin-top: 20px;
            width: 100%;
            max-width: 350px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.9em;
            color: #e3b341;
            text-align: left;
        }

        .form-group input {
            width: 100%;
            padding: 15px;
            border-radius: 8px;
            border: none;
            background-color: #f7f7f7;
            font-size: 1em;
        }

        .form-group button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background-color: #e3b341;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 700;
            font-size: 1.1em;
            transition: all 0.3s ease;
        }

        .form-group button:hover {
            background-color: #d9a730;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(227, 179, 65, 0.3);
        }

        .alert {
            margin-top: 15px;
            font-size: 0.9em;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }

        .alert-danger {
            background-color: #ff6b6b;
            color: white;
        }

        .back-link {
            margin-top: 20px;
            color: #e3b341;
            text-decoration: none;
            font-size: 0.9em;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .left, .right {
                width: 100%;
                padding: 30px 20px;
            }

            .left h1 {
                font-size: 1.8em;
            }

            .left p {
                font-size: 0.95em;
            }

            .rumah-adat {
                width: 150px;
            }

            .right h2 {
                font-size: 1.6em;
            }

            .right p {
                font-size: 0.95em;
            }

            .form-group input,
            .form-group button {
                font-size: 0.95em;
                padding: 12px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="left">
        <h1>SELAMAT DATANG DI<br>GITA ULOS</h1>
        <p>Sebuah website penjualan ulos Batak dengan bahan terbaik dan produksi asli warga lokal.</p>
        <img src="{{ asset('img/ulos/logogita.png') }}" alt="Rumah Adat" class="rumah-adat">
    </div>
    <div class="right">
    <div class="logo">
        <img src="{{ asset('img/ulos/logogita.png') }}" alt="Logo Gita Ulos">
      </div>
        <h2>Verifikasi OTP</h2>
        <p>Masukkan kode OTP yang telah Anda terima melalui email.</p>
        <form method="POST" action="{{ route('otp.verify') }}">
            @csrf
            <input type="hidden" name="email" value="{{ session('email') }}">
            <div class="form-group">
                <label for="otp">Kode OTP</label>
                <input type="text" name="otp" id="otp" required>
            </div>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="form-group">
                <button type="submit">Verifikasi</button>
            </div>
        </form>
        <a href="{{ route('forgot.password') }}" class="back-link">Kembali ke halaman lupa password</a>
    </div>
</div>
</body>
</html>
