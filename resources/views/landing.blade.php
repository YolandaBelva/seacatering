<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SEA Catering</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans text-gray-800">

  <!-- Navbar -->
  <header class="bg-white shadow">
    <div class="container mx-auto px-4 py-4 flex items-center justify-between">
      <h1 class="text-2xl font-bold text-green-600">SEA Catering</h1>
      <nav class="flex items-center space-x-6">
        <ul class="hidden md:flex space-x-6">
          <li><a href="#" class="hover:text-green-600">Home</a></li>
          <li><a href="#" class="hover:text-green-600">Meal Plans</a></li>
          <li><a href="#" class="hover:text-green-600">About Us</a></li>
          <li><a href="#" class="hover:text-green-600">Contact</a></li>
          <li><a href="#" class="hover:text-green-600">Login</a></li>
        </ul>
        <a href="#" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">Order Now</a>
      </nav>
    </div>
  </header>

  <!-- Hero Section -->
<section class="relative bg-cover bg-center bg-no-repeat h-[80vh] flex items-center justify-center" style="background-image: url('/assets/health.jpg');">
    <div class="bg-black bg-opacity-50 w-full h-full absolute top-0 left-0"></div>
    <div class="relative z-10 text-center text-white px-4">
      <h2 class="text-4xl font-bold mb-4">Healthy Meals, Anytime, Anywhere</h2>
      <p class="mb-6 max-w-2xl mx-auto">SEA Catering delivers customizable healthy meal plans across Indonesia, tailored to your dietary needs and preferences.</p>
      <a href="#" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg transition">Explore Plans</a>
    </div>
  </section>

  <!-- Features Section -->
  <section class="py-16 px-4 text-center">
    <h3 class="text-lg text-green-600 font-semibold mb-2">Key Features</h3>
    <h2 class="text-3xl font-bold mb-4">Why Choose SEA Catering?</h2>
    <p class="mb-12 max-w-2xl mx-auto">We make healthy eating easy and convenient with our customizable meal plans and nationwide delivery.</p>

    <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
      <div class="bg-white shadow-md rounded-lg p-6">
        <h4 class="text-xl font-semibold mb-2">🥗 Meal Customization</h4>
        <p>Tailor your meals to your specific dietary requirements and taste preferences.</p>
      </div>
      <div class="bg-white shadow-md rounded-lg p-6">
        <h4 class="text-xl font-semibold mb-2">🚚 Delivery Across Indonesia</h4>
        <p>Enjoy fresh, healthy meals delivered to your doorstep in major cities across Indonesia.</p>
      </div>
      <div class="bg-white shadow-md rounded-lg p-6">
        <h4 class="text-xl font-semibold mb-2">📊 Detailed Nutritional Information</h4>
        <p>Access comprehensive nutritional information for each meal, including calories, macros, and ingredients.</p>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-100 py-8">
    <section class="text-center">
      <h4 class="text-lg font-bold mb-2">Contact Us</h4>
      <p>For inquiries or assistance, please contact our manager, Brian, at 08123456789.</p>
    </section>
  </footer>

</body>
</html>
