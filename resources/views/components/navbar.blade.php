
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<div class="container mx-auto px-4 py-4 flex items-center justify-between" x-data="{ open: false }">
  <h1 class="text-2xl font-bold text-green-600">
    <a href="/">SEA Catering</a>
  </h1>


  <button @click="open = !open" class="md:hidden text-green-600 focus:outline-none">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
      stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M4 6h16M4 12h16M4 18h16" />
    </svg>
  </button>


  <nav class="hidden md:flex items-center space-x-6">
    <ul class="flex space-x-6">
      <li><a href="/" class="hover:text-green-600">Home</a></li>
      <li><a href="/meal_plans" class="hover:text-green-600">Meal Plans</a></li>
      <li><a href="/contact" class="hover:text-green-600">Contact Us</a></li>
      <li><a href="/subscription" class="hover:text-green-600">Subscription</a></li>
      <li><a href="/userdashboard" class="hover:text-green-600">Dashboard User</a></li>
    </ul>
    <a href="/login" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">Order Now</a>
  </nav>


  <div x-show="open" class="md:hidden absolute top-16 left-0 w-full bg-white shadow-md z-50">
    <ul class="flex flex-col space-y-4 px-4 py-4">
      <li><a href="/" class="hover:text-green-600">Home</a></li>
      <li><a href="/meal_plans" class="hover:text-green-600">Meal Plans</a></li>
      <li><a href="/contact" class="hover:text-green-600">Contact Us</a></li>
      <li><a href="/subscription" class="hover:text-green-600">Subscription</a></li>
      <li><a href="/userdashboard" class="hover:text-green-600">Dashboard User</a></li>
      <li><a href="/login" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition text-center">Order Now</a></li>
    </ul>
  </div>
</div>
