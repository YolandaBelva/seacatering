
    <div class="container mx-auto px-4 py-4 flex items-center justify-between">
      <h1 class="text-2xl font-bold text-green-600"> <a href="/"> SEA Catering</a></h1>
      <nav class="flex items-center space-x-6">
        <ul class="hidden md:flex space-x-6">
          <li><a href="/" class="hover:text-green-600">Home</a></li>
          <li><a href="/meal_plans" class="hover:text-green-600">Meal Plans</a></li>
          <li><a href="/contact" class="hover:text-green-600">Contact Us</a></li>
          <li><a href="/subscription" class="hover:text-green-600">Subscription</a></li>
        </ul>
        
        {{-- jika belum login --}}
        <a href="/login" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">Order Now</a>
        {{-- jika sudah login --}}
        <a href="/subscription" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">Order Now</a>
      </nav>
    </div>