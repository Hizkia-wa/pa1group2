<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Gita ULOS - Registrasi</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #F3E9DC;
    }

    .main-container {
      display: flex;
      flex-direction: row;
      min-height: 100vh;
      flex-wrap: wrap;
    }

    .left-side, .right-side {
      flex: 1 1 50%;
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .left-side {
      background: linear-gradient(to bottom right, #F3E9DC, #EBD5B3);
      text-align: center;
      color: #6B4226;
    }

    .left-side h1 {
      font-size: 32px;
      font-weight: 900;
      margin-bottom: 20px;
    }

    .left-side p {
      font-size: 16px;
      margin-bottom: 25px;
      max-width: 90%;
      color: #5a3820;
    }

    .left-side img {
      max-width: 80%;
      height: auto;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .right-side {
      background-color: #6B4226;
      color: white;
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

    .register-box {
      width: 100%;
      max-width: 400px;
      background-color: rgba(255,255,255,0.05);
      padding: 25px;
      border-radius: 12px;
    }

    .register-box h2 {
      text-align: center;
      font-size: 28px;
      color: #DAA520;
      margin-bottom: 20px;
      font-weight: 700;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group input {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 10px;
      background-color: #fff;
      color: #2C3E50;
      font-size: 14px;
    }

    .form-group input::placeholder {
      color: #888;
    }

    .form-group input:focus {
      outline: none;
      border: 2px solid #DAA520;
    }

    .btn-primary {
      background-color: #DAA520;
      border: none;
      width: 100%;
      padding: 12px;
      font-weight: bold;
      border-radius: 12px;
      font-size: 16px;
      color: white;
      transition: background 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #b48a1b;
    }

    .login-link {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }

    .login-link a {
      color: #FFD700;
      font-weight: bold;
      text-decoration: none;
    }

    .login-link a:hover {
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .main-container {
        flex-direction: column;
      }

      .left-side, .right-side {
        flex: 1 1 100%;
        padding: 30px 20px;
      }

      .left-side h1 {
        font-size: 24px;
      }

      .left-side p {
        font-size: 14px;
      }

      .register-box {
        max-width: 100%;
        padding: 20px;
      }

      .register-box h2 {
        font-size: 24px;
      }
    }
  </style>
</head>
<body>
  <div class="main-container">
    <div class="left-side">
      <h1>SELAMAT DATANG DI<br>GITA ULOS</h1>
      <p>Website penjualan ulos batak dengan bahan terbaik, hasil karya pengrajin lokal.</p>
      <img src="{{ asset('img/ulos/logogita.png') }}" alt="Rumah Adat">
    </div>

    <div class="right-side">
      <div class="logo">
        <img src="{{ asset('img/ulos/logogita.png') }}" alt="Logo Gita Ulos">
      </div>
      <div class="register-box">
        <h2>Register</h2>
        @if (session('error'))
          <div class="alert alert-danger text-center">
            {{ session('error') }}
          </div>
        @endif

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('register.submit') }}">
          @csrf
          <div class="form-group">
            <input id="name" type="text" name="name" value="{{ old('name') }}" required placeholder="Masukkan Nama">
          </div>
          <div class="form-group">
            <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="Masukkan Email">
          </div>
          <div class="form-group">
            <input id="password" type="password" name="password" required placeholder="Masukkan Password">
          </div>
          <div class="form-group">
            <input id="password-confirm" type="password" name="password_confirmation" required placeholder="Ulangi Password">
          </div>
          <button type="submit" class="btn btn-primary">Registrasi</button>
        </form>

        <div class="login-link">
          Sudah punya akun? <a href="{{ route('login') }}">Login</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
