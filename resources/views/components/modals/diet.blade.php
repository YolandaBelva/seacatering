<!-- components/modals/diet.blade.php -->
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
<ul class="list-disc list-inside text-gray-700 dark:text-gray-300 mb-6">
  <li>Calories: 300 – 400 kcal per meal</li>
  <li>Protein: ~18–20g per meal</li>
  <li>Carbohydrates: ~30–35g per meal</li>
</ul>
<div class="text-center mt-6">
  <button onclick="subscribeToPlan('Diet')" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition-all duration-200">
    Subscribe to Diet Plan
  </button>
</div>

<script>
  function subscribeToPlan(plan) {
    fetch("/api/subscribe", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "Accept": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name=\"csrf-token\"]')?.content
      },
      body: JSON.stringify({
        plan: plan,
        user_id: 1
      })
    })
    .then(response => {
      if (!response.ok) throw new Error("Network error");
      return response.json();
    })
    .then(data => {
      alert("Subscribed successfully to " + plan + " plan!");
      document.getElementById(plan.toLowerCase() + 'Modal').classList.add('hidden');
    })
    .catch(error => {
      console.error(error);
      alert("Failed to subscribe. Please try again.");
    });
  }
</script>
