<?php
session_start();

// Nyahaktifkan auto-redirect supaya index.php sentiasa terbuka
/*
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: hotel_list.php");
    exit();
}
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Hotel System</title>
    <link rel="stylesheet" href="style.css?v=3">
</head>

<body class="login-page">

    <div class="login-container">
        <div class="login-card">
            <div class="login-icon">
                🏨
            </div>

            <h2>Hotel Database</h2>

            <p class="login-subtitle">
                Admin Login
            </p>

            <?php if (isset($_GET['error'])): ?>
                <p class="login-error">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </p>
            <?php endif; ?>

            <form action="login_process.php" method="POST">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Enter your username"
                        required>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        required>
                </div>

                <button
                    type="submit"
                    name="login"
                    class="login-button">
                    Login
                </button>
            </form>

            <p class="login-footer">
                Hotel Management System
            </p>
        </div>
    </div>

</body>

</html>