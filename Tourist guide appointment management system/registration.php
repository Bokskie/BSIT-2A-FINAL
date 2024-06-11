<?php
require 'conn.php';

if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];

    $duplicate = mysqli_query($conn, "SELECT * FROM user_data WHERE username = '$username' OR email = '$email'");

    if(mysqli_num_rows($duplicate) > 0){
        echo "<script> alert('Username or Email Has Already Taken'); </script>";
    } else {
        if($password == $confirmpassword){

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO user_data VALUES('','$username','$email','$hashedPassword')";
            mysqli_query($conn, $query);

            echo "<script>alert('Register Successfully'); window.location='adminprofile.php';</script>";
        } else {
            echo "<script> alert('Password Does Not Match'); </script>";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourism Management System</title>

    <link rel="icon" type="image/x-icon" href="./image/logo.jpg">

    <link rel="stylesheet" type="text/css" href="./style/index.css">

</head>
<body>

    <div class="registraion-system">
        <div class="registraion-form_section">
            <div class="header_branch-title">
                <img src="./image/logo.jpg" alt=""> 
                <div class="brance-name">Tourism Management</div>
            </div>

            <div class="header-title_section">Sign-up</div>

            <form action="" method="post">
                <input type="text" id="username" name="username" placeholder="Username" required>
                <input type="email" id="email" name="email" placeholder="Email" required>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <input type="password" id="confirmpassword" name="confirmpassword" placeholder="ConfirmPassword" required>

                <button type="submit" name="submit">Register</button>
            </form>

            <div class="registration-link">Already have an account? Click to <a href="./login.php">Sign-in!</a></div>
        </div>
    </div>
    
</body>
</html>