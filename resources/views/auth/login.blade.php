<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
                background: url("{{asset('images/bg-regis.jpg')}}") no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }
    </style>

    <style>
      
        .login-container {
            width: 100%;
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .login-container img {
            width: 60px;
            margin-bottom: 15px;
        }

        h2 {
            margin-bottom: 10px;
            font-size: 24px;
        }

        .subtitle {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }

        label {
            display: block;
            text-align: left;
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            margin-top: 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            margin-top: 10px;
            font-size: 14px;
        }

        .register-link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .register-link a {
            color: #007bff;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    
    @if(session('success'))
    <div style="color: green; text-align: center; margin-bottom: 10px;">
        {{ session('success') }}
    </div>
@endif

    <div class="login-container">
        <img src="{{ asset('images/logo-login.png') }}" alt="Logo" width="60">
        <h2>Selamat Datang Kembali!</h2>
        <p class="subtitle">Silakan login untuk melanjutkan ke dashboard</p>

        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        @if(session('success'))
            <div style="color: green; text-align: center; margin-bottom: 10px; padding: 10px; background-color: #d4edda; border: 1px solid #c3e6cb; border-radius: 4px;">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit">Login</button>
        </form>

        <div class="register-link">
            <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
        </div>
    </div>
</body>
</html>