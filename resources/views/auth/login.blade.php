<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - SEA Catering</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-green-100 flex items-center justify-center px-4 py-10">

  <div class="w-full max-w-5xl bg-white rounded-2xl shadow-xl overflow-hidden grid grid-cols-1 md:grid-cols-2">
    
    <!-- Left Section -->
    <div class="p-8 md:p-10 flex flex-col justify-center">
      <h2 class="text-3xl font-bold text-gray-800 mb-2">Login to your Account</h2>
      <p class="text-gray-500 mb-6">Hey, welcome back to your special place</p>

      <form method="POST" action="{{ route('login') }}" class="space-y-5" onsubmit="handleSubmit(event)">
        @csrf

        <div>
          <label for="email" class="block font-semibold mb-1">Email</label>
          <input id="email" type="email" name="email" required
            placeholder="Input Your Email"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 focus:ring-2 focus:ring-green-300 outline-none"/>
        </div>

        <div>
          <label for="password" class="block font-semibold mb-1">Password</label>
          <input id="password" type="password" name="password" required
            placeholder="Input Your Password"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 focus:ring-2 focus:ring-green-300 outline-none"/>
        </div>

        <button id="submitBtn" type="submit"
          class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3 rounded-lg transition duration-200 flex items-center justify-center gap-2">
          <span id="btnText">Sign In</span>
          <svg id="spinner" class="hidden w-5 h-5 animate-spin text-white" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
              d="M4 12a8 8 0 018-8v8H4z"></path>
          </svg>
        </button>

        <p class="text-sm text-center text-gray-600 mt-4">
          Don’t Have An Account? 
          <a href="/register" class="text-green-500 font-semibold hover:underline">Sign Up</a>
        </p>
      </form>
    </div>

    <!-- Right Section -->
    <div class="hidden md:flex items-center justify-center bg-gradient-to-br from-green-400 to-green-100 p-8">
      <img src="{{ asset('assets/login.jpg') }}" alt="Login Illustration" class="w-full max-w-sm rounded-xl shadow-md">
    </div>
  </div>

  <!-- Script for button animation -->
  <script>
    function handleSubmit(event) {
      const button = document.getElementById('submitBtn');
      const text = document.getElementById('btnText');
      const spinner = document.getElementById('spinner');

      button.disabled = true;
      text.textContent = 'Signing In...';
      spinner.classList.remove('hidden');
    }
  </script>
</body>
</html>
