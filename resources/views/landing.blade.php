<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SEA Catering</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
  <style>
    html {
      scroll-behavior: smooth;
    }
  </style>
</head>
<body class="font-sans text-gray-800 bg-gray-100">

  <!-- Navbar -->
  <header class="bg-white shadow">
    @include('components.navbar')
  </header>

  <!-- Hero Section -->
  <section class="relative bg-fixed bg-center bg-cover h-[80vh] flex items-center justify-center" style="background-image: url('/assets/health.jpg');">
    <div class="bg-black bg-opacity-50 w-full h-full absolute top-0 left-0"></div>
    <div class="relative z-10 text-center text-white px-4" data-aos="fade-down">
      <h2 class="text-4xl font-bold mb-4">Healthy Meals, Anytime, Anywhere</h2>
      <p class="mb-6 max-w-2xl mx-auto">SEA Catering delivers customizable healthy meal plans across Indonesia, tailored to your dietary needs and preferences.</p>
      <a href="/meal_plans" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg transition-transform transform hover:scale-105">Explore Plans</a>
    </div>
  </section>

  <!-- Features Section -->
  <section class="bg-green-50 py-16 px-4 text-center">
    <h3 class="text-lg text-green-600 font-semibold mb-2" data-aos="fade-up">Key Features</h3>
    <h2 class="text-3xl font-bold mb-4" data-aos="fade-up" data-aos-delay="100">Why Choose SEA Catering?</h2>
    <p class="mb-12 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">We make healthy eating easy and convenient with our customizable meal plans and nationwide delivery.</p>

    <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
      <div class="bg-white shadow-md rounded-lg p-6" data-aos="zoom-in" data-aos-delay="100">
        <h4 class="text-xl font-semibold mb-2">Meal Customization</h4>
        <p>Tailor your meals to your specific dietary requirements and taste preferences.</p>
      </div>
      <div class="bg-white shadow-md rounded-lg p-6" data-aos="zoom-in" data-aos-delay="200">
        <h4 class="text-xl font-semibold mb-2">Delivery Across Indonesia</h4>
        <p>Enjoy fresh, healthy meals delivered to your doorstep in major cities across Indonesia.</p>
      </div>
      <div class="bg-white shadow-md rounded-lg p-6" data-aos="zoom-in" data-aos-delay="300">
        <h4 class="text-xl font-semibold mb-2">Detailed Nutritional Information</h4>
        <p>Access comprehensive nutritional information for each meal, including calories, macros, and ingredients.</p>
      </div>
    </div>
  </section>

<section class="bg-green-50 py-12 px-4 md:px-8 lg:px-20">
  <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-2xl p-8">
    <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-8 flex items-center justify-center gap-2">
      📢 Share Your Experience
    </h2>

    <form action="#" method="POST" class="space-y-6">
      @csrf

      <div class="flex flex-col items-center space-y-2">
        <div class="flex items-center space-x-2">
          <span class="text-xl text-yellow-500">⭐</span>
          <span class="text-lg font-semibold text-gray-700">Rating</span>
        </div>

        <div id="starRating" class="flex justify-center space-x-1 text-3xl text-gray-300 cursor-pointer">
          <span data-value="1" class="star hover:text-yellow-400 transition">★</span>
          <span data-value="2" class="star hover:text-yellow-400 transition">★</span>
          <span data-value="3" class="star hover:text-yellow-400 transition">★</span>
          <span data-value="4" class="star hover:text-yellow-400 transition">★</span>
          <span data-value="5" class="star hover:text-yellow-400 transition">★</span>
        </div>
        <input type="hidden" name="rating" id="ratingInput">
      </div>

      <div>
        <label for="review" class="block text-lg font-semibold text-gray-800 mb-2">💬 Your Review</label>
        <textarea id="review" name="review" rows="4"
          class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 text-sm focus:outline-none focus:ring-2 focus:ring-green-300 resize-none"
          placeholder="Tell us what you think..."></textarea>
      </div>

      <div class="pt-4">
        <button type="submit"
          class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded-lg transition duration-300 ease-in-out shadow-lg">
          Submit Testimonial
        </button>
      </div>
    </form>
  </div>
</section>


      <div class="bg-white p-10 rounded-2xl shadow-xl border border-green-100" data-aos="fade-up">
        <h2 class="text-3xl font-extrabold mb-8 text-center text-gray-800">💬 What Our Customers Say</h2>

        <div class="swiper mySwiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="bg-green-50 rounded-xl p-6 shadow text-center max-w-md mx-auto">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Sarah" class="mx-auto w-20 h-20 rounded-full object-cover mb-4 border-4 border-white shadow-md">
                <p class="text-lg italic text-gray-700 mb-2">"Layanan luar biasa! Makanannya enak dan pengirimannya cepat."</p>
                <div class="text-yellow-500 text-xl mb-1">★★★★★</div>
                <p class="font-semibold text-gray-800">Sarah</p>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="bg-green-50 rounded-xl p-6 shadow text-center max-w-md mx-auto">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Andi" class="mx-auto w-20 h-20 rounded-full object-cover mb-4 border-4 border-white shadow-md">
                <p class="text-lg italic text-gray-700 mb-2">"Pengalaman yang sangat memuaskan. Akan order lagi!"</p>
                <div class="text-yellow-500 text-xl mb-1">★★★★☆</div>
                <p class="font-semibold text-gray-800">Andi</p>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="bg-green-50 rounded-xl p-6 shadow text-center max-w-md mx-auto">
                <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Dina" class="mx-auto w-20 h-20 rounded-full object-cover mb-4 border-4 border-white shadow-md">
                <p class="text-lg italic text-gray-700 mb-2">"Harga terjangkau, pelayanan ramah!"</p>
                <div class="text-yellow-500 text-xl mb-1">★★★★★</div>
                <p class="font-semibold text-gray-800">Dina</p>
              </div>
            </div>
          </div>
          <div class="swiper-pagination mt-6"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Scripts -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
  const stars = document.querySelectorAll('.star');
  const ratingInput = document.getElementById('ratingInput');

  stars.forEach((star, index) => {
    star.addEventListener('click', () => {
      const rating = index + 1;
      ratingInput.value = rating;

      stars.forEach((s, i) => {
        s.classList.toggle('text-yellow-400', i < rating);
        s.classList.toggle('text-gray-300', i >= rating);
      });
    });
  });
</script>

  <script>
    AOS.init({
      duration: 1000,
      once: true
    });
  </script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        autoplay: {
        delay: 5000,
        disableOnInteraction: false,
        },
      });
    });
  </script>

</body>
</html>
