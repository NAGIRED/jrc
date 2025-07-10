<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
include 'db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM construction_items WHERE id = $id");
$item = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_name = $conn->real_escape_string($_POST['item_name']);
    $description = $conn->real_escape_string($_POST['description']);
    $quantity = intval($_POST['quantity']);
    $unit = $conn->real_escape_string($_POST['unit']);
    $cost = floatval($_POST['cost']);
    $status = $conn->real_escape_string($_POST['status']);

    $conn->query("UPDATE construction_items SET 
      item_name='$item_name', 
      description='$description', 
      quantity=$quantity, 
      unit='$unit', 
      cost=$cost, 
      status='$status'
      WHERE id = $id");

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Edit Construction Item</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f4f6f9;
      display: flex;
    }

    .sidebar {
      width: 240px;
      background-color: #1e1e2f;
      height: 100vh;
      color: #fff;
      padding: 30px 20px;
      position: fixed;
      top: 0;
      left: 0;
    }

    .sidebar h2 {
      font-size: 24px;
      margin-bottom: 30px;
    }

    .sidebar a {
      display: block;
      padding: 10px;
      margin: 10px 0;
      color: #ccc;
      text-decoration: none;
      border-radius: 6px;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background-color: #4e73df;
      color: #fff;
    }

    .main-content {
      margin-left: 240px;
      padding: 40px;
      width: 100%;
    }

    .form-wrapper {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
      max-width: 600px;
      margin: auto;
    }

    .form-wrapper h2 {
      margin-bottom: 25px;
    }
  </style>
</head>
<body>
<!-- <nav class="sidebar">
  <h2>My Dashboard</h2>
  <a href="dashboard.php" class="active"><i class="fas fa-home"></i> Home</a>
  <a href="./contact.html"><i class="fas fa-user"></i> Profile</a>
  <a href="index.php"><i class="fas fa-box"></i> Product view</a>
  <a href="./enter.html"><i class="fas fa-file-invoice"></i> View Bills</a>
  <a href="./grap.html"><i class="fas fa-chart-bar"></i> Reports</a>
  
   
  <a href="logout.php" title="Logout">
    <i class="fas fa-sign-out-alt" ></i>Logout
  </a>


</nav> -->

  <main class="main-content">
    <div class="form-wrapper">
      <h2>Edit Construction Item</h2>
      <form method="POST">
        <div class="mb-3">
          <label class="form-label">Item Name</label>
          <input name="item_name" class="form-control" value="<?= htmlspecialchars($item['item_name']) ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control"><?= htmlspecialchars($item['description']) ?></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Quantity</label>
          <input name="quantity" type="number" class="form-control" value="<?= $item['quantity'] ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Unit</label>
          <input name="unit" class="form-control" value="<?= htmlspecialchars($item['unit']) ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Cost (₹)</label>
          <input name="cost" type="number" step="0.01" class="form-control" value="<?= $item['cost'] ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Status</label>
          <select name="status" class="form-select">
            <option <?= $item['status'] == 'Available' ? 'selected' : '' ?>>Available</option>
            <option <?= $item['status'] == 'Low Stock' ? 'selected' : '' ?>>Low Stock</option>
            <option <?= $item['status'] == 'Out of Stock' ? 'selected' : '' ?>>Out of Stock</option>
          </select>
        </div>

        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-primary">Update Item</button>
          <a href="index.php" class="btn btn-secondary">Cancel</a>
        </div>
      </form>
    </div>
  </main>

</body>
</html>
