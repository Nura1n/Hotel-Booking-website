<?php
include 'db.php';

if (isset($_POST['submit'])) {

    $username     = $_POST['username'];
    $password     = $_POST['password'];
    $email        = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $hotel_name   = $_POST['hotel_name'];
    $type_of_room = $_POST['type_of_room'];

    // Prepared statement memasukkan rekod ke jadual 'user'
    $stmt = $conn->prepare("INSERT INTO user 
                            (Username, Password, Email, Phone_Number, Hotel_Name, Type_Of_Room)
                            VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssss", $username, $password, $email, $phone_number, $hotel_name, $type_of_room);

    if ($stmt->execute()) {
        header("Location: user.php");
        exit();
    } else {
        echo "<script>alert('Error SQL Insert: " . addslashes($stmt->error) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="ms">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
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

        h2 {
            text-align: center;
            color: #8d0811;
            margin-top: 0;
            margin-bottom: 25px;
            font-size: 28px;
        }

        form {
            width: 100%;
            max-width: 500px;
            background: #eafea9;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
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
            transition: 0.2s;
        }

        input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }

        button {
            width: 100%;
            padding: 13px;
            margin-top: 10px;
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

        button:active {
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

    <form method="POST" autocomplete="off">

        <h2>Add Customer</h2>

        <label>Username:</label>
        <input type="text" name="username" autocomplete="off" required>

        <label>Password:</label>
        <input type="password" name="password" autocomplete="new-password" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Phone Number:</label>
        <input type="text" name="phone_number" required>

        <label>Hotel Name:</label>
        <input type="text" name="hotel_name" required>

        <label>Type Of Room:</label>
        <input type="text" name="type_of_room" required>

        <button type="submit" name="submit">Add Customer</button>

    </form>

</body>

</html>