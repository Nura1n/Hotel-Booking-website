<?php
include 'db.php';

// Ambil ID mentah daripada POST atau GET
$raw_id = $_POST['id'] ?? $_GET['id'] ?? null;

// Semak jika ID wujud dan bukan rentetan kosong
if ($raw_id !== null && $raw_id !== '') {

    // Tukar input kepada nombor bulat (integer) secara paksa untuk keselamatan
    $id = intval($raw_id);

    // Memadam rekod dari jadual 'hotel_list' menggunakan Prepared Statement
    $stmt = $conn->prepare("DELETE FROM hotel_list WHERE id = ?");

    if ($stmt) {
        // Ikat parameter $id sebagai Integer ("i")
        $stmt->bind_param("i", $id);

        // Jalankan arahan pemadaman
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

// Lencongan kembali ke halaman senarai hotel
header("Location: hotel_list.php");
exit();
