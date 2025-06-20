<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" >
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customize Your Meal Plan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-100 min-h-screen flex items-center justify-center py-10 px-4">
  <div class="w-full max-w-3xl bg-white shadow-md rounded-xl p-8">
    <h1 class="text-2xl font-bold mb-6 text-green-600 text-center">Customize Your Meal Plan</h1>
    
    <form method="POST" action="{{ route('subscription') }}" class="space-y-6">
      @csrf

      <div>
        <label for="name" class="block font-semibold mb-1">Name*</label>
        <input type="text" id="name" placeholder="Enter your name" required
          class="w-full px-4 py-2 border border-gray-300 rounded-md " />
      </div>

      <div>
        <label for="phone" class="block font-semibold mb-1">Phone Number*</label>
        <input type="tel" id="phone" placeholder="Enter your phone number" required
          class="w-full px-4 py-2 border border-gray-300 rounded-md " />
      </div>

      <div>
        <label class="block font-semibold mb-2">Plan</label>
        <div class="space-y-4">
          <div class="flex items-start space-x-3">
            <input type="radio" id="diet" name="plan" value="Diet" checked class="mt-1">
            <label for="diet">
              <strong>Diet Plan</strong><br>
              <span class="text-sm text-gray-600">Balanced meals for everyday health</span>
            </label>
          </div>
          <div class="flex items-start space-x-3">
            <input type="radio" id="protein" name="plan" value="Protein" class="mt-1">
            <label for="protein">
              <strong>Protein Plan</strong><br>
              <span class="text-sm text-gray-600">High-protein meals for fitness enthusiasts</span>
            </label>
          </div>
          <div class="flex items-start space-x-3">
            <input type="radio" id="royal" name="plan" value="Royal" class="mt-1">
            <label for="royal">
              <strong>Royal Plan</strong><br>
              <span class="text-sm text-gray-600">Premium meals with gourmet ingredients</span>
            </label>
          </div>
        </div>
      </div>

      <div>
        <label class="block font-semibold mb-2">Select Meal Types (at least 1)</label>
        <div class="flex flex-wrap gap-4">
          <label><input type="checkbox" name="meal-type" class="mr-1"> Breakfast</label>
          <label><input type="checkbox" name="meal-type" class="mr-1"> Lunch</label>
          <label><input type="checkbox" name="meal-type" class="mr-1"> Dinner</label>
        </div>
      </div>

      <div>
        <label class="block font-semibold mb-2">Select Delivery Days</label>
        <div class="grid grid-cols-2 gap-2 md:grid-cols-3">
          <label><input type="checkbox" name="delivery-day" class="mr-1"> Monday</label>
          <label><input type="checkbox" name="delivery-day" class="mr-1"> Tuesday</label>
          <label><input type="checkbox" name="delivery-day" class="mr-1"> Wednesday</label>
          <label><input type="checkbox" name="delivery-day" class="mr-1"> Thursday</label>
          <label><input type="checkbox" name="delivery-day" class="mr-1"> Friday</label>
          <label><input type="checkbox" name="delivery-day" class="mr-1"> Saturday</label>
          <label><input type="checkbox" name="delivery-day" class="mr-1"> Sunday</label>
        </div>
      </div>

      <div>
        <label for="allergies" class="block font-semibold mb-1">Allergies (optional)</label>
        <textarea id="allergies" placeholder="Type any allergies here..."
          class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-100" rows="3"></textarea>
      </div>

      <div class="bg-green-50 p-4 rounded-md border border-green-200">
        <strong class="block mb-1">Price Calculation</strong>
        <p class="text-sm">Total Price = Plan Price × Number of Meal Types × Number of Delivery Days × 4.3</p>
        <p class="text-sm text-gray-600">Example: Diet Plan (IDR 150,000) × 2 Meal Types × 5 Delivery Days × 4.3 = IDR 6,450,000</p>
      </div>

      <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white py-3 rounded-md font-semibold transition">Subscribe</button>
    </form>
  </div>
</body>
</html>