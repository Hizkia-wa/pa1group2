<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Gita Ulos</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            overflow: hidden;
        }
        
        .container {
            display: flex;
            height: 100vh;
        }
        
        .left {
            flex: 1;
            background-color: #f0e6d6; /* Beige color from reference */
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #6b4c2a; /* Dark brown for text */
        }
        
        .left h1 {
            font-size: 2.5em;
            font-weight: 700;
            margin-bottom: 20px;
            color: #6b4c2a; /* Dark brown from reference */
        }
        
        .left p {
            max-width: 450px;
            line-height: 1.6;
            margin-bottom: 30px;
            font-size: 1.1em;
        }
        
        .rumah-adat {
            width: 200px;
            margin-top: 20px;
            filter: drop-shadow(0 5px 15px rgba(0,0,0,0.1));
        }
        
        .right {
            flex: 1;
            background-color: #6b4c2a; /* Dark brown from reference */
            color: #fff;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        
        .logo {
            width: 120px;
            margin-bottom: 30px;
            filter: drop-shadow(0 2px 5px rgba(0,0,0,0.2));
        }
        
        .right h2 {
            font-size: 2em;
            margin-bottom: 15px;
            color: #e3b341; /* Gold color from reference */
            font-weight: 600;
        }
        
        .right p {
            margin-bottom: 30px;
            text-align: center;
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
            color: #e3b341; /* Gold color from reference */
        }
        
        .form-group input {
            width: 100%;
            padding: 15px;
            border-radius: 8px;
            border: none;
            background-color: #f7f7f7;
            font-size: 1em;
            font-family: 'Poppins', sans-serif;
        }
        
        .form-group button {
            margin-top: 20px;
            width: 100%;
            padding: 8px;
            background-color: #e3b341; 
            color: white; 
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 700;
            font-size: 1.1em;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }
        
        .form-group button:hover {
            background-color: #d9a730;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(227, 179, 65, 0.3);
        }
        
        .form-group button:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }
        
        .error {
            color: #ff6b6b;
            margin-top: 10px;
            font-size: 0.9em;
        }
        
        .success {
            color: #51cf66;
            margin-top: 10px;
            font-size: 0.9em;
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
                flex: none;
                width: 100%;
                height: 50vh;
                border-radius: 10px;
            }
            
            .left h1 {
                font-size: 1.8em;
            }
            
            .left p {
                font-size: 0.9em;
            }
            
            .rumah-adat {
                width: 150px;
                
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
           
            <h2>Lupa Password</h2>
            <p>Silakan untuk memasukkan email yang anda gunakan</p>
            <form action="{{ route('forgot.password.send') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
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
            <a href="{{ route('login.custom') }}" class="back-link">Kembali ke halaman login</a>
        </div>
    </div>
</body>
</html>