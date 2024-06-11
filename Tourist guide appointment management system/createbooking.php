<?php
require 'conn.php';

if (isset($_POST['submit'])) {
    $datetime = $_POST['datetime'];
    $username = $_POST['username'];
    $package = $_POST['package'];
    $email = $_POST['email'];
    $number = $_POST['number'];

    $sql = "INSERT INTO appointments (datetime, username, package, email, number, status) VALUES (?, ?, ?, ?, ?, 'pending')";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("sssss", $datetime, $username, $package, $email, $number);

    if ($stmt->execute()) {
        echo "<div class='message success'>Appointment created successfully!</div>";
    } else {
        echo "<div class='message error'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }

    $stmt->close();
    $conn->close();
}

if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    if ($action == 'confirm') {
        $sql = "UPDATE appointments SET status='confirmed' WHERE id=?";
    } elseif ($action == 'cancel') {
        $sql = "UPDATE appointments SET status='cancelled' WHERE id=?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourism Management System</title>

    <link rel="stylesheet" href="style/createbooking.css" type="text/css">

    <link rel="icon" type="image/x-icon" href="image/logo.jpg">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <div class="create-appointment">
        <div class="header_logo-title">
            <div class="header-logo">
                <img src="image/logo.jpg" alt="">
            </div>
            <div class="header-title">Create Appointment</div>
        </div>
        <form method="post">
            <label for="datetime">Datetime:</label>
            <input type="datetime-local" id="datetime" name="datetime" required>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="package">Package:</label>
            <input type="text" id="package" name="package" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="number">Number:</label>
            <input type="text" id="number" name="number" required>

            <input type="submit" name="submit" value="Submit">
            <a href="viewpackage.html">Back</a>
        </form>
    </div>
</body>
</html>
