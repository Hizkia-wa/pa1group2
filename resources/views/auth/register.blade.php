<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gita ULOS - Registrasi</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
   * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html, body {
  height: 100%;
  width: 100%;
  overflow-x: hidden;
  font-family: 'Poppins', sans-serif;
  background-color: #F3E9DC;
}

.container {
  display: flex;
  width: 100vw;
  height: 100vh;
  overflow: hidden;
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

.logo-container {
  margin-bottom: 20px;
}

.logo {
  width: 90px;
  height: 90px;
  border-radius: 50%;
  overflow: hidden;
  border: 3px solid #DAA520;
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
  font-size: 32px;
  margin-bottom: 25px;
  font-weight: 700;
  color: #DAA520;
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
            <div class="login-link">
          Sudah punya akun? <a href="{{ route('login.custom') }}">Login</a>
        </div>
          </div>
          <button type="submit" class="btn btn-primary">Registrasi</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
