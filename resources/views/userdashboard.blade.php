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

<body class="bg-green-50 text-gray-800 min-h-screen">

  <!-- Navbar -->
  <header class="bg-white shadow">
    @include('components.navbar')
  </header>

  <main class="max-w-5xl mx-auto mt-8 px-4 space-y-10">
    <!-- Header -->
    <div class="text-center">
      <h1 class="text-4xl md:text-5xl font-bold text-green-800 drop-shadow-sm">👋 Welcome, <span id="userName">User</span></h1>
      <p class="text-green-700 text-lg mt-2">Manage your SEA Catering subscriptions below</p>
    </div>

    <!-- Subscriptions List -->
    <div id="subscriptionsContainer" class="space-y-8">
      <p class="text-gray-500 italic">Loading subscriptions...</p>
    </div>
  </main>

  <!-- Script -->
  <script>
    document.addEventListener('DOMContentLoaded', async () => {
      const token = localStorage.getItem('token');
      const name = localStorage.getItem('user_name');
      if (name) document.getElementById('userName').textContent = name;

      const container = document.getElementById('subscriptionsContainer');

      if (!token) {
        container.innerHTML = "<p class='text-red-500'>You are not logged in.</p>";
        return;
      }

      try {
        // const response = await fetch("http://127.0.0.1:8000/api/subscriptions", {
        const response = await fetch("http://seacatering.my.id/api/subscriptions", {
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

        container.innerHTML = ""; // clear loading

        result.data.forEach(sub => {
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

          // Subscription Card HTML
          const card = document.createElement('div');
          card.className = "rounded-3xl p-6 border-l-4 border-green-600 bg-white shadow hover:shadow-lg transition";

          card.innerHTML = `
            <div class="flex justify-between items-center mb-4">
              <div class="flex items-center gap-3">
                <div class="text-3xl">📦</div>
                <h2 class="text-xl md:text-2xl font-bold text-green-700">Subscription #${sub.id}</h2>
              </div>
              <span class="${statusInfo.color} font-semibold text-sm md:text-base">${statusInfo.icon} ${sub.status}</span>
            </div>

            <div class="grid sm:grid-cols-2 gap-3 text-gray-700 text-sm md:text-base mb-4">
              <p><strong>Plan:</strong> ${plan.name}</p>
              <p><strong>Meal Types:</strong> ${mealTypes.join(", ")}</p>
              <p><strong>Delivery Days:</strong> ${deliveryDays.join(", ")}</p>
              <p><strong>Price Per Meal:</strong> Rp${price.toLocaleString()}</p>
              <p class="sm:col-span-2"><strong>Total Price:</strong> Rp${total.toLocaleString()} / week</p>
            </div>

            <form class="pauseForm grid sm:grid-cols-2 gap-4 mb-4" data-id="${sub.id}">
              <div>
                <label class="block mb-1 text-sm font-medium text-gray-600">Pause From</label>
                <input name="pause_from" type="date" required class="w-full p-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-yellow-400 focus:outline-none">
              </div>
              <div>
                <label class="block mb-1 text-sm font-medium text-gray-600">Pause Until</label>
                <input name="pause_until" type="date" required class="w-full p-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-yellow-400 focus:outline-none">
              </div>
              <div class="col-span-2 text-right">
                <button type="submit" class="mt-2 px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-xl shadow transition">⏸️ Pause</button>
                <button type="button" class="cancelBtn mt-2 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-xl shadow transition" data-id="${sub.id}">❌ Cancel</button>
              </div>
            </form>
          `;

          container.appendChild(card);
        });

        // Pause Subscription Handler
        document.querySelectorAll('.pauseForm').forEach(form => {
          form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const subscriptionId = form.getAttribute('data-id');
            const formData = new FormData(form);
            const pauseFrom = formData.get('pause_from');
            const pauseUntil = formData.get('pause_until');
            if (!pauseFrom || !pauseUntil) return alert('Please fill in both dates.');

            try {
              // const res = await fetch(`http://127.0.0.1:8000/api/subscriptions/${subscriptionId}/pause`, {
              const res = await fetch(`http://seacatering.my.id/api/subscriptions/${subscriptionId}/pause`, {
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
                alert("Failed to pause: " + (result.message || "Unknown error"));
              }
            } catch (err) {
              alert("Error during pause request.");
              console.error(err);
            }
          });
        });

        // Cancel Subscription Handler
        document.querySelectorAll('.cancelBtn').forEach(button => {
          button.addEventListener('click', async () => {
            const subscriptionId = button.getAttribute('data-id');
            if (!confirm("Are you sure you want to cancel this subscription?")) return;

            try {
              // const res = await fetch(`http://127.0.0.1:8000/api/subscriptions/${subscriptionId}/cancel`, {
              const res = await fetch(`http://seacatering.my.id/api/subscriptions/${subscriptionId}/cancel`, {
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

      } catch (err) {
        container.innerHTML = `<p class="text-red-500">Error fetching subscription data.</p>`;
        console.error(err);
      }
    });
  </script>
</body>
</html>
