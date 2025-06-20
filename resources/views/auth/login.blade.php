<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - SEA Catering</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-100 min-h-screen flex items-center justify-center px-4">
  <div class="max-w-6xl bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col md:flex-row">

    <!-- Left Section -->
    <div class="w-full md:w-1/2 p-8 flex flex-col justify-center">
      <h2 class="text-2xl font-bold mb-4 text-gray-900">Login to your Account</h2>
      <p class="text-gray-600 mb-8">Hey, welcome back to your special place</p>

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-6">
          <label for="email" class="block font-semibold mb-2">Email</label>
          <input id="email" type="email" name="email" required placeholder="Input Your Email"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 text-sm" />
        </div>

        <div class="mb-6">
          <label for="password" class="block font-semibold mb-2">Password</label>
          <input id="password" type="password" name="password" required placeholder="Input Your Password"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 text-sm" />
        </div>

        <button type="submit"
          class="w-full bg-green-500 hover:bg-green-100 hover:text-green-700 text-white font-semibold py-3 rounded-xl transition">Sign In</button>

        <div class="mt-6 text-sm text-gray-600 text-center space-y-4">
        <p>Don’t Have An Account? <a href="/register" class="text-green-500 font-semibold hover:underline">Sign Up</a></p>
</div>

      </form>
    </div>

    <!-- Right Section -->
    <div class="w-full md:w-1/2 bg-gradient-to-br from-green-400 to-green-100 flex items-center justify-center p-8">
      <img src="{{ asset('assets/login.jpg') }}" alt="Login Illustration" class="w-full max-w-sm">
    </div>

  </div>
</body>
</html>
