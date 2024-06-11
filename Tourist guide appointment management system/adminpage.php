<?php
require 'conn.php';

$sql_pending = "SELECT COUNT(*) as total FROM appointments WHERE status = 'pending'";
$sql_confirmed = "SELECT COUNT(*) as total FROM appointments WHERE status = 'confirmed'";
$sql_cancelled = "SELECT COUNT(*) as total FROM appointments WHERE status = 'cancelled'";

$result_pending = $conn->query($sql_pending);
$result_confirmed = $conn->query($sql_confirmed);
$result_cancelled = $conn->query($sql_cancelled);

$totalPending = ($result_pending->num_rows > 0) ? $result_pending->fetch_assoc()['total'] : 0;
$totalConfirmed = ($result_confirmed->num_rows > 0) ? $result_confirmed->fetch_assoc()['total'] : 0;
$totalCancelled = ($result_cancelled->num_rows > 0) ? $result_cancelled->fetch_assoc()['total'] : 0;

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourism Management System</title>

    <link rel="icon" type="image/x-icon" href="./image/logo.jpg">

    <link rel="stylesheet" type="text/css" href="style/admin/admin.css">
    <link rel="stylesheet" type="text/css" href="style/admin/adminpage.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
<body>

    <div class="main-container">
        <div class="sidebar" id="sidebar">
            <ul>
                <a class="sidebar-dashboard_button" href="adminpage.php">
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
                    <i class="fa fa-book" aria-hidden="true"></i>
                    <div class="sidebar-paragraph">Records</div>
                </a>
                <a href="adminprofile.php">
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
            <div class="dashboard">
            <div class="dashboard-header">DASHBOARD</div>

            <div class="dashboard_toursism-logo">
                <div class="image">
                    <img src="image/agutayan/agutayan.jpg" alt="">
                </div>
                <div class="image">
                    <img src="image/hinaguan/hinaguan.jpg" alt="">
                </div>
                <div class="image">
                    <img src="image/monte/monte1.jpg" alt="">
                </div>
                <div class="image">
                    <img src="image/sophe/sophe.jpg" alt="">
                </div>
                <div class="image">
                    <img src="image/springview/spring-view.jpg" alt="">
                </div>
            </div>

            <div class="dashboard-boxes">
            <div class="dashboard-item">
                <h3>Pending Appointments</h3>
                <p><?php echo $totalPending; ?></p>
            </div>
            <div class="dashboard-item">
                <h3>Confirmed Appointments</h3>
                <p><?php echo $totalConfirmed; ?></p>
            </div>
            <div class="dashboard-item">
                <h3>Cancelled Appointments</h3>
                <p><?php echo $totalCancelled; ?></p>
            </div>
            </div>
        </div>
        </div>



    


    </div>

    
    <script src="javascript/pageSwitcher.js"></script>

    
</body>
</html>
