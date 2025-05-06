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

    .form-box {
      width: 100%;
      max-width: 400px;
      background-color: rgba(255,255,255,0.05);
      padding: 25px;
      border-radius: 12px;
    }

    .form-box h2 {
      text-align: center;
      font-size: 28px;
      color: #DAA520;
      margin-bottom: 10px;
      font-weight: 700;
    }

    .form-box p {
      text-align: center;
      font-size: 14px;
      margin-bottom: 20px;
    }

    .form-group {
      position: relative;
      margin-bottom: 15px;
    }

    .form-group input {
      width: 100%;
      padding: 12px 45px;
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

    .alert {
      font-size: 14px;
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

      .form-box {
        max-width: 100%;
        padding: 20px;
      }

      .form-box h2 {
        font-size: 24px;
      }
    }
  </style>
</head>
    <script>
  function togglePasswordVisibility() {
    const passwordInput = document.getElementById("password");
    const toggleIcon = document.querySelector(".toggle-password");

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      toggleIcon.classList.remove("fa-eye");
      toggleIcon.classList.add("fa-eye-slash");
    } else {
      passwordInput.type = "password";
      toggleIcon.classList.remove("fa-eye-slash");
      toggleIcon.classList.add("fa-eye");
    }
  }
</script>

<body>
  <div class="main-container">
    <div class="left-side">
      <h1>SELAMAT DATANG DI<br>GITA ULOS</h1>
      <p>Website penjualan ulos Batak berkualitas tinggi dari pengrajin lokal.</p>
      <img src="{{ asset('img/ulos/logogita.png') }}" alt="Rumah Adat">
    </div>
    <div class="right-side">
      <div class="logo">
        <img src="{{ asset('img/ulos/logogita.png') }}" alt="Logo Gita Ulos">
      </div>
      <div class="form-box">
        <h2>Login</h2>
        <p>Silakan login terlebih dahulu sebelum melakukan pemesanan</p>

        @if (session('success'))
          <div class="alert alert-success text-center">
            {{ session('success') }}
          </div>
        @endif

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

        <form method="POST" action="{{ route('login.custom.submit') }}">
          @csrf
          <div class="form-group">
            <i class="fas fa-user"></i>
            <input type="email" name="Email" placeholder="Email" required value="{{ old('Email') }}">
          </div>
                <div class="form-group">
          <i class="fas fa-lock"></i>
          <input id="password" type="password" name="Password" placeholder="Sandi" required>
          <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility()" style="position:absolute; right:15px; top:50%; transform:translateY(-50%); cursor:pointer;"></i>
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
