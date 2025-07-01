<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up - SEA Catering</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-green-100 flex items-center justify-center px-4 py-10">

  <div class="w-full max-w-5xl bg-white rounded-2xl shadow-xl overflow-hidden grid grid-cols-1 md:grid-cols-2">
    
    <!-- Left Section (Form) -->
    <div class="p-8 md:p-10 flex flex-col justify-center">
      <h2 class="text-3xl font-bold text-gray-800 mb-2">Sign Up to your Account</h2>
      <p class="text-gray-500 mb-6">Hey, welcome to your special place</p>

      <form id="registerForm" class="space-y-5">
        <div>
          <label for="fullname" class="block font-semibold mb-1">Full Name</label>
          <input id="fullname" name="fullname" type="text" required
            placeholder="Input Your Full Name"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 focus:ring-2 focus:ring-green-300 outline-none"/>
        </div>

        <div>
          <label for="email" class="block font-semibold mb-1">Email</label>
          <input id="email" name="email" type="email" required
            placeholder="Input Your Email"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 focus:ring-2 focus:ring-green-300 outline-none"/>
        </div>

        <div>
          <label for="password" class="block font-semibold mb-1">Password</label>
            <div class="relative">
              <input id="password" name="password" type="password" required placeholder="Input Your Password"
              class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 focus:ring-2 focus:ring-green-300 outline-none pr-10"/>
              <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" id="iconEye" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
              </button>
            </div>
        </div>


        <button id="submitBtn" type="submit"
          class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3 rounded-lg transition duration-200 flex items-center justify-center gap-2">
          <span id="btnText">Sign Up</span>
          <svg id="spinner" class="hidden w-5 h-5 animate-spin text-white" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
          </svg>
        </button>

        <p class="text-sm text-center text-gray-600 mt-4">
          Already have an account? 
          <a href="/login" class="text-green-500 font-semibold hover:underline">Sign In</a>
        </p>
      </form>
    </div>

    <!-- Right Section (Image) -->
    <div class="hidden md:flex items-center justify-center bg-gradient-to-br from-green-400 to-green-100 p-8">
      <img src="{{ asset('assets/login.jpg') }}" alt="Illustration" class="w-full max-w-sm rounded-xl shadow-md">
    </div>
  </div>

  <!-- Register Script -->
  <script>
    const form = document.getElementById('registerForm');

    form.addEventListener('submit', async function (e) {
      e.preventDefault();

      const btn = document.getElementById('submitBtn');
      const text = document.getElementById('btnText');
      const spinner = document.getElementById('spinner');

      btn.disabled = true;
      text.textContent = "Signing Up...";
      spinner.classList.remove("hidden");

      const fullname = document.getElementById('fullname').value;
      const email    = document.getElementById('email').value;
      const password = document.getElementById('password').value;

      try {
        // const res = await fetch('http://127.0.0.1:8000/api/registe\r', {
        const res = await fetch('http://seacatering.my.id/register', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
          },
          body: JSON.stringify({ fullname, email, password })
        });

        const data = await res.json();

        if (res.ok && data.status) {
          alert('Register successful!');
          localStorage.setItem('token', data.token); // Optional
          window.location.href = '/login';
        } else {
          let msg = 'Register failed.';
          if (data.errors) {
            msg = Object.values(data.errors).flat().join('\n');
          } else if (data.message) {
            msg = data.message;
          }
          alert(msg);
        }
      } catch (err) {
        alert('Request error: ' + err.message);
      }

      btn.disabled = false;
      text.textContent = "Sign Up";
      spinner.classList.add("hidden");
    });
  </script>

  <script>
  const togglePassword = document.getElementById('togglePassword');
  const passwordField = document.getElementById('password');
  const iconEye = document.getElementById('iconEye');

  togglePassword.addEventListener('click', function () {
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);

    // Ganti icon antara eye dan eye-slash
    if (type === 'text') {
      iconEye.outerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.964 9.964 0 012.64-4.362m3.223-2.164A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.973 9.973 0 01-4.43 5.818M15 12a3 3 0 11-6 0 3 3 0 016 0zm-6.621 6.621L4 20m0 0l4-4m-4 4l4-4"/></svg>';
    } else {
      iconEye.outerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>';
    }
  });
</script>


</body>
</html>
