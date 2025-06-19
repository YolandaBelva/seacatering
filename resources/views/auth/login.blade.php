<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - SEA Catering</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
</head>
<body class="login-body">
  <div class="login-wrapper">
    <div class="login-container">
      
      <!-- KIRI: FORM LOGIN -->
      <div class="login-left">
        <h2 class="login-title">Holla, Welcome Back</h2>
        <p class="login-subtitle">Hey, welcome back to your special place</p>

        <form method="POST" action="{{ route('login') }}">
          @csrf

          <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" required placeholder="stanley@gmail.com">
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required placeholder="•••••••••••">
          </div>

          <button type="submit" class="btn-submit">Sign In</button>

          <div class="login-footer">
            <p>Don’t have an account? <a href="#">Sign Up</a></p>
          </div>
        </form>
      </div>

      <!-- KANAN: GAMBAR ILUSTRASI -->
      <div class="login-right">
        <img src="{{ asset('assets/login.jpg') }}" alt="Login Illustration">
      </div>

    </div>
  </div>
</body>
</html>
