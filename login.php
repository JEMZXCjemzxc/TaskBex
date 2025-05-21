<?php
session_start();
include "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usernameOrEmail = $_POST['username_or_email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, name, username, email, password FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $name, $username, $email, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include "head.php"; ?>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
    <h2 class="text-2xl font-bold text-center mb-6">Login</h2>
    <?php if (!empty($error)): ?>
      <p class="text-red-500 mb-4"><?= $error ?></p>
    <?php endif; ?>
    <?php if (isset($_GET['registered'])): ?>
      <p class="text-green-500 mb-4">Registration successful! Please log in.</p>
    <?php endif; ?>
    <form method="POST" action="">
      <input type="text" name="username_or_email" placeholder="Username or Email" required class="w-full p-2 mb-3 border rounded" />
      <input type="password" name="password" placeholder="Password" required class="w-full p-2 mb-4 border rounded" />
      <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">Login</button>
    </form>
    <p class="text-center mt-4 text-sm">Don't have an account? <a href="register.php" class="text-blue-500 underline">Register here</a></p>
  </div>
</body>
</html>
