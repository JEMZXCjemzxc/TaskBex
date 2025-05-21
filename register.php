<?php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = $_POST['name'];
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $username, $email, $password);

    if ($stmt->execute()) {
        header("Location: login.php?registered=true");
    } else {
        $error = "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include "head.php"; ?>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
    <h2 class="text-2xl font-bold text-center mb-6">Register</h2>
    <?php if (!empty($error)): ?>
      <p class="text-red-500 mb-4"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST" action="">
      <input type="text" name="name" placeholder="Full Name" required class="w-full p-2 mb-3 border rounded" />
      <input type="text" name="username" placeholder="Username" required class="w-full p-2 mb-3 border rounded" />
      <input type="email" name="email" placeholder="Email" required class="w-full p-2 mb-3 border rounded" />
      <input type="password" name="password" placeholder="Password" required class="w-full p-2 mb-4 border rounded" />
      <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">Register</button>
    </form>
    <p class="text-center mt-4 text-sm">Already have an account? <a href="login.php" class="text-blue-500 underline">Login here</a></p>
  </div>
</body>
</html>
