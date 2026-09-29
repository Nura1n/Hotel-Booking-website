<?php
include 'db.php';

// Check if 'id' was sent via GET or POST
$id = $_GET['id'] ?? $_POST['id'] ?? null;

if ($id) {
    // Use prepared statements to prevent SQL Injection and syntax errors
    $stmt = $conn->prepare("DELETE FROM hotel_list WHERE id = ?"); // or "DELETE FROM user WHERE id = ?"
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Redirect back to the main list page
header("Location: hotel_list.php"); // change to user.php if deleting from user table
exit();
