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

    <form id="subscriptionForm" class="space-y-6">
      @csrf

      <div>
        <label for="name" class="block font-semibold mb-1">Name*</label>
        <input type="text" id="name" name="name" readonly
          class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-100 text-gray-600">
      </div>

      <div>
        <label for="phone" class="block font-semibold mb-1">Phone Number*</label>
        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required
          class="w-full px-4 py-2 border border-gray-300 rounded-md">
      </div>

      <div>
        <label class="block font-semibold mb-2">Select a Plan*</label>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="planContainer">
          <!-- Plans will be rendered dynamically here -->
        </div>
      </div>

      <div>
        <label class="block font-semibold mb-2">Select Meal Types (min. 1)</label>
        <div class="flex gap-4 flex-wrap">
          @foreach (['Breakfast', 'Lunch', 'Dinner'] as $meal)
            <label><input type="checkbox" name="meal_type" value="{{ $meal }}" class="mr-1"> {{ $meal }}</label>
          @endforeach
        </div>
      </div>

      <div>
        <label class="block font-semibold mb-2">Select Delivery Days (min. 1)</label>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
          @foreach (['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
            <label><input type="checkbox" name="delivery_day" value="{{ $day }}" class="mr-1"> {{ $day }}</label>
          @endforeach
        </div>
      </div>

      <div>
        <label for="allergies" class="block font-semibold mb-1">Allergies (optional)</label>
        <textarea id="allergies" name="allergies" class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-100" rows="3" placeholder="Type any allergies..."></textarea>
      </div>

      <div class="bg-green-50 p-4 rounded-md border border-green-200">
        <strong class="block mb-1">💡 Price Calculation</strong>
        <div id="priceDetails" class="text-sm text-gray-700 space-y-1">
          <p>Plan Price: Rp0</p>
          <p>Meal Types: 0</p>
          <p>Delivery Days: 0</p>
          <p id="priceFormula" class="font-medium">Total = 0 × 0 × 0 × 4.3 = Rp0</p>
        </div>
      </div>



      <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white py-3 rounded-md font-semibold transition">Subscribe</button>
    </form>
  </div>

  <!-- JavaScript -->
  <script>
document.addEventListener('DOMContentLoaded', async () => {
  const nameField = document.getElementById('name');
  const storedName = localStorage.getItem('user_name');
  console.log("Stored Name:", storedName);
  if (storedName) {
    nameField.value = storedName;
  } else {
    alert("⚠️ Anda belum login. Nama tidak tersedia.");
  }

  const planContainer = document.querySelector('.grid.grid-cols-1.md\\:grid-cols-3'); // container radio plan
  const form = document.getElementById('subscriptionForm');
  const totalPriceEl = document.getElementById('totalPrice');
  let planPrices = {}; // simpan id dan harga

  // Ambil data meal plans dari API
  try {
    const response = await fetch('http://127.0.0.1:8000/api/mealplans', {
      headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.getItem('token'),
      }
    });
    const result = await response.json();
    console.log("API Response:", result);
    if (result.status && result.data) {
      planContainer.innerHTML = ''; 

      result.data.forEach((plan, index) => {
          planPrices[plan.id] = parseFloat(plan.price);
          const id = plan.id;
      
        const checked = index === 0 ? 'checked' : '';

        const html = `
          <label class="cursor-pointer relative">
            <input type="radio" name="plan_id" value="${plan.id}" class="sr-only peer" id="${id}" ${checked}>
            <div class="p-6 rounded-xl bg-white outline outline-2 outline-white shadow-xl peer-checked:ring-4 peer-checked:ring-green-400">
              <h3 class="text-lg font-bold mb-2 text-center text-green-700">${plan.name}</h3>
              <p class="text-sm text-gray-600 text-center">${plan.description}</p>
              <p class="text-xs text-center text-gray-500 mt-2">Rp${parseInt(plan.price).toLocaleString()}</p>
            </div>
          </label>
        `;
        planContainer.insertAdjacentHTML('beforeend', html);
      });

      calculatePrice();
    } else {
      alert("⚠️ Gagal mengambil data meal plans.");
    }
  } catch (err) {
    alert("⚠️ Error saat mengambil meal plans: " + err.message);
  }

  function calculatePrice() {
  const planId = document.querySelector('input[name="plan_id"]:checked')?.value;
  const planPrice = planPrices[planId] || 0;
  const mealTypes = Array.from(document.querySelectorAll('input[name="meal_type"]:checked')).map(cb => cb.value);
  const deliveryDays = Array.from(document.querySelectorAll('input[name="delivery_day"]:checked')).map(cb => cb.value);
  const multiplier = 4.3;
  const total = planPrice * mealTypes.length * deliveryDays.length * multiplier;

  // Update elemen
  const detailsEl = document.getElementById('priceDetails');
  if (detailsEl) {
    detailsEl.innerHTML = `
      <p>Plan Price: Rp${Math.round(planPrice).toLocaleString()}</p>
      <p>Meal Types: ${mealTypes.join(', ') || '-'}</p>
      <p>Delivery Days: ${deliveryDays.join(', ') || '-'}</p>
      <p id="priceFormula" class="font-medium">Total: Rp${Math.round(total).toLocaleString()}</p>
    `;
  }
}



  // Kalkulasi ulang saat ada perubahan
  document.addEventListener('change', (e) => {
    if (
      e.target.name === 'plan_id' ||
      e.target.name === 'meal_type' ||
      e.target.name === 'delivery_day'
    ) {
      calculatePrice();
    }
  });

  // Submit form
  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const phone = document.getElementById('phone').value;
    const allergies = document.getElementById('allergies').value;
    const planId = document.querySelector('input[name="plan_id"]:checked')?.value;
    const mealTypes = Array.from(document.querySelectorAll('input[name="meal_type"]:checked')).map(cb => cb.value);
    const deliveryDays = Array.from(document.querySelectorAll('input[name="delivery_day"]:checked')).map(cb => cb.value);

    if (!planId || mealTypes.length === 0 || deliveryDays.length === 0) {
      alert("❌ Pastikan semua kolom telah dipilih dengan benar.");
      return;
    }

    try {
      const res = await fetch("/api/subscriptions", {
        method: "POST",
        headers: {
          'Authorization': 'Bearer ' + localStorage.getItem('token'),
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
        body: JSON.stringify({
          phone: phone,
          plan_id: planId,
          meal_types: mealTypes,
          delivery_days: deliveryDays,
          allergies: allergies
        })
      });

      const result = await res.json();
      if (res.ok) {
        alert("✅ Subscription berhasil!");
        form.reset();
        calculatePrice(); // reset harga juga
      } else {
        alert("❌ Gagal: " + (result.message || "Terjadi kesalahan"));
      }

    } catch (err) {
      alert("⚠️ Error: " + err.message);
    }
  });
});
</script>

</body>
</html>