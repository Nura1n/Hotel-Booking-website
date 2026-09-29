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
    <title>Hotel List</title>
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
            <a href="hotel_list.php" class="nav-btn active">🏨 Hotels</a>
            <a href="user.php" class="nav-btn">👤 Customers</a>
            <a href="add_hotel_list.php" class="nav-btn btn-add">+ Add Hotel</a>
        </div>
    </nav>

    <!-- PAGE TITLE -->
    <div class="header-row">
        <h2>Hotel List</h2>
    </div>

    <!-- HOTEL TABLE -->
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>ID</th>
                <th>Hotel Name</th>
                <th>Hotel Email</th>
                <th>Address</th>
                <th>Type Of Room</th>
                <th>Star Rating</th>
                <th>Price Range</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $result = $conn->query(
                "SELECT
                    id,
                    Hotel_Name AS hotel_name,
                    Hotel_Email AS hotel_email,
                    Address AS address,
                    Type_Of_Room AS type_of_room,
                    Star_Rating AS star_rating,
                    Price_Range AS price_range
                FROM hotel_list
                ORDER BY id ASC"
            );

            if (!$result) {
                die("Error SQL: " . $conn->error);
            }

            $i = 1;

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id          = htmlspecialchars($row['id'] ?? '');
                    $hotel_name  = htmlspecialchars($row['hotel_name'] ?? '');
                    $hotel_email = htmlspecialchars($row['hotel_email'] ?? '');
                    $address     = htmlspecialchars($row['address'] ?? '');
                    $type_of_room = htmlspecialchars($row['type_of_room'] ?? '');
                    $star_rating = htmlspecialchars($row['star_rating'] ?? '');
                    $price_range = htmlspecialchars($row['price_range'] ?? '');
            ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $hotel_name; ?></td>
                        <td><?php echo $hotel_email; ?></td>
                        <td><?php echo $address; ?></td>
                        <td><?php echo $type_of_room; ?></td>
                        <td><?php echo $star_rating; ?></td>
                        <td><?php echo $price_range; ?></td>
                        <td>
                            <div class="action-cell">
                                <a href="edit_hotel_list.php?id=<?php echo urlencode($id); ?>" class="btn-update">
                                    Update
                                </a>

                                <form action="delete_hotel_list.php" method="POST" class="inline-form" onsubmit="return confirm('Are you sure you want to delete this hotel?');">
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
                        Tiada data hotel dalam database.
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

</body>

</html>