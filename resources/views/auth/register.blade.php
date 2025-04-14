<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gita ULOS - Registrasi</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }

    .container {
      display: flex;
      width: 100%;
      max-width: 1000px;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }

    .left-side {
      background-color: #d1f3f0;
      padding: 40px;
      flex: 1;
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .left-side h1 {
      font-size: 28px;
      font-weight: 900;
      margin-bottom: 15px;
      color: #000;
    }

    .left-side p {
      font-size: 14px;
      color: #333;
      margin-bottom: 30px;
      max-width: 90%;
    }

    .left-side img {
      max-width: 65%;
    }

    .right-side {
      background-color: #000;
      color: white;
      padding: 40px;
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      border-radius: 0 20px 20px 0;
    }

    .logo-container {
      margin-bottom: 20px;
    }

    .logo {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      overflow: hidden;
      border: 3px solid white;
    }

    .logo img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .register-form {
      width: 100%;
      max-width: 350px;
    }

    .register-form h2 {
      text-align: center;
      font-size: 36px;
      margin-bottom: 30px;
      font-weight: 600;
      letter-spacing: 2px;
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
      color: #000;
      font-size: 14px;
    }

    .form-group input::placeholder {
      color: #888;
    }

    .form-group input:focus {
      outline: none;
      border: 2px solid #007bff;
    }

    .btn-primary {
      background-color: #0d6efd;
      border: none;
      width: 100%;
      padding: 12px;
      font-weight: bold;
      border-radius: 12px;
      font-size: 16px;
    }

    .btn-primary:hover {
      background-color: #084eb1;
    }

    .login-link {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }

    .login-link a {
      color: #00e676;
      font-weight: bold;
      text-decoration: none;
    }

    .login-link a:hover {
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        border-radius: 0;
      }

      .left-side, .right-side {
        border-radius: 0;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="left-side">
      <h1>SELAMAT DATANG DI<br>GITA ULOS</h1>
      <p>Sebuah website penjualan ulos batak dengan bahan ulos terbaik dengan produksi asli warga lokal</p>
      <img src="{{ asset('img/rumah.jpeg') }}" alt="Gambar Rumah Ulos">
    </div>
    <div class="right-side">
      <div class="logo-container">
        <div class="logo">
          <img src="{{ asset('img/logo.png') }}" alt="Logo Gita Ulos">
        </div>
      </div>
      <div class="register-form">
        <h2>Register</h2>
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
            <input id="password-confirm" type="password" name="password_confirmation" required placeholder="Masukkan Ulang Password">
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
