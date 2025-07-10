<?php
include 'db.php';
 
$id = intval($_GET['id']);
$conn->query("DELETE FROM construction_items WHERE id = $id");

header("Location: index.php");
exit;

?>
