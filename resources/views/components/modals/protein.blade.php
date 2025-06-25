<!-- components/modals/royal.blade.php -->
<h2 class="text-2xl font-bold mb-3 text-gray-900 dark:text-white">Royal Plan</h2>
<p class="text-gray-700 dark:text-gray-300 mb-4">
  The Royal Plan is our premium option, curated for those who seek luxury and sophistication in every bite.
  From exotic ingredients to chef-curated menus, enjoy a gourmet experience in every meal.
</p>
<p class="text-gray-700 dark:text-gray-300 mb-4">
  Perfect for special occasions, entertaining, or simply indulging in fine flavors every day.
</p>
<p class="text-gray-700 dark:text-gray-300 mb-6 font-medium italic">Experience the art of fine dining, delivered.</p>
<hr class="my-4 border-gray-200 dark:border-gray-700">
<h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">What You Get?</h3>
<ul class="list-disc list-inside text-gray-700 dark:text-gray-300 mb-6">
  <li>Chef-inspired gourmet recipes</li>
  <li>International ingredients and unique pairings</li>
  <li>Premium proteins, artisan sides, and luxury desserts</li>
  <li>Seasonal menus and themed dinner options</li>
</ul>
<h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Weekly Menu on Royal Plan</h3>
<ul class="list-disc list-inside text-gray-700 dark:text-gray-300 mb-6">
  <li>Seared Duck Breast with Red Wine Reduction & Truffle Mash</li>
  <li>Pan-Roasted Seabass with Saffron Risotto</li>
  <li>Filet Mignon with Asparagus and Béarnaise Sauce</li>
</ul>
<h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Average Nutritional Information</h3>
<ul class="list-disc list-inside text-gray-700 dark:text-gray-300 mb-6">
  <li>Calories: 600 – 750 kcal per meal</li>
  <li>Protein: ~35–40g per meal</li>
  <li>Carbohydrates: ~30–40g per meal</li>
</ul>
<div class="text-center mt-6">
  <button onclick="subscribeToPlan('Royal')" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition-all duration-200">
    Subscribe to Royal Plan
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