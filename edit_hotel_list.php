<?php
include 'db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: hotel_list.php");
    exit();
}

$id = intval($_GET['id']);

if (isset($_POST['update'])) {

    $hotel_name   = $_POST['hotel_name'];
    $hotel_email  = $_POST['hotel_email'];
    $address      = $_POST['address'];
    $type_of_room = $_POST['type_of_room'];
    $star_rating  = $_POST['star_rating'];
    $price_range  = $_POST['price_range'];

    $stmt = $conn->prepare("UPDATE hotel_list SET 
                            Hotel_Name = ?, 
                            Hotel_Email = ?, 
                            Address = ?, 
                            Type_Of_Room = ?, 
                            Star_Rating = ?, 
                            Price_Range = ? 
                            WHERE id = ?");

    $stmt->bind_param("ssssssi", $hotel_name, $hotel_email, $address, $type_of_room, $star_rating, $price_range, $id);

    if ($stmt->execute()) {
        header("Location: hotel_list.php");
        exit();
    } else {
        echo "<script>alert('Error SQL Update: " . addslashes($stmt->error) . "');</script>";
    }
}

// Ambil data hotel dari database berdasarkan ID
$stmt_fetch = $conn->prepare("SELECT * FROM hotel_list WHERE id = ?");
$stmt_fetch->bind_param("i", $id);
$stmt_fetch->execute();
$result = $stmt_fetch->get_result();

if (!$result || $result->num_rows == 0) {
    echo "Data hotel tidak dijumpai!";
    exit();
}

$row = $result->fetch_assoc();
$r = array_change_key_case($row, CASE_LOWER);
?>

<!DOCTYPE html>
<html lang="ms">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Hotel</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: #8d0811;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        form {
            width: 100%;
            max-width: 550px;
            background: #eafea9;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            color: #334155;
            font-size: 14px;
            font-weight: 600;
        }

        h2 {
            text-align: center;
            color: #8d0811;
            margin-top: 0;
            margin-bottom: 25px;
            font-size: 28px;
        }

        label {
            display: block;
            margin-top: 10px;
            margin-bottom: 5px;
            color: #334155;
            font-size: 14px;
            font-weight: 600;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"] {
            width: 100%;
            padding: 12px 14px;
            margin-bottom: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            color: #1e293b;
            background-color: #ffffff;
            outline: none;
            transition: 0.2s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="number"]:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }

        input[name="id"] {
            background-color: #e2e8f0;
            color: #64748b;
            cursor: not-allowed;
        }

        input[type="submit"] {
            width: 100%;
            padding: 13px;
            margin-top: 15px;
            border: none;
            border-radius: 9px;
            background: #8d0811;
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
        }

        input[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(141, 8, 17, 0.35);
        }

        input[type="submit"]:active {
            transform: translateY(0);
        }

        @media (max-width: 600px) {
            body {
                padding: 20px;
            }

            form {
                padding: 25px 20px;
            }

            h2 {
                font-size: 24px;
            }
        }
    </style>

</head>

<body>

    <form method="post">

        <h2>Edit Hotel</h2>

        <label>ID:</label>
        <input type="text" name="id"
            value="<?php echo htmlspecialchars($r['id'] ?? ''); ?>"
            readonly>

        <label>Hotel Name:</label>
        <input type="text" name="hotel_name"
            value="<?php echo htmlspecialchars($r['hotel_name'] ?? $r['hotel name'] ?? ''); ?>"
            required>

        <label>Hotel Email:</label>
        <input type="email" name="hotel_email"
            value="<?php echo htmlspecialchars($r['hotel_email'] ?? $r['hotel email'] ?? $r['email'] ?? ''); ?>"
            required>

        <label>Address:</label>
        <input type="text" name="address"
            value="<?php echo htmlspecialchars($r['address'] ?? ''); ?>" required>

        <label>Type Of Room:</label>
        <input type="text" name="type_of_room"
            value="<?php echo htmlspecialchars($r['type_of_room'] ?? $r['type of room'] ?? ''); ?>" required>

        <label>Star Rating:</label>
        <input type="number" name="star_rating" min="1" max="5"
            value="<?php echo htmlspecialchars($r['star_rating'] ?? $r['star rating'] ?? ''); ?>" required>

        <label>Price Range:</label>
        <input type="text" name="price_range"
            value="<?php echo htmlspecialchars($r['price_range'] ?? $r['price range'] ?? ''); ?>" required>

        <input type="submit" name="update" value="Update Hotel">

    </form>

</body>

</html>