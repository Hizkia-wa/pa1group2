<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Gita Ulos</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a2e0e6ad68.js" crossorigin="anonymous"></script>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      width: 100%;
      height: 100%;
      font-family: 'Poppins', sans-serif;
      background-color: #F3E9DC;
    }

    .container {
      display: flex;
      height: 100vh;
      overflow: hidden;
    }

    .left-side {
      flex: 1;
      background: linear-gradient(to bottom right, #F3E9DC, #EBD5B3);
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      color: #6B4226;
    }

    .left-side h1 {
      font-size: 30px;
      font-weight: 900;
      margin-bottom: 15px;
    }

    .left-side p {
      font-size: 15px;
      margin-bottom: 25px;
      max-width: 90%;
      color: #5a3820;
    }

    .left-side img {
      max-width: 70%;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .right-side {
      flex: 1;
      background-color: #6B4226;
      color: white;
      padding: 40px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .logo {
      width: 90px;
      height: 90px;
      margin-bottom: 20px;
      border-radius: 50%;
      border: 3px solid #DAA520;
      overflow: hidden;
    }

    .logo img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .form-box {
      width: 100%;
      max-width: 350px;
    }

    .form-box h2 {
      text-align: center;
      font-size: 32px;
      margin-bottom: 15px;
      font-weight: 700;
      color: #DAA520;
    }

    .form-box p {
      text-align: center;
      font-size: 14px;
      margin-bottom: 25px;
    }

    .form-group {
      margin-bottom: 15px;
      position: relative;
    }

    .form-group input {
      width: 100%;
      padding: 12px 40px 12px 45px;
      border: none;
      border-radius: 10px;
      background-color: #fff;
      font-size: 14px;
      color: #2C3E50;
    }

    .form-group i {
      position: absolute;
      top: 50%;
      left: 15px;
      transform: translateY(-50%);
      font-size: 18px;
      color: #6B4226;
    }

    .btn-login {
      width: 100%;
      background-color: #DAA520;
      border: none;
      border-radius: 12px;
      padding: 12px;
      font-weight: bold;
      font-size: 16px;
      color: white;
      transition: background 0.3s;
    }

    .btn-login:hover {
      background-color: #b48a1b;
    }

    .extra-links {
      font-size: 13px;
      text-align: center;
      margin-top: 15px;
    }

    .extra-links a {
      color: #FFD700;
      text-decoration: none;
      font-weight: bold;
    }

    .extra-links a:hover {
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }

      .left-side, .right-side {
        width: 100%;
        height: auto;
        min-height: 50vh;
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="left-side">
      <h1>SELAMAT DATANG DI<br>GITA ULOS</h1>
      <p>Sebuah website penjualan ulos batak dengan<br>bahan ulos terbaik dengan produksi asli warga lokal</p>
      <img src="{{ asset('img/rumah.jpeg') }}" alt="Rumah Adat">
    </div>
    <div class="right-side">
      <div class="logo">
        <img src="{{ asset('img/logo.png') }}" alt="Logo Gita Ulos">
      </div>
      <div class="form-box">
        <h2>Login</h2>
        <p>Silakan login terlebih dahulu sebelum melakukan pemesanan</p>

        {{-- Flash Message --}}
        @if (session('success'))
          <div class="alert alert-success text-center">
            {{ session('success') }}
          </div>
        @endif

        {{-- Error Login --}}
        @if (session('error'))
          <div class="alert alert-danger text-center">
            {{ session('error') }}
          </div>
        @endif

        {{-- Validation Error --}}
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('login.custom.submit') }}">
          @csrf
          <div class="form-group">
            <i class="fas fa-user"></i>
            <input type="email" name="Email" placeholder="Email" required value="{{ old('Email') }}">
          </div>
          <div class="form-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="Password" placeholder="Sandi" required>
          </div>
          <button type="submit" class="btn-login">Login</button>
        </form>
        <div class="extra-links">
          Belum punya akun? <a href="{{ route('register') }}">Register</a> |
          <a href="{{ route('forgot.password') }}">Lupa password?</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
