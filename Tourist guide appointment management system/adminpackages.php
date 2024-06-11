<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourism Management System</title>
    <link rel="icon" type="image/x-icon" href="./image/logo.jpg">
    <link rel="stylesheet" type="text/css" href="style/admin/admin.css">
    <link rel="stylesheet" type="text/css" href="style/admin/adminpackages.css">
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
                <a class="sidebar-packages_button" href="adminpackages.php">
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
            <div class="adminpackages">
                <div class="adminpackages-header_title-button">
                    <div class="adminpackages-header">PACKAGES</div>
                    <button onclick="toggleForm()"><i class="fa fa-plus" aria-hidden="true"></i>
                    New</button>
                </div>
                <div class="adminpackages-content">
                    
                    <div class="overlay" id="overlay" onclick="toggleForm()"></div>

                    <div class="form-container" id="crudForm">
                        <button class="close-button" onclick="toggleForm()">X</button>
                        <form class="packages-form" id="packageForm">
                            <input type="hidden" id="packageId">
                            <label for="image">Image:</label>
                            <input type="file" id="image" name="image" required><br><br>
                            <label for="date_created">Date Created:</label>
                            <input type="date" id="date_created" name="date_created" required><br><br>
                            <label for="package">Package:</label>
                            <input type="text" id="package" name="package" required><br><br>
                            <label for="description">Description:</label><br>
                            <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>
                            <button type="button" onclick="createOrUpdate()">Save</button>
                            <button type="button" onclick="resetForm()">Clear</button>
                        </form>
                    </div>

                    <hr>

                    <table class="dataTable" id="dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Date Created</th>
                                <th>Package</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <div id="pagination">
                        <button onclick="prevPage()">Prev</button>
                        <span id="pageCount">Page 1 of X</span>
                        <button onclick="nextPage()">Next</button>
                        <div id="pageNumbers"></div>    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="javascript/adminpackages.js"></script>
</body>
</html>
