<?php include 'db.php'; $msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $mobile = $_POST['mobile'];

    $stmt = $conn->prepare("INSERT INTO users (email, first_name, last_name, password, mobile) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $email, $fname, $lname, $password, $mobile);

    if ($stmt->execute()) {
        $msg = "Signup successful. <a href='login.php'>Login</a>";
    } else {
        $msg = "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
    <h2>Signup</h2>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="first_name" placeholder="First Name" required>
        <input type="text" name="last_name" placeholder="Last Name" required>
        <input type="text" name="mobile" placeholder="Mobile Number" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Sign Up</button>
    </form>
    <p class="msg"><?= $msg ?></p>
    <p>Already have an account? <a href="login.php">Login</a></p>
</div>
</body>
</html>
