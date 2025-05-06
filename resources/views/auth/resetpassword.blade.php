<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password - Gita Ulos</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html, body {
      font-family: 'Poppins', sans-serif;
      width: 100%;
      min-height: 100vh;
      background-color: #F3E9DC;
      overflow-x: hidden;
    }

    .container {
      display: flex;
      flex-direction: row;
      min-height: 100vh;
    }

    .left {
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

    .left h1 {
      font-size: 30px;
      font-weight: 900;
      margin-bottom: 15px;
    }

    .left p {
      font-size: 15px;
      margin-bottom: 25px;
      max-width: 90%;
      color: #5a3820;
    }

    .rumah-adat {
      max-width: 70%;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
      margin-top: 20px;
    }

    .right {
      flex: 1;
      background-color: #6B4226;
      color: white;
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      overflow-y: auto;
    }

    .logo {
      width: 100px;
      margin-bottom: 25px;
    }

    .logo img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
      border: 3px solid #DAA520;
    }

    .reset-form {
      width: 100%;
      max-width: 350px;
    }

    .reset-form h2 {
      text-align: center;
      font-size: 28px;
      margin-bottom: 20px;
      font-weight: 700;
      color: #DAA520;
    }

    .reset-form p {
      text-align: center;
      font-size: 14px;
      margin-bottom: 20px;
      color: #fff;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      font-size: 14px;
      color: #FFD700;
      margin-bottom: 5px;
      display: block;
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
      cursor: pointer;
    }

    .btn-primary:hover {
      background-color: #b48a1b;
    }

    .back-link {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }

    .back-link a {
      color: #FFD700;
      font-weight: bold;
      text-decoration: none;
    }

    .back-link a:hover {
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }

      .left, .right {
        width: 100%;
        height: auto;
        min-height: 50vh;
      }

      .rumah-adat {
        max-width: 50%;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="left">
      <h1>SELAMAT DATANG DI<br>GITA ULOS</h1>
      <p>Sebuah website penjualan ulos batak dengan bahan ulos terbaik dengan produksi asli warga lokal</p>
      <img src="{{ asset('img/ulos/logogita.png') }}" alt="Rumah Adat" class="rumah-adat">
    </div>
    <div class="right">
    <div class="logo">
        <img src="{{ asset('img/ulos/logogita.png') }}" alt="Logo Gita Ulos">
      </div>
      <div class="reset-form">
        <h2>Reset Password</h2>
        <p>Silakan masukkan password baru Anda</p>
        <form method="POST" action="{{ route('reset.password.submit') }}">
          @csrf
          <input type="hidden" name="email" value="{{ session('reset_email') }}">

          <div class="form-group">
            <label>Password Baru</label>
            <input type="password" name="password" required>
          </div>

          <div class="form-group">
            <label>Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" required>
          </div>

          <button type="submit" class="btn-primary">Simpan Password</button>
        </form>

        <div class="back-link">
          <a href="{{ route('login') }}">Kembali ke halaman login</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
