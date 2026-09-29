<?php
session_start();
include 'db.php'; // Sambungkan ke database

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Semak data dalam jadual 'admin'
    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Jika username & password BETUL
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username']  = $username;

        header("Location: hotel_list.php");
        exit();
    } else {
        // Jika SALAH
        header("Location: index.php?error=Invalid username or password!");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
