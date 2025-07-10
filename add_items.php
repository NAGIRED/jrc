<?php
// Connect to DB
$conn = new mysqli("localhost", "root", "", "your_database_name");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $item_name = $conn->real_escape_string($_POST['item_name']);
  $description = $conn->real_escape_string($_POST['description']);
  $quantity = intval($_POST['quantity']);
  $unit = $conn->real_escape_string($_POST['unit']);
  $cost = floatval($_POST['cost']);
  $status = $conn->real_escape_string($_POST['status']);

  $sql = "INSERT INTO construction_items (item_name, description, quantity, unit, cost, status)
          VALUES ('$item_name', '$description', $quantity, '$unit', $cost, '$status')";

  if ($conn->query($sql) === TRUE) {
    header("Location: index.php?success=1");
    exit;
  } else {
    echo "Error: " . $conn->error;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Construction Item</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

<div class="container bg-white p-4 rounded shadow" style="max-width: 600px;">
  <h2 class="mb-4">Add New Construction Item</h2>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Item Name</label>
      <input name="item_name" class="form-control" required placeholder="e.g., Cement">
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" placeholder="Enter item description" rows="3"></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Quantity</label>
      <input name="quantity" type="number" class="form-control" required placeholder="e.g., 50">
    </div>

    <div class="mb-3">
      <label class="form-label">Unit</label>
      <input name="unit" class="form-control" required placeholder="e.g., bags, pieces">
    </div>

    <div class="mb-3">
      <label class="form-label">Cost (₹)</label>
      <input name="cost" type="number" step="0.01" class="form-control" required placeholder="e.g., 499.99">
    </div>

    <div class="mb-3">
      <label class="form-label">Status</label>
      <select name="status" class="form-select" required>
        <option value="Available">Available</option>
        <option value="Low Stock">Low Stock</option>
        <option value="Out of Stock">Out of Stock</option>
      </select>
    </div>

    <div class="d-flex justify-content-between">
      <button type="submit" class="btn btn-success w-50 me-2">Add Item</button>
      <a href="index.php" class="btn btn-outline-secondary w-50">Back</a>
    </div>
  </form>
</div>

</body>
</html>
