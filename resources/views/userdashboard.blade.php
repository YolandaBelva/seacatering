<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SEA Catering – User Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }

    .glass-card {
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.4));
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .glass-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
    }

    .glow-left {
      border-left: 4px solid;
      padding-left: 1rem;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-indigo-100 min-h-screen p-8">

  <div class="max-w-5xl mx-auto space-y-10">
    <!-- Header -->
    <div class="text-center">
      <h1 class="text-5xl font-bold text-indigo-800 drop-shadow-sm">👋 Welcome, Yolanda</h1>
      <p class="text-gray-500 text-lg mt-2">Your personalized SEA Catering dashboard</p>
    </div>

    <!-- Active Subscription -->
    <div class="glass-card rounded-3xl p-8 glow-left border-indigo-400">
      <div class="flex items-center mb-6 gap-4">
        <div class="text-4xl">📦</div>
        <h2 class="text-2xl font-bold text-indigo-700">Active Subscription</h2>
      </div>
      <div class="grid md:grid-cols-2 gap-4 text-gray-700 text-sm sm:text-base">
        <p><strong>Plan:</strong> Weekly Deluxe</p>
        <p><strong>Meal Types:</strong> Vegan, Low Carb</p>
        <p><strong>Delivery Days:</strong> Mon, Wed, Fri</p>
        <p><strong>Total Price:</strong> $49.99/week</p>
        <p><strong>Status:</strong> <span class="text-green-600 font-semibold">✅ Active</span></p>
      </div>
    </div>

    <!-- Pause Subscription -->
    <div class="glass-card rounded-3xl p-8 glow-left border-yellow-400">
      <div class="flex items-center mb-6 gap-4">
        <div class="text-4xl">⏸️</div>
        <h2 class="text-2xl font-bold text-yellow-600">Pause Subscription</h2>
      </div>
      <form class="grid sm:grid-cols-2 gap-6">
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-600">Pause From</label>
          <input type="date" class="w-full p-3 border border-gray-300 rounded-xl focus:ring-yellow-400 focus:outline-none">
        </div>
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-600">Pause Until</label>
          <input type="date" class="w-full p-3 border border-gray-300 rounded-xl focus:ring-yellow-400 focus:outline-none">
        </div>
        <div class="col-span-2 text-right">
          <button type="submit" class="mt-4 px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-xl shadow-lg">Pause</button>
        </div>
      </form>
    </div>

    <!-- Cancel Subscription -->
    <div class="glass-card rounded-3xl p-8 glow-left border-red-500">
      <div class="flex items-center mb-6 gap-4">
        <div class="text-4xl">❌</div>
        <h2 class="text-2xl font-bold text-red-600">Cancel Subscription</h2>
      </div>
      <p class="text-gray-600 mb-4 text-sm sm:text-base">Once canceled, you will no longer receive meals. This action is irreversible.</p>
      <button onclick="confirm('Are you sure you want to cancel?')" class="px-6 py-3 bg-red-500 hover:bg-red-600 text-white rounded-xl shadow-lg">
        Cancel My Subscription
      </button>
    </div>
  </div>

</body>
</html>
