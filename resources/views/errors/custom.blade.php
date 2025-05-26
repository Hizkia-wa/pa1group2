<!-- resources/views/errors/custom.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oops! Something went wrong</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            text-align: center;
        }
        .error-container {
            background-color: #fff3e0;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }
        .error-container img {
            width: 120px;
            height: auto;
            margin-bottom: 20px;
        }
        .error-title {
            font-size: 28px;
            font-weight: bold;
            color: #f57c00;
            margin-bottom: 10px;
        }
        .error-message {
            font-size: 18px;
            color: #555;
            margin-bottom: 20px;
        }
        .error-button {
            padding: 12px 24px;
            background-color: #f57c00;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
        }
        .error-button:hover {
            background-color: #e65100;
        }
    </style>
</head>
<body>

    <div class="error-container">
        <img src="{{ asset('public/img/oops-image.png') }}" alt="Error Image">
        <h1 class="error-title">Maaf atas ketidaknyamanannya</h1>
        <p class="error-message">Sorry for the inconvenience. We are currently experiencing some issues. Please try again later.</p>
        <a href="{{ url('/') }}" class="error-button">Kembali ke Beranda</a>
    </div>

</body>
</html>
