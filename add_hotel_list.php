<?php
include 'db.php';

if (isset($_POST['submit'])) {

    $hotel_name = $_POST['hotel_name'];
    $hotel_email = $_POST['hotel_email'];
    $address = $_POST['address'];
    $type_of_room = $_POST['type_of_room'];
    $star_rating = $_POST['star_rating'];
    $price_range = $_POST['price_range'];

    $sql = "INSERT INTO hotel_list
            (Hotel_Name, Hotel_Email, Address, Type_Of_Room, Star_Rating, Price_Range)
            VALUES
            ('$hotel_name', '$hotel_email', '$address', '$type_of_room', '$star_rating', '$price_range')";

    if (mysqli_query($conn, $sql)) {
        header("Location: hotel_list.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Hotel</title>
    <style>
        /* ========================================
           ADD HOTEL PAGE
        ======================================== */

        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #8d0811;
            font-family: Arial, sans-serif;
        }

        /* Main title */
        h2 {
            text-align: center;
            margin-top: 0;
            margin-bottom: 25px;
            color: #8d0811;
            font-size: 28px;
        }

        /* Form container */
        form {
            width: 420px;
            padding: 35px 40px;
            background: #eafea9;
            border-radius: 18px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
            box-sizing: border-box;
        }

        /* Labels */
        label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-size: 14px;
            font-weight: 600;
        }

        /* Text, email and number inputs */
        input[type="text"],
        input[type="email"],
        input[type="number"] {
            width: 100%;
            padding: 12px 14px;
            box-sizing: border-box;
            border: 1px solid #cbd5e1;
            border-radius: 9px;
            background-color: #ffffff;
            color: #1e293b;
            font-size: 14px;
            outline: none;
            transition: 0.3s;
        }

        /* Input focus */
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="number"]:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
        }

        /* Add Hotel button */
        button[type="submit"] {
            width: 100%;
            padding: 13px;
            margin-top: 5px;
            border: none;
            border-radius: 9px;
            background: #8d0811;
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
        }

        /* Button hover */
        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(141, 8, 17, 0.3);
        }

        /* Button click */
        button[type="submit"]:active {
            transform: translateY(0);
        }

        /* Responsive design */
        @media (max-width: 480px) {
            form {
                width: calc(100% - 30px);
                padding: 30px 25px;
            }

            h2 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

    <form method="POST">

        <h2>Add Hotel</h2>

        <label>Hotel Name:</label>
        <input type="text" name="hotel_name" required>
        <br><br>

        <label>Hotel Email:</label>
        <input type="email" name="hotel_email" required>
        <br><br>

        <label>Address:</label>
        <input type="text" name="address" required>
        <br><br>

        <label>Type of Room:</label>
        <input type="text" name="type_of_room" required>
        <br><br>

        <label>Star Rating:</label>
        <input type="number" name="star_rating" min="1" max="5" required>
        <br><br>

        <label>Price Range:</label>
        <input type="number" name="price_range" required>
        <br><br>

        <button type="submit" name="submit">Add Hotel</button>

    </form>

</body>

</html>