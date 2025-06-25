<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SEA Catering – Admin Dashboard</title>
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
<body class="bg-gradient-to-br from-purple-50 via-white to-indigo-100 min-h-screen p-8">

  <div class="max-w-6xl mx-auto space-y-10">
    <!-- Header -->
    <div class="text-center">
      <h1 class="text-5xl font-bold text-indigo-800 drop-shadow-sm">📊 Admin Dashboard</h1>
      <p class="text-gray-500 text-lg mt-2">SEA Catering subscription analytics</p>
    </div>

    <!-- Date Range Selector -->
    <div class="glass-card rounded-3xl p-6 glow-left border-indigo-400">
      <div class="flex items-center gap-4 mb-4">
        <div class="text-3xl">📅</div>
        <h2 class="text-xl font-bold text-indigo-700">Filter by Date Range</h2>
      </div>
      <form class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-600">Start Date</label>
          <input type="date" class="w-full p-3 border border-gray-300 rounded-xl focus:ring-indigo-400 focus:outline-none">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-600">End Date</label>
          <input type="date" class="w-full p-3 border border-gray-300 rounded-xl focus:ring-indigo-400 focus:outline-none">
        </div>
        <div class="self-end">
          <button type="submit" class="w-full px-6 py-3 bg-indigo-500 hover:bg-indigo-600 text-white rounded-xl shadow-lg">Apply Filter</button>
        </div>
      </form>
    </div>

    <!-- Metrics Cards -->
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
      <!-- New Subscriptions -->
      <div class="glass-card rounded-3xl p-6 glow-left border-green-500">
        <div class="text-3xl mb-2">🧾</div>
        <h3 class="text-lg font-semibold text-green-700 mb-2">New Subscriptions</h3>
        <p class="text-3xl font-bold text-gray-800">+327</p>
        <p class="text-sm text-gray-500 mt-2">Last 30 days</p>
      </div>

      <!-- Monthly Recurring Revenue -->
      <div class="glass-card rounded-3xl p-6 glow-left border-blue-500">
        <div class="text-3xl mb-2">💰</div>
        <h3 class="text-lg font-semibold text-blue-700 mb-2">Monthly Recurring Revenue</h3>
        <p class="text-3xl font-bold text-gray-800">$12,530</p>
        <p class="text-sm text-gray-500 mt-2">This month</p>
      </div>

      <!-- Reactivations -->
      <div class="glass-card rounded-3xl p-6 glow-left border-yellow-400">
        <div class="text-3xl mb-2">🔁</div>
        <h3 class="text-lg font-semibold text-yellow-600 mb-2">Reactivations</h3>
        <p class="text-3xl font-bold text-gray-800">52</p>
        <p class="text-sm text-gray-500 mt-2">Returned users</p>
      </div>

      <!-- Active Subscriptions -->
      <div class="glass-card rounded-3xl p-6 glow-left border-purple-500">
        <div class="text-3xl mb-2">📦</div>
        <h3 class="text-lg font-semibold text-purple-600 mb-2">Active Subscriptions</h3>
        <p class="text-3xl font-bold text-gray-800">1,208</p>
        <p class="text-sm text-gray-500 mt-2">Currently active</p>
      </div>
    </div>
  </div>

</body>
</html>
