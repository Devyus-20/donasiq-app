<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Lembaga Philanthropy</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f4f7;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .login-container {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      width: 350px;
      text-align: center;
    }
    .login-container img {
      max-width: 120px;
      margin-bottom: 20px;
    }
    .login-container h2 {
      margin-bottom: 20px;
      font-size: 20px;
      color: #333;
    }
    .login-container input {
      width: 90%;
      padding: 12px;
      margin: 10px 0;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 14px;
    }
    .login-container button {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 6px;
      background-color: #f9a825;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
    }
    .login-container button:hover {
      background-color: #f57f17;
    }
    .alert {
      color: red;
      margin-bottom: 15px;
      text-align: left;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <!-- Logo -->
    <img src="{{ asset('images/logo.png') }}" alt="Logo Lembaga Philanthropy">

    <h2>Login Lembaga Philanthropy</h2>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        @if (session('status'))
          Swal.fire({
            title: 'Berhasil!',
            text: '{{ session('status') }}',
            icon: 'success',
            confirmButtonText: 'OK',
            confirmButtonColor: '#f9a825'
          });
        @endif


        @if ($errors->has('login_error'))
          Swal.fire({
            title: 'Gagal Login!',
            text: '{{ $errors->first('login_error') }}',
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: '#f9a825'
          });
        @endif
        
        @if ($errors->any() && !$errors->has('login_error'))
          Swal.fire({
            title: 'Error!',
            html: '@foreach ($errors->all() as $item)<p>{{ $item }}</p>@endforeach',
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: '#f9a825'
          });
        @endif
      });
    </script>

    <!-- Form Login -->
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" >
      <input type="password" name="password" placeholder="Password" >
      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>
