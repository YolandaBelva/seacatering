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
<body class="bg-gradient-to-br from-green-50 via-white to-green-100">

  <!-- Navbar -->
  <header class="bg-white shadow">
    @include('components.navbar')
  </header>

  <div class="max-w-6xl mx-auto mt-5 space-y-10">
    <!-- Header -->
    <div class="text-center">
      <h1 class="text-5xl font-bold text-green-700 drop-shadow-sm">📊 Admin Dashboard</h1>
      <p class="text-gray-500 text-lg mt-2">SEA Catering subscription analytics</p>
      <button onclick="openUserModal()" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 shadow-md">
        👥 Manage Users
      </button>
    </div>

    <!-- Date Range Selector -->
    <div class="glass-card rounded-3xl p-6 glow-left border-green-400">
      <div class="flex items-center gap-4 mb-4">
        <div class="text-3xl">🗓️</div>
        <h2 class="text-xl font-bold text-green-700">Filter by Date Range</h2>
      </div>
      <form id="filterForm" class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
        @csrf
        <div>
          <label class="block text-sm font-medium text-gray-600">Start Date</label>
          <input name="start_date" id="startDate" type="date" required class="w-full p-3 border border-gray-300 rounded-xl focus:ring-green-400 focus:outline-none">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-600">End Date</label>
          <input name="end_date" id="endDate" type="date" required class="w-full p-3 border border-gray-300 rounded-xl focus:ring-green-400 focus:outline-none">
        </div>
        <div class="self-end">
          <button type="submit" class="w-full px-6 py-3 bg-green-500 hover:bg-green-600 text-white rounded-xl shadow-lg">Apply Filter</button>
        </div>
      </form>
    </div>

    <!-- Metrics Cards -->
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="glass-card rounded-3xl p-6 glow-left border-green-500">
        <div class="text-3xl mb-2">🧾</div>
        <h3 class="text-lg font-semibold text-green-700 mb-2">New Subscriptions</h3>
        <p id="newSubscriptionsCount" class="text-3xl font-bold text-gray-800">+0</p>
        <p class="text-sm text-gray-500 mt-2">Based on selected range</p>
      </div>
      <div class="glass-card rounded-3xl p-6 glow-left border-emerald-500">
        <div class="text-3xl mb-2">💰</div>
        <h3 class="text-lg font-semibold text-emerald-700 mb-2">Monthly Revenue</h3>
        <p id="monthlyRevenue" class="text-3xl font-bold text-gray-800">Rp0</p>
        <p class="text-sm text-gray-500 mt-2">This month</p>
      </div>
      <div class="glass-card rounded-3xl p-6 glow-left border-lime-400">
        <div class="text-3xl mb-2">🔁</div>
        <h3 class="text-lg font-semibold text-lime-700 mb-2">Reactivations</h3>
        <p id="reactivationsCount" class="text-3xl font-bold text-gray-800">0</p>
        <p class="text-sm text-gray-500 mt-2">Returned users</p>
      </div>
      <div class="glass-card rounded-3xl p-6 glow-left border-teal-400">
        <div class="text-3xl mb-2">📦</div>
        <h3 class="text-lg font-semibold text-teal-700 mb-2">Active Subscriptions</h3>
        <p id="activeSubscriptionsCount" class="text-3xl font-bold text-gray-800">0</p>
        <p class="text-sm text-gray-500 mt-2">Currently active (all time)</p>
      </div>
    </div>

    <!-- Results Section -->
    <div id="subscriptionResults" class="space-y-4"></div>
  </div>

  <!-- User Modal -->
<!-- After: Modal muncul di tengah -->
<div id="userModal" class="fixed inset-0 z-50 bg-black bg-opacity-40 hidden flex items-center justify-center">
    <div class="bg-white rounded-2xl p-6 w-full max-w-3xl shadow-xl relative">
      <h2 class="text-xl font-bold mb-4 text-green-700">👥 Manage User Roles</h2>
      <button onclick="closeUserModal()" class="absolute top-3 right-4 text-gray-400 text-2xl">&times;</button>
      <div id="userList" class="space-y-4 max-h-[60vh] overflow-y-auto"></div>
    </div>
  </div>

  <script>
    function openUserModal() {
      document.getElementById('userModal').classList.remove('hidden');
      loadUsers();
    }

    function closeUserModal() {
      document.getElementById('userModal').classList.add('hidden');
    }

    async function loadUsers() {
      const token = localStorage.getItem('token');
      const list = document.getElementById('userList');
      list.innerHTML = 'Loading...';

      try {
        // const res = await fetch(`http://127.0.0.1:8000/api/admin/users`, {
        const res = await fetch(`http://seacatering.my.id/api/admin/users`, {
          headers: {
            'Authorization': 'Bearer ' + token,
            'Accept': 'application/json'
          }
        });
        const data = await res.json();
        list.innerHTML = '';

        if (!data.status || !data.users.length) {
          list.innerHTML = '<p class="text-gray-600">No users found.</p>';
          return;
        }

        data.users.forEach(user => {
          const row = document.createElement('div');
          row.className = "flex justify-between items-center p-3 bg-gray-100 rounded-xl";
          row.innerHTML = `
            <div>
              <p class="font-semibold text-gray-800">${user.name}</p>
              <p class="text-sm text-gray-500">${user.email}</p>
            </div>
            <select onchange="changeUserRole(${user.id}, this.value)" class="p-2 rounded-md border border-gray-300">
              <option value="USER" ${user.role === 'USER' ? 'selected' : ''}>USER</option>
              <option value="ADMIN" ${user.role === 'ADMIN' ? 'selected' : ''}>ADMIN</option>
            </select>
          `;
          list.appendChild(row);
        });
      } catch (err) {
        console.error('Failed to load users:', err);
        list.innerHTML = '<p class="text-red-500">Failed to load user list.</p>';
      }
    }

    async function changeUserRole(userId, role) {
      const token = localStorage.getItem('token');
      try {
        // const res = await fetch(`http://127.0.0.1:8000/api/admin/users/${userId}/role`, {
        const res = await fetch(`http://seacatering.my.id/api/admin/users/${userId}/role`, {
          method: 'PUT',
          headers: {
            'Authorization': 'Bearer ' + token,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ role })
        });

        const data = await res.json();
        if (data.status) {
          alert('Role updated successfully');
        } else {
          alert('Failed to update role');
        }
      } catch (err) {
        console.error('Error updating role:', err);
        alert('Server error while updating role.');
      }
    }

    document.addEventListener('DOMContentLoaded', async () => {
      const token = localStorage.getItem('token');
      if (!token) return alert("Admin token not found");

      try {
        // const activeRes = await fetch(`http://127.0.0.1:8000/api/admin/active-subscriptions`, {
        const activeRes = await fetch(`http://seacatering.my.id/api/admin/active-subscriptions`, {
          headers: {
            'Authorization': 'Bearer ' + token,
            'Accept': 'application/json'
          }
        });
        const activeData = await activeRes.json();
        document.getElementById('activeSubscriptionsCount').textContent =
          activeData.status ? activeData.active_subscriptions.toLocaleString() : '0';
      } catch (err) {
        console.error('Error loading active subscriptions:', err);
      }
    });

    document.getElementById('filterForm').addEventListener('submit', async function (e) {
      e.preventDefault();

      const startDate = document.getElementById('startDate').value;
      const endDate = document.getElementById('endDate').value;
      const token = localStorage.getItem('token');
      const container = document.getElementById('subscriptionResults');

      if (!startDate || !endDate) return alert("Please select both dates.");

      try {
        // const response = await fetch(`http://127.0.0.1:8000/api/admin/subscriptions?start_date=${startDate}&end_date=${endDate}`, {
        const response = await fetch(`http://seacatering.my.id/api/admin/subscriptions?start_date=${startDate}&end_date=${endDate}`, {
          headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
        });
        const result = await response.json();
        container.innerHTML = '';

        if (!result.status || result.data.length === 0) {
          container.innerHTML = '<p class="text-center text-gray-600">No subscriptions found.</p>';
          document.getElementById('newSubscriptionsCount').textContent = '+0';
        } else {
          document.getElementById('newSubscriptionsCount').textContent = `+${result.data.length}`;
          result.data.forEach(sub => {
            const plan = sub.plan?.name || '-';
            const user = sub.user?.name || '-';
            const statusColor = {
              'ACTIVE': 'text-green-600',
              'PAUSED': 'text-yellow-600',
              'CANCELED': 'text-red-600'
            }[sub.status] || 'text-gray-600';
            const card = `
              <div class="glass-card rounded-3xl p-6 glow-left border border-gray-200">
                <div class="flex justify-between items-center mb-2">
                  <h3 class="font-bold text-lg text-gray-800">📄 ${plan} – <span class="text-sm text-gray-500">${user}</span></h3>
                  <span class="text-sm font-semibold ${statusColor}">${sub.status}</span>
                </div>
                <p class="text-sm text-gray-600">Started at: ${new Date(sub.created_at).toLocaleDateString()}</p>
              </div>
            `;
            container.innerHTML += card;
          });
        }

        // const revenueRes = await fetch(`http://127.0.0.1:8000/api/admin/revenue?start_date=${startDate}&end_date=${endDate}`, {
        const revenueRes = await fetch(`http://seacatering.my.id/api/admin/revenue?start_date=${startDate}&end_date=${endDate}`, {
          headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
        });
        const revenueData = await revenueRes.json();
        document.getElementById('monthlyRevenue').textContent =
          revenueData.status ? `Rp${parseInt(revenueData.revenue).toLocaleString()}` : 'Rp0';

        // const reactivationRes = await fetch(`http://127.0.0.1:8000/api/admin/reactivations?start_date=${startDate}&end_date=${endDate}`, {
        const reactivationRes = await fetch(`http://seacatering.my.id/api/admin/reactivations?start_date=${startDate}&end_date=${endDate}`, {
          headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
        });
        const reactivationData = await reactivationRes.json();
        document.getElementById('reactivationsCount').textContent =
          reactivationData.status ? reactivationData.reactivations : '0';
      } catch (err) {
        console.error(err);
        alert('Failed to fetch dashboard data.');
      }
    });
  </script>
</body>
</html>
