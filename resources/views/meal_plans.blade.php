<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SEA Catering - Meal Plans</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-100 text-gray-800">

  <!-- Header -->
  <header class="bg-white shadow">
    @include('components.navbar')
  </header>

  <!-- Section -->
  <section class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
    <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12">
      <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-700">
        Meal Plans for Every Lifestyle
      </h2>
      <p class="mb-5 font-light text-gray-500 sm:text-xl">
        SEA Catering offers tailored meal plans to help you stay healthy, energized, and on track with your dietary goals.
      </p>
    </div>

    <div id="mealPlansContainer" class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">
      <!-- Dynamic content from API will be inserted here -->
    </div>
  </section>

  <!-- Modal -->
  <!-- Modal -->
<div id="detailModal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center overflow-y-auto px-4 py-8">
  <div class="bg-white p-6 rounded-lg max-w-md w-full relative max-h-screen overflow-y-auto">
    <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-black text-xl">&times;</button>
    <h2 id="modalTitle" class="text-2xl font-bold mb-2"></h2>
    <img id="modalImage" class="w-full h-auto object-cover rounded mb-4" />
    <p id="modalDescription" class="text-gray-700 mb-2"></p>
    <div id="modalLongDescription" class="text-gray-700 mb-4 text-sm space-y-2"></div>
    <ul id="modalFeatures" class="text-sm text-gray-600 list-disc pl-5 mb-4"></ul>
    <div class="text-lg font-bold text-green-600" id="modalPrice"></div>
  </div>
</div>


  <script>
    let mealPlanData = [];

    async function fetchMealPlans() {
      const container = document.getElementById('mealPlansContainer');

      try {
        // const response = await fetch('http://127.0.0.1:8000/api/mealplans');
        const response = await fetch('http://seacatering.my.id/api/mealplans');
        const result = await response.json();
        const data = result.data || result;

        mealPlanData = data;

        if (!Array.isArray(data)) {
          container.innerHTML = '<p class="text-red-500">Data tidak valid dari API.</p>';
          return;
        }

        data.forEach(plan => {
          const featuresList = JSON.parse(plan.features || '[]')
            .map(feature => `
              <li class="flex items-center space-x-3">
                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"/>
                </svg>
                <span>${feature}</span>
              </li>
            `).join('');

          const card = `
            <div class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow">
              <img src="/assets/${plan.image_url}" alt="${plan.name}" class="rounded-lg mb-4 object-cover h-40 w-full">
              <h3 class="mb-4 text-2xl font-semibold">${plan.name}</h3>
              <p class="font-light text-gray-500 sm:text-lg">${plan.description}</p>
              <div class="flex justify-center items-baseline my-5">
                <span class="mr-2 text-3xl font-extrabold">Rp${parseInt(plan.price).toLocaleString('id-ID')}</span>
                <span class="text-gray-500">/meal</span>
              </div>
              <ul class="mb-8 space-y-4 text-left text-sm text-gray-500">
                ${featuresList}
              </ul>
              <button onclick="openModal(${plan.id})"
                class="text-white bg-green-500 hover:bg-green-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Lihat Detail
              </button>
            </div>
          `;
          container.innerHTML += card;
        });

      } catch (error) {
        container.innerHTML = '<p class="text-red-500">Gagal memuat meal plans.</p>';
        console.error('Error fetching meal plans:', error);
      }
    }

    function openModal(id) {
      const plan = mealPlanData.find(p => p.id === id);
      if (!plan) return alert('Data tidak ditemukan');

      document.getElementById('modalTitle').textContent = plan.name;
      document.getElementById('modalDescription').textContent = plan.description;
      document.getElementById('modalLongDescription').innerHTML = plan.long_description || '-';
      document.getElementById('modalImage').src = `/assets/${plan.image_url}`;
      document.getElementById('modalPrice').textContent = `Rp${parseInt(plan.price).toLocaleString('id-ID')} / Meal`;

      const features = JSON.parse(plan.features || '[]');
      document.getElementById('modalFeatures').innerHTML = features.map(f => `<li>${f}</li>`).join('');

      document.getElementById('detailModal').classList.remove('hidden');
    }

    function closeModal() {
      document.getElementById('detailModal').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', fetchMealPlans);
  </script>
</body>
</html>
