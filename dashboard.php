<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$name = htmlspecialchars($_SESSION['name']);
$username = htmlspecialchars($_SESSION['username']);
$email = htmlspecialchars($_SESSION['email']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TaskBex Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

  <!-- Sidebar -->
  <div class="flex">
    <div class="w-64 h-screen bg-blue-900 text-white flex flex-col">
      <div class="px-6 py-4 text-2xl font-bold border-b border-blue-700">
        TaskBex
      </div>
      <div class="flex-1 p-6">
        <p class="text-white font-semibold mb-4">Welcome, <?= $name ?></p>
        <ul class="space-y-3">
          <li><a href="#" class="block text-white hover:text-blue-300">Dashboard</a></li>
          <li><a href="#" class="block text-white hover:text-blue-300">Call Logs</a></li>
          <li><a href="#" class="block text-white hover:text-blue-300">Tickets</a></li>
          <li><a href="#" class="block text-white hover:text-blue-300">Analytics</a></li>
        </ul>
      </div>
      <div class="p-6 border-t border-blue-700">
        <a href="logout.php" class="block text-red-300 hover:text-red-500">Logout</a>
      </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8">
      <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard Overview</h1>
        <p class="text-gray-600">Manage your call center activity and performance here.</p>
      </div>

      <!-- Metrics -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow">
          <h2 class="text-xl font-semibold text-gray-800">Calls Handled</h2>
          <p class="text-3xl text-blue-600 font-bold mt-2">154</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
          <h2 class="text-xl font-semibold text-gray-800">Pending Tickets</h2>
          <p class="text-3xl text-yellow-500 font-bold mt-2">12</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
          <h2 class="text-xl font-semibold text-gray-800">Avg. Response Time</h2>
          <p class="text-3xl text-green-600 font-bold mt-2">1m 45s</p>
        </div>
      </div>

      <!-- User Info Card -->
      <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold text-gray-800 mb-2">User Info</h3>
        <p><strong>Name:</strong> <?= $name ?></p>
        <p><strong>Username:</strong> <?= $username ?></p>
        <p><strong>Email:</strong> <?= $email ?></p>
      </div>
    </div>
  </div>

</body>
</html>
