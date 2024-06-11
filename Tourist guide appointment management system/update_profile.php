<?php
require 'conn.php';


if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["id"];

if (isset($_POST["submit"])) {

    $new_username = $_POST["username"];
    $new_email = $_POST["email"];
    $new_password = $_POST["password"];


    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
    } else {

        $query = "SELECT password FROM `user_data` WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];
    }


    $query = "UPDATE `user_data` SET username=?, email=?, password=? WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi", $new_username, $new_email, $hashed_password, $user_id);
    if ($stmt->execute()) {
        echo "<script>alert('Update successful!'); window.location='adminprofile.php';</script>";
        exit;
    } else {
        echo "Sorry, there was an error updating your profile.";
    }
}
?>
