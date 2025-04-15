<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Gita Ulos</title>
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
      max-width: 1100px;
      height: auto;
      border-radius: 30px;
      overflow: hidden;
      box-shadow: 0 0 30px rgba(0,0,0,0.15);
    }

    .left-side {
      background-color: #C3F3E7;
      padding: 60px 40px;
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
    }

    .left-side h1 {
      font-size: 32px;
      font-weight: 900;
      margin-bottom: 20px;
      color: #000;
    }

    .left-side p {
      font-size: 15px;
      max-width: 400px;
      margin-bottom: 30px;
    }

    .left-side img {
      width: 60%;
    }

    .right-side {
      background-color: black;
      color: #fff;
      flex: 1;
      padding: 50px 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .logo {
      width: 100px;
      height: 100px;
      margin-bottom: 20px;
    }

    .form-box {
      width: 100%;
      max-width: 360px;
      background: transparent;
    }

    .form-box h2 {
      font-size: 28px;
      font-weight: 700;
      text-align: center;
      margin-bottom: 10px;
    }

    .form-box p {
      text-align: center;
      font-size: 14px;
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 20px;
      position: relative;
    }

    .form-group input {
      width: 100%;
      padding: 12px 40px 12px 45px;
      border: none;
      border-radius: 12px;
      background-color: #fff;
      font-size: 14px;
      color: #000;
    }

    .form-group i {
      position: absolute;
      top: 50%;
      left: 15px;
      transform: translateY(-50%);
      font-size: 18px;
      color: #000;
    }

    .btn-login {
      width: 100%;
      background-color: #0b5ed7;
      border: none;
      border-radius: 10px;
      padding: 12px;
      color: #fff;
      font-weight: bold;
      font-size: 16px;
      transition: background 0.3s;
    }

    .btn-login:hover {
      background-color: #073e91;
    }

    .extra-links {
      font-size: 13px;
      text-align: center;
      margin-top: 10px;
    }

    .extra-links a {
      color: #fff;
      text-decoration: underline;
      margin: 0 5px;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        border-radius: 0;
      }

      .left-side, .right-side {
        width: 100%;
        padding: 30px 20px;
      }
    }
  </style>
  <script src="https://kit.fontawesome.com/a2e0e6ad68.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
    <div class="left-side">
      <h1>SELAMAT DATANG DI<br>GITA ULOS</h1>
      <p>Sebuah website penjualan ulos batak dengan<br>bahan ulos terbaik dengan produksi asli warga lokal</p>
      <img src="{{ asset('img/rumah.jpeg') }}" alt="Rumah Adat">
    </div>
    <div class="right-side">
      <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">
      <div class="form-box">
        <h2>Login</h2>
        <p>Silahkan Login terlebih dahulu sebelum melakukan pemesanan</p>
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="form-group">
            <i class="fas fa-user"></i>
            <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
          </div>
          <div class="form-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Sandi" required>
          </div>
          <button type="submit" class="btn-login">Login</button>
        </form>
        <div class="extra-links">
          Belum punya akun? <a href="{{ route('register') }}">Register</a> |
          <a href="{{ route('password.request') }}">Lupa password?</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
