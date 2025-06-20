<!-- Wrapper untuk center -->
<div class="flex justify-center w-full">
  <div class="relative w-[320px] h-auto flex flex-col items-center justify-start rounded-[14px] shadow-[20px_20px_60px_#bebebe,-20px_-20px_60px_#ffffff] overflow-hidden z-10">
    
    <!-- Glass Background -->
    <div class="absolute top-[5px] left-[5px] w-[310px] h-full z-20 bg-white/95 backdrop-blur-2xl rounded-[10px] outline outline-2 outline-white overflow-hidden"></div>

    <!-- Animated Blob -->
    <div class="absolute z-10 top-1/2 left-1/2 w-[180px] h-[180px] bg-green-400 opacity-100 blur-[12px] rounded-full animate-[blob-bounce_5s_ease_infinite]"></div>

    <!-- Actual Content -->
    <div class="relative z-30 p-6 text-center text-gray-900 dark:text-white">
      <img src="{{ asset($image) }}" alt="{{ $title }}" class="w-full h-40 object-cover rounded-md mb-4">
      <h3 class="text-2xl font-semibold mb-3">{{ $title }}</h3>
      <p class="text-base font-light text-gray-500 dark:text-gray-400 mb-4">Balanced meals designed for maintaining a healthy lifestyle.</p>
      <ul class="text-left text-sm space-y-3">
        @foreach($features as $feature)
          <li class="flex items-start gap-2">
            <svg class="w-5 h-5 text-green-500 dark:text-green-400 mt-1" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            <span>{{ $feature }}</span>
          </li>
        @endforeach
      </ul>
      <!-- Trigger Button -->
      <button onclick="document.getElementById('dietModal').classList.remove('hidden')" class="inline-block mt-4 text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-green-900">See More Details</button>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="dietModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">
  <div class="bg-white dark:bg-gray-900 max-w-2xl w-full mx-4 rounded-lg shadow-lg p-6 relative overflow-y-auto max-h-[90vh]">
    
    <!-- Close Button -->
    <button onclick="document.getElementById('dietModal').classList.add('hidden')" class="absolute top-3 right-4 text-gray-400 hover:text-gray-600 dark:hover:text-white text-2xl">&times;</button>
    
    <h2 class="text-2xl font-bold mb-3 text-gray-900 dark:text-white">Diet Plan</h2>
    <p class="text-gray-700 dark:text-gray-300 mb-4">
      Looking to reach your weight goals without compromising on taste?
      Our Diet Plan is thoughtfully designed to support healthy weight management through satisfying, nutrient-rich meals.
    </p>
    <p class="text-gray-700 dark:text-gray-300 mb-4">
      Each dish is light on calories but rich in fiber and whole ingredients to keep you energized and in control—without ever feeling deprived. Crafted by chefs and guided by nutritionists, the Diet Plan helps you stay on track with zero stress or guesswork.
    </p>
    <p class="text-gray-700 dark:text-gray-300 mb-6 font-medium italic">Simple, clean, and delicious. Healthy eating made truly effortless.</p>

    <hr class="my-4 border-gray-200 dark:border-gray-700">

    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">What You Get?</h3>
    <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 mb-6">
      <li>Carefully Portioned, Low-Calorie Meals</li>
      <li>Vibrant Plant-Based & Lean Protein Options</li>
      <li>Fresh, Whole Ingredients Only</li>
      <li>New Menu Rotation Weekly</li>
    </ul>

    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Weekly Menu on Diet Plan</h3>
    <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 mb-6">
      <li>Spiced Grilled Tofu with Edamame, Sweet Corn & Baby Lettuce</li>
      <li>Steamed Vegetable Stir-Fry with Soft-Boiled Egg and Sesame Dressing</li>
      <li>Rainbow Bowl with Cabbage, Cherry Tomatoes, Cucumber, and Tofu Strips</li>
    </ul>

    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Average Nutritional Information</h3>
    <ul class="list-disc list-inside text-gray-700 dark:text-gray-300">
      <li>Calories: 300 – 400 kcal per meal</li>
      <li>Protein: ~18–20g per meal</li>
      <li>Carbohydrates: ~30–35g per meal</li>
    </ul>
  </div>
</div>


<style>
  @keyframes blob-bounce {
    0% { transform: translate(-100%, -100%) translate3d(0, 0, 0); }
    25% { transform: translate(-100%, -100%) translate3d(100%, 0, 0); }
    50% { transform: translate(-100%, -100%) translate3d(100%, 100%, 0); }
    75% { transform: translate(-100%, -100%) translate3d(0, 100%, 0); }
    100% { transform: translate(-100%, -100%) translate3d(0, 0, 0); }
  }
</style>
