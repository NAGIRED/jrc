<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "user_auth";

// Connect to MySQL
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$user = $_POST['username'];
$pass = $_POST['password'];

// Get user from DB
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $row = $result->fetch_assoc();
  if (password_verify($pass, $row['password'])) {
    echo "Login successful. Welcome, " . htmlspecialchars($user) . "!";
  } else {
    echo "Incorrect password.";
  }
} else {
  echo "User not found.";
}

$conn->close();
?>
