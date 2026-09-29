<?php
include 'db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: user.php");
    exit();
}

$id = intval($_GET['id']);

if (isset($_POST['update'])) {

    $username     = $_POST['username'];
    $password     = $_POST['password'];
    $email        = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $hotel_name   = $_POST['hotel_name'];
    $type_of_room = $_POST['type_of_room'];

    // Prepared statement mengemas kini jadual 'user'
    $stmt = $conn->prepare("UPDATE user SET 
                            Username = ?, 
                            Password = ?, 
                            Email = ?, 
                            Phone_Number = ?, 
                            Hotel_Name = ?, 
                            Type_Of_Room = ? 
                            WHERE id = ?");

    $stmt->bind_param("ssssssi", $username, $password, $email, $phone_number, $hotel_name, $type_of_room, $id);

    if ($stmt->execute()) {
        header("Location: user.php");
        exit();
    } else {
        echo "<script>alert('Error SQL Update: " . addslashes($stmt->error) . "');</script>";
    }
}

// Mengambil data spesifik mengikut ID dari jadual 'user'
$stmt_fetch = $conn->prepare("SELECT * FROM user WHERE id = ?");
$stmt_fetch->bind_param("i", $id);
$stmt_fetch->execute();
$result = $stmt_fetch->get_result();

if (!$result || $result->num_rows == 0) {
    echo "User data not found!";
    exit();
}

$row = $result->fetch_assoc();

function getValue($data, ...$keys)
{
    foreach ($keys as $key) {
        if (isset($data[$key])) {
            return $data[$key];
        }
        foreach ($data as $dbKey => $value) {
            if (
                strtolower($dbKey) === strtolower($key) ||
                str_replace('_', '', strtolower($dbKey)) === str_replace('_', '', strtolower($key))
            ) {
                return $value;
            }
        }
    }
    return '';
}

$val_id       = getValue($row, 'id', 'ID');
$val_username = getValue($row, 'username', 'Username');
$val_password = getValue($row, 'password', 'Password');
$val_email    = getValue($row, 'email', 'Email');
$val_phone    = getValue($row, 'phone_number', 'phone_num', 'phonenumber', 'phone', 'Phone_Number', 'Phone');
$val_hotel    = getValue($row, 'hotel_name', 'hotelname', 'hotel', 'Hotel_Name', 'Hotel');
$val_room     = getValue($row, 'type_of_room', 'typeofroom', 'room_type', 'roomtype', 'Type_Of_Room', 'Room_Type');
?>

<!DOCTYPE html>
<html lang="ms">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>

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
            max-width: 500px;
            background: #eafea9;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        h2 {
            margin-top: 0;
            margin-bottom: 20px;
            color: #8d0811;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-size: 14px;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            margin-bottom: 15px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
        }

        input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }

        .id-box {
            background-color: #e2e8f0;
            color: #64748b;
            cursor: not-allowed;
        }

        button {
            width: 100%;
            padding: 13px;
            margin-top: 5px;
            border: none;
            border-radius: 9px;
            background: #8d0811;
            color: white;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(141, 8, 17, 0.35);
        }

        .back-button {
            display: block;
            width: 100%;
            padding: 13px;
            margin-top: 10px;
            text-align: center;
            text-decoration: none;
            background: #cbd5e1;
            color: #334155;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 600;
            transition: 0.2s;
        }

        .back-button:hover {
            background: #94a3b8;
            color: white;
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

        <h2>Edit Customer</h2>

        <label>ID:</label>
        <input
            type="text"
            value="<?php echo htmlspecialchars($val_id); ?>"
            class="id-box"
            readonly>

        <label>Username:</label>
        <input
            type="text"
            name="username"
            value="<?php echo htmlspecialchars($val_username); ?>"
            required>

        <label>Password:</label>
        <input
            type="text"
            name="password"
            value="<?php echo htmlspecialchars($val_password); ?>"
            required>

        <label>Email:</label>
        <input
            type="email"
            name="email"
            value="<?php echo htmlspecialchars($val_email); ?>"
            required>

        <label>Phone Number:</label>
        <input
            type="text"
            name="phone_number"
            value="<?php echo htmlspecialchars($val_phone); ?>">

        <label>Hotel Name:</label>
        <input
            type="text"
            name="hotel_name"
            value="<?php echo htmlspecialchars($val_hotel); ?>">

        <label>Type Of Room:</label>
        <input
            type="text"
            name="type_of_room"
            value="<?php echo htmlspecialchars($val_room); ?>">

        <button type="submit" name="update">Update Customer</button>

    </form>

</body>

</html>