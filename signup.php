<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "user_auth";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data
$user = $_POST['username'];
$email = $_POST['email'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash password

// Insert into database
$sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $user, $email, $pass);

if ($stmt->execute()) {
  echo "Signup successful. <a href='login.html'>Login here</a>";
} else {
  echo "Error: " . $stmt->error;
}

$conn->close();
?>
