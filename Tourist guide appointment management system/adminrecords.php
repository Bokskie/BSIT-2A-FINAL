<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourism Management System</title>

    <link rel="icon" type="image/x-icon" href="./image/logo.jpg">

    <link rel="stylesheet" type="text/css" href="style/admin/admin.css">
    <link rel="stylesheet" type="text/css" href="style/admin/adminrecords.css">

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
            <a class="sidebar-records_button">
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
        <?php
        require 'conn.php';

        if (isset($_POST['action']) && isset($_POST['id'])) {
            $action = $_POST['action'];
            $id = $_POST['id'];

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

        $sql = "SELECT * FROM appointments";
        $result = $conn->query($sql);
        ?>

            <div class="adminrecords">
                
                <div class="title-searchbar_header">
                    <div class="adminrecords-header">RECORDS</div>
                    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for bookings..">
                </div>
        <div class="adminrecords-table-contents">
        <?php if ($result->num_rows > 0) { ?>   
            <table id="appointmentsTable">
                <tr>
                    <th>ID</th>
                    <th>Datetime</th>
                    <th>Username</th>
                    <th>Package</th>
                    <th>Email</th>
                    <th>Number</th>
                    <th>Schedule</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["datetime"]; ?></td>
                        <td><?php echo $row["username"]; ?></td>
                        <td><?php echo $row["package"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo $row["number"]; ?></td>
                        <td class="<?php echo ($row["status"] == 'confirmed' ? 'confirmed' : ($row["status"] == 'cancelled' ? 'cancelled' : 'pending')); ?>"><?php echo $row["status"]; ?></td>
                    </tr>
                <?php } ?>
            </table>
            <div class="pagination">
                <button onclick="prevPage()" id="btnPrev">Prev</button>
                <span id="pageIndicator">Page 1 of X</span> 
                <button onclick="nextPage()" id="btnNext">Next</button>
                <div id="pageNumbers"></div>
            </div>

        <?php } else { ?>
            <p>No appointments found.</p>
        <?php } ?>

        <?php $conn->close(); ?>
    </div>
    </div>
    </div>
</div>

<script>
    const rowsPerPage = 10;
let currentPage = 1;
let allRows = [];

function displayTablePage(page) {
    const table = document.getElementById("appointmentsTable");
    const rows = table.getElementsByTagName("tr");
    const totalRows = allRows.length;
    const totalPages = Math.ceil(totalRows / rowsPerPage);

    for (let i = 1; i < rows.length; i++) {
        rows[i].classList.add("hidden");
    }

    const startRow = (page - 1) * rowsPerPage;
    const endRow = startRow + rowsPerPage;

    for (let i = startRow; i < endRow && i < totalRows; i++) {
        allRows[i].classList.remove("hidden");
    }

    document.getElementById("btnPrev").disabled = page === 1;
    document.getElementById("btnNext").disabled = page === totalPages;

    document.getElementById("pageIndicator").innerText = `Page ${page} of ${totalPages}`;

    createPageNumbers(totalPages);
}

function prevPage() {
    if (currentPage > 1) {
        currentPage--;
        displayTablePage(currentPage);
    }
}

function nextPage() {
    const totalRows = allRows.length;
    const totalPages = Math.ceil(totalRows / rowsPerPage);
    if (currentPage < totalPages) {
        currentPage++;
        displayTablePage(currentPage);
    }
}

function goToPage(page) {
    currentPage = page;
    displayTablePage(page);
}

function createPageNumbers(totalPages) {
    const pageNumbers = document.getElementById("pageNumbers");
    pageNumbers.innerHTML = ''; 

    const importantPages = [1, 10, 50];

    importantPages.forEach(page => {
        if (page <= totalPages) {
            createPageButton(page);
        }
    });
}

function createPageButton(page) {
    const pageButton = document.createElement("button");
    pageButton.textContent = page;
    pageButton.onclick = function() {
        goToPage(page);
    };
    if (page === currentPage) {
        pageButton.classList.add("active");
    }
    document.getElementById("pageNumbers").appendChild(pageButton);
}

function searchTable() {
    const input = document.getElementById("searchInput");
    const filter = input.value.toLowerCase();
    const table = document.getElementById("appointmentsTable");
    const rows = table.getElementsByTagName("tr");

    allRows = [];

    for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName("td");
        let match = false;
        for (let j = 0; j < cells.length; j++) {
            if (cells[j].textContent.toLowerCase().indexOf(filter) > -1) {
                match = true;
                break;
            }
        }
        if (match) {
            allRows.push(rows[i]);
        }
        rows[i].classList.add("hidden");
    }

    currentPage = 1;
    displayTablePage(currentPage);
}

window.onload = function() {
    const table = document.getElementById("appointmentsTable");
    const rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) {
        allRows.push(rows[i]);
    }

    displayTablePage(currentPage);
}

</script>




</body>
</html>
