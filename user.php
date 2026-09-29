<?php
session_start();
include 'db.php';

// Semak jika admin belum login, bawa ke index.php
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ms">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer List</title>
    <link rel="stylesheet" href="style.css?v=3">
</head>

<body>

    <!-- TOP BAR (Log Out) -->
    <div class="top-bar">
        <a href="logout.php" class="btn-logout" onclick="return confirm('Are you sure you want to log out?');">
            🚪 Log Out
        </a>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="nav-brand">
            🏨 Hotel Database
        </div>

        <div class="nav-menu">
            <a href="hotel_list.php" class="nav-btn">🏨 Hotels</a>
            <a href="user.php" class="nav-btn active">👤 Customers</a>
            <a href="add_user.php" class="nav-btn btn-add">+ Add Customer</a>
        </div>
    </nav>

    <!-- PAGE HEADER (Tombol Add Customer di sini telah dibuang) -->
    <div class="header-row">
        <div>
            <h2>Customer List</h2>
            <p>Manage registered customers in the hotel system.</p>
        </div>
    </div>

    <!-- CUSTOMER TABLE -->
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Hotel Name</th>
                <th>Type Of Room</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $query = "SELECT 
                        id, 
                        Username AS username, 
                        Password AS password, 
                        Email AS email, 
                        Phone_Number AS phone_number, 
                        Hotel_Name AS hotel_name, 
                        Type_Of_Room AS type_of_room 
                      FROM user 
                      ORDER BY id ASC";

            $result = $conn->query($query);

            if (!$result) {
                die("Error SQL: " . $conn->error);
            }

            $i = 1;

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id           = htmlspecialchars($row['id'] ?? '', ENT_QUOTES, 'UTF-8');
                    $username     = htmlspecialchars($row['username'] ?? '', ENT_QUOTES, 'UTF-8');
                    $password     = htmlspecialchars($row['password'] ?? '', ENT_QUOTES, 'UTF-8');
                    $email        = htmlspecialchars($row['email'] ?? '', ENT_QUOTES, 'UTF-8');
                    $phone_number = htmlspecialchars($row['phone_number'] ?? '', ENT_QUOTES, 'UTF-8');
                    $hotel_name   = htmlspecialchars($row['hotel_name'] ?? '', ENT_QUOTES, 'UTF-8');
                    $type_of_room = htmlspecialchars($row['type_of_room'] ?? '', ENT_QUOTES, 'UTF-8');
            ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $username; ?></td>
                        <td><?php echo $password; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $phone_number; ?></td>
                        <td><?php echo $hotel_name; ?></td>
                        <td><?php echo $type_of_room; ?></td>
                        <td>
                            <div class="action-cell">
                                <a href="edit_user.php?id=<?php echo urlencode($id); ?>" class="btn-update">
                                    Update
                                </a>

                                <form action="delete_user.php" method="POST" class="inline-form" onsubmit="return confirm('Are you sure you want to delete this customer?');">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <button type="submit" class="btn-delete">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="9" class="empty-message">
                        Tiada data customer dalam database.
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

</body>

</html>