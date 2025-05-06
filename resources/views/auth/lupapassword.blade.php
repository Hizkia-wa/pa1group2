<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lupa Password - Gita Ulos</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html, body {
    height: 100%;
    width: 100%;
    font-family: 'Poppins', sans-serif;
    background-color: #F3E9DC;
    overflow-x: hidden;
    /* HAPUS overflow: hidden agar bisa scroll */
  }

  .container {
    display: flex;
    flex-direction: row;
    width: 100%;
    min-height: 100vh;
    /* HAPUS height: 100vh dan overflow: hidden */
  }

  @media (max-width: 768px) {
    .container {
      flex-direction: column;
    }

    .left-side, .right-side {
      width: 100%;
      height: auto;
      min-height: auto;
    }
  }

  /* TAMBAHKAN untuk mengizinkan scroll */
  .right-side {
    overflow-y: auto;
  }

    .left-side {
      background: linear-gradient(to bottom right, #F3E9DC, #EBD5B3);
      padding: 40px;
      flex: 1;
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
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
      background-color: #6B4226;
      color: white;
      padding: 40px;
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
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

    .forgot-form {
      width: 100%;
      max-width: 350px;
    }

    .forgot-form h2 {
      text-align: center;
      font-size: 28px;
      margin-bottom: 20px;
      font-weight: 700;
      color: #DAA520;
    }

    .forgot-form p {
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

    .message {
      font-size: 13px;
      margin-top: 10px;
    }

    .message.error {
      color: #FF6B6B;
    }

    .message.success {
      color: #51CF66;
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

      .left-side, .right-side {
        width: 100%;
        height: auto;
        min-height: 50vh;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="left-side">
      <h1>SELAMAT DATANG DI<br>GITA ULOS</h1>
      <p>Sebuah website penjualan ulos batak dengan bahan ulos terbaik dengan produksi asli warga lokal</p>
      <img src="{{ asset('img/ulos/logogita.png') }}" alt="Rumah Adat" class="rumah-adat">
    </div>
    <div class="right-side">
      <div class="logo">
        <img src="{{ asset('img/ulos/logogita.png') }}" alt="Logo Gita Ulos">
      </div>
      <div class="forgot-form">
        <h2>Lupa Password</h2>
        <p>Silakan masukkan email yang Anda gunakan</p>
        <form action="{{ route('forgot.password.send') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Masukkan email" required>
            @if(session('error'))
              <div class="message error">{{ session('error') }}</div>
            @endif
            @if(session('success'))
              <div class="message success">{{ session('success') }}</div>
            @endif
          </div>
          <button type="submit" class="btn btn-primary" {{ session('locked') ? 'disabled' : '' }}>Kirim</button>
        </form>
        <div class="back-link">
          <a href="{{ route('login') }}">Kembali ke halaman login</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
