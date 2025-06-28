<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <title>SEA Catering – User Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>

<body class="bg-green-100 text-gray-800">

  <!-- Navbar -->
  <header class="bg-white shadow">
    @include('components.navbar')
  </header>

  <div class="max-w-5xl mx-auto mt-5 space-y-10">
    <!-- Header -->
    <div class="text-center">
      <h1 class="text-5xl font-bold text-green-800 drop-shadow-sm">👋 Welcome, <span id="userName">User</span></h1>
      <p class="text-green-700 text-lg mt-2">Your SEA Catering dashboard</p>
    </div>

    <!-- Active Subscription -->
    <div id="activeSubscription" class="rounded-3xl p-8 border-l-4 border-green-600 bg-white shadow hover:shadow-lg transition">
      <p class="text-gray-500 italic">Loading subscription...</p>
    </div>

    <!-- Pause Subscription -->
    <div class="rounded-3xl p-8 border-l-4 border-yellow-400 bg-white shadow hover:shadow-lg transition">
      <div class="flex items-center mb-6 gap-4">
        <div class="text-4xl">⏸️</div>
        <h2 class="text-2xl font-bold text-yellow-600">Pause Subscription</h2>
      </div>
      <form class="grid sm:grid-cols-2 gap-6" id="pauseForm">
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-600">Pause From</label>
          <input name="pause_from" type="date" required class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-yellow-400 focus:outline-none">
        </div>
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-600">Pause Until</label>
          <input name="pause_until" type="date" required class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-yellow-400 focus:outline-none">
        </div>
        <div class="col-span-2 text-right">
          <button type="submit" class="mt-4 px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-xl shadow-lg transition">Pause</button>
        </div>
      </form>
    </div>

    <!-- Cancel Subscription -->
    <div class="rounded-3xl p-8 border-l-4 border-red-500 bg-white shadow hover:shadow-lg transition">
      <div class="flex items-center mb-6 gap-4">
        <div class="text-4xl">❌</div>
        <h2 class="text-2xl font-bold text-red-600">Cancel Subscription</h2>
      </div>
      <p class="text-gray-600 mb-4 text-sm sm:text-base">Once canceled, you will no longer receive meals. This action is irreversible.</p>
      <button id="cancelButton" class="px-6 py-3 bg-red-500 hover:bg-red-600 text-white rounded-xl shadow-lg transition">
        Cancel My Subscription
      </button>
    </div>
  </div>

  <!-- Script -->
  <script>
    document.addEventListener('DOMContentLoaded', async () => {
      const token = localStorage.getItem('token');
      const name = localStorage.getItem('user_name');
      if (name) document.getElementById('userName').textContent = name;

      const container = document.getElementById('activeSubscription');
      const cancelButton = document.getElementById('cancelButton');
      let subscriptionId = null;

      if (!token) {
        container.innerHTML = "<p class='text-red-500'>You are not logged in.</p>";
        return;
      }

      try {
        const response = await fetch("http://127.0.0.1:8000/api/subscriptions", {
          headers: {
            'Authorization': 'Bearer ' + token,
            'Accept': 'application/json'
          }
        });

        const result = await response.json();

        if (!result.status || result.data.length === 0) {
          container.innerHTML = `<p class="text-gray-600">You have no active subscriptions.</p>`;
          return;
        }

        const sub = result.data[0];
        subscriptionId = sub.id;
        const plan = sub.plan;
        const mealTypes = Array.isArray(sub.meal_types) ? sub.meal_types : JSON.parse(sub.meal_types || "[]");
        const deliveryDays = Array.isArray(sub.delivery_days) ? sub.delivery_days : JSON.parse(sub.delivery_days || "[]");
        const price = parseInt(plan.price || 0);
        const total = price * mealTypes.length * deliveryDays.length * 4.3;

        const statusDisplay = {
          'ACTIVE': { color: 'text-green-600', icon: '✅' },
          'PAUSED': { color: 'text-yellow-600', icon: '⏸️' },
          'CANCELED': { color: 'text-red-600', icon: '❌' }
        };

        const statusInfo = statusDisplay[sub.status] || { color: 'text-gray-600', icon: 'ℹ️' };

        container.innerHTML = `
          <div class="flex items-center mb-6 gap-4">
            <div class="text-4xl">📦</div>
            <h2 class="text-2xl font-bold text-green-700">Active Subscription</h2>
          </div>
          <div class="grid md:grid-cols-2 gap-4 text-gray-700 text-sm sm:text-base">
            <p><strong>Plan:</strong> ${plan.name}</p>
            <p><strong>Meal Types:</strong> ${mealTypes.join(", ")}</p>
            <p><strong>Delivery Days:</strong> ${deliveryDays.join(", ")}</p>
            <p><strong>Price Per Meal:</strong> Rp${price.toLocaleString()}</p>
            <p><strong>Total Price:</strong> Rp${total.toLocaleString()} / week</p>
            <p><strong>Status:</strong> <span class="${statusInfo.color} font-semibold">${statusInfo.icon} ${sub.status}</span></p>
          </div>
        `;
      } catch (err) {
        container.innerHTML = `<p class="text-red-500">Error fetching subscription data.</p>`;
        console.error(err);
      }

      // Pause Subscription
      const pauseForm = document.getElementById('pauseForm');
      pauseForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(pauseForm);
        const pauseFrom = formData.get('pause_from');
        const pauseUntil = formData.get('pause_until');
        if (!pauseFrom || !pauseUntil || !subscriptionId) return alert('Please fill in all fields.');

        try {
          const res = await fetch(`http://127.0.0.1:8000/api/subscriptions/${subscriptionId}/pause`, {
            method: "PUT",
            headers: {
              "Authorization": "Bearer " + token,
              "Content-Type": "application/json",
              "Accept": "application/json"
            },
            body: JSON.stringify({ pause_from: pauseFrom, pause_until: pauseUntil })
          });

          const result = await res.json();
          if (result.status) {
            alert("Subscription paused successfully.");
            location.reload();
          } else {
            alert("Failed to pause subscription: " + (result.message || "Unknown error"));
          }
        } catch (error) {
          alert("Error during pause request.");
          console.error(error);
        }
      });

      // Cancel Subscription
      cancelButton.addEventListener('click', async () => {
        if (!subscriptionId || !confirm("Are you sure you want to cancel your subscription?")) return;
        try {
          const res = await fetch(`http://127.0.0.1:8000/api/subscriptions/${subscriptionId}/cancel`, {
            method: "PUT",
            headers: {
              "Authorization": "Bearer " + token,
              "Accept": "application/json"
            }
          });
          const result = await res.json();
          if (result.status) {
            alert("Subscription canceled successfully.");
            location.reload();
          } else {
            alert("Failed to cancel: " + (result.message || "Unknown error"));
          }
        } catch (err) {
          alert("Error canceling subscription.");
          console.error(err);
        }
      });

    });
  </script>
</body>
</html>
