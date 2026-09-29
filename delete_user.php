<?php
include 'db.php';

$raw_id = $_POST['id'] ?? $_GET['id'] ?? null;

if ($raw_id !== null && $raw_id !== '') {
    $id = intval($raw_id);

    // Memadam rekod dari jadual 'user'
    $stmt = $conn->prepare("DELETE FROM user WHERE id = ?");

    if ($stmt) {
        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            echo "Error executing delete query: " . $stmt->error;
            $stmt->close();
            exit();
        }

        $stmt->close();
    } else {
        echo "Error preparing SQL: " . $conn->error;
        exit();
    }
}

header("Location: user.php");
exit();
