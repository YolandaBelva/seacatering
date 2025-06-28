<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<div 
  class="container mx-auto px-4 py-4 flex items-center justify-between relative z-50" 
  x-data="{
    open: false,
    role: localStorage.getItem('role') || '',
    isLoggedIn: !!localStorage.getItem('token'),
    async logout() {
      const token = localStorage.getItem('token');
      if (!token) {
        alert('You are not logged in.');
        return;
      }

      try {
        const response = await fetch('http://127.0.0.1:8000/api/logout', {
          method: 'POST',
          headers: {
            'Authorization': 'Bearer ' + token,
            'Accept': 'application/json'
          }
        });

        if (response.ok) {
          localStorage.clear();
          alert('You have been logged out.');
          localStorage.removeItem('token');
          localStorage.removeItem('user_name');
          localStorage.removeItem('role');
          window.location.href = '/login';
        } else {
          const error = await response.json();
          alert('Logout failed: ' + (error.message || 'Unknown error'));
        }
      } catch (err) {
        alert('Logout error: ' + err.message);
      }
    }
  }"
>

  <!-- Logo -->
  <h1 class="text-2xl font-bold text-green-600">
    <a href="/">SEA Catering</a>
  </h1>

  <!-- Mobile Toggle -->
  <button @click="open = !open" class="md:hidden text-green-600 focus:outline-none">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
      stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M4 6h16M4 12h16M4 18h16" />
    </svg>
  </button>

  <!-- Desktop Navigation -->
  <nav class="hidden md:flex items-center space-x-6">
    <ul class="flex space-x-6">
      <li><a href="/" class="hover:text-green-600">Home</a></li>
      <li><a href="/meal_plans" class="hover:text-green-600">Meal Plans</a></li>
      <li><a href="/contact" class="hover:text-green-600">Contact Us</a></li>

      <!-- User-only pages -->
      <template x-if="role === 'USER'">
        <li><a href="/userdashboard" class="hover:text-green-600">Dashboard User</a></li>
      </template>

      <template x-if="role === 'USER'">
        <li><a href="/subscription" class="hover:text-green-600">Subscription</a></li>
      </template>

      <!-- Admin-only page -->
      <template x-if="role === 'ADMIN'">
        <li><a href="/admindashboard" class="hover:text-green-600">Dashboard Admin</a></li>
      </template>
    </ul>

    <!-- Auth Buttons -->
    <a 
      href="/login" 
      x-show="!isLoggedIn" 
      class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition"
    >
      Order Now
    </a>

    <button 
      @click="logout()" 
      x-show="isLoggedIn"
      class="ml-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition flex items-center"
    >
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1" />
      </svg>
      Logout
    </button>
  </nav>

  <!-- Mobile Menu -->
  <div x-show="open" @click.away="open = false" class="md:hidden absolute top-16 left-0 w-full bg-white shadow-md z-50">
    <ul class="flex flex-col space-y-4 px-4 py-4">
      <li><a href="/" class="hover:text-green-600">Home</a></li>
      <li><a href="/meal_plans" class="hover:text-green-600">Meal Plans</a></li>
      <li><a href="/contact" class="hover:text-green-600">Contact Us</a></li>

      <!-- User-only pages -->
      <template x-if="role === 'USER'">
        <li><a href="/userdashboard" class="hover:text-green-600">Dashboard User</a></li>
      </template>

      <template x-if="role === 'USER'">
        <li><a href="/subscription" class="hover:text-green-600">Subscription</a></li>
      </template>

      <!-- Admin-only page -->
      <template x-if="role === 'ADMIN'">
        <li><a href="/admindashboard" class="hover:text-green-600">Dashboard Admin</a></li>
      </template>

      <!-- Auth Buttons -->
      <li x-show="!isLoggedIn">
        <a href="/login" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition text-center">Order Now</a>
      </li>

      <li x-show="isLoggedIn">
        <button 
          @click="logout()" 
          class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition w-full flex items-center justify-center"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1" />
          </svg>
          Logout
        </button>
      </li>
    </ul>
  </div>
</div>
