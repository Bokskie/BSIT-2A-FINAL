<?php
    require 'conn.php';

    if (isset($_POST["submit"])) {
        $usernameemail = $_POST["usernameemail"];
        $password = $_POST["password"];
    
        $query = "SELECT * FROM `user_data` WHERE username = ? OR email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $usernameemail, $usernameemail);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    
        if ($row && password_verify($password, $row["password"])) {
            session_start();
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            $_SESSION["name"] = $row["name"];
            header("Location: adminpage.php");
            exit;
        } else {
            echo "<script> alert('Invalid username or password'); </script>";
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
    <!-------------------CSS LOGIN INTERFACE STYLE---------------------->
    <link rel="stylesheet" type="text/css" href="./style/index.css">

</head>
<body>

        <div class="login-system">
            <div class="login-form_section">
                <div class="header_branch-title">
                  <img src="./image/logo.jpg" alt=""> 
                  <div class="brance-name">Tourism Management</div>
                </div>

            <div class="header-title_section">Sign-in</div>

            <form  form class="" action="" method="post" autocomplete="off">

            <input type="text" id="usernameemail" name="usernameemail" placeholder="Username" required value="">
            <input type="password" id="password" name="password" placeholder="Password" required value="">

              <button type="submit" name="submit">Login</button>

            </form>

        </div>
    </div>  
</body>
</html>