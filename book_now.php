<?php
session_start();
require "includes/database_connect.php";

$property_id = isset($_GET['property_id']) ? intval($_GET['property_id']) : null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $property_id = mysqli_real_escape_string($conn, $_POST['property_id']);

    $sql = "INSERT INTO bookings (name, email, contact, property_id) VALUES ('$name', '$email', '$contact', '$property_id')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Booking successful!'); window.location.href = 'property_list.php';</script>";
    } else {
        echo "<script>alert('Booking failed: " . mysqli_error($conn) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Now</title>
    <link rel="stylesheet" href="css/book_now.css">
</head>
<body>
    <div class="container">
        <h1>Book Now</h1>
        <form action="book_now.php" method="POST">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" placeholder="Enter your full name" required>
            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            
            <label for="contact">Contact Number</label>
            <input type="text" id="contact" name="contact" placeholder="Enter your contact number" required>
            
            <label for="property_id">Property ID</label>
            <input type="text" id="property_id" name="property_id" value="<?= $property_id ?>" readonly>
            
            <button type="submit" class="btn">Confirm Booking</button>
        </form>
    </div>
</body>
</html>
