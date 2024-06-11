<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourism Management System</title>

    <link rel="icon" type="image/x-icon" href="./image/logo.jpg">

    <link rel="stylesheet" type="text/css" href="style/admin/admin.css">
    <link rel="stylesheet" type="text/css" href="style/admin/adminprofile.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

<div class="main-container">
    <div class="sidebar" id="sidebar">
            <ul>
                <a href="adminpage.php">
                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                    <div class="sidebar-paragraph">Dashboard</div>
                </a>
                <a href="adminpackages.php">
                    <i class="fa fa-th" aria-hidden="true"></i>
                    <div class="sidebar-paragraph">Packages</div>
                </a>
                <a href="adminappointments.php">
                    <i class="fa fa-address-book" aria-hidden="true"></i>
                    <div class="sidebar-paragraph">Appointments</div>
                </a>
                <a href="adminrecords.php">
                    <i class="fa fa-book" aria-hidden="true"></i><div class="sidebar-paragraph">Records</div>
                </a>
                <a class="sidebar-profile_button" href="adminprofile.php">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <div class="sidebar-paragraph">Profile</div>
                </a>
            </ul>
    </div>

    <div class="header" id="header">
        <div class="header-margin">
            <div class="header-logo">
                <img src="image/logo.jpg" alt="">
                <div class="header-title">Tourism Management</div>
            </div>
            <a class="header-logout" href="login.php">
                <i class="fa fa-sign-out" aria-hidden="true"></i>Logout
            </a>
        </div>
    </div>

    <div class="main-content" id="main-content">

        <?php
                    require 'conn.php';

                    if (!isset($_SESSION["login"])) {
                        header("Location: login.php");
                        exit;
                    }

                    $user_id = $_SESSION["id"];

                    $query = "SELECT * FROM `user_data` WHERE id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    ?>
                    <div class="profile">
                        <div class="profile-page">
                        <div class="profile-page_header"><i class="fa fa-user" aria-hidden="true"></i> PROFILE</div>
                        
                        <div class="current-profile">
                            <div class="current-profile_header">Current Profile</div>
                            <p><strong>Username:</strong> <?php echo htmlspecialchars($row['username']); ?></p>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                            <p><strong>Password (Hashed):</strong> <?php echo htmlspecialchars($row['password']); ?></p>
                        </div>

                        <div class="update-profile_header">Update Your Profile</div>
                        <form action="update_profile.php" method="post" enctype="multipart/form-data">
                            <input type="text" name="username" placeholder="New Username" required value="<?php echo htmlspecialchars($row['username']); ?>"><br>
                            <input type="email" name="email" placeholder="New Email" required value="<?php echo htmlspecialchars($row['email']); ?>"><br>
                            <input type="password" name="password" placeholder="New Password" required><br>
                            <button type="submit" name="submit">Update Profile</button>
                            <a class="registerbutton" href="registration.php">Register Account</a>
                        </form>
                    </div>
                </div>
    </div>
</div>



</body>
</html>
