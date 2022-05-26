<?php
session_start();
if (!isset($_SESSION["username"])) {
  header("location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" >
    <link rel="stylesheet" href="../assets/css/staff/staff.css">
    <link rel="stylesheet" href="../assets/css/staff/home.css">
    <link rel="stylesheet" href="../assets/css/staff/tableStyle.css">
    <link rel="stylesheet" href="../assets/css/staff/formStyle.css">
    <script
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"
    ></script>
    <title>EDE Limited Internal Control</title>
</head>

<body>
<div class="d-flex">
    <div id="sidebar">
        <!--create the left sidebar's button-->
        <ul>
            <li><a href="../staff/index.php"><img src="../assets/img/building.png" alt="">EDE Limited</a></li>
            <li><a href="../staff/bill.php"><img src="../assets/img/contract.png" alt="">Air Waybill</a></li>
            <li><a href="../staff/record.php"><img src="../assets/img/history.png" alt="">Delivery Record</a></li>
            <li><a href="../staff/report.php"><img src="../assets/img/report.png" alt="">Report</a></li>
        </ul>
        <a href="../include/logout.inc.php" class="logout-link"><img src="../assets/img/exit.png" alt="">Log out</a>
    </div>

    <main id="main">
        <div id="topbar">
            <!--            the menu button-->
            <button id="sidebar-btn" type="button"><img src="../assets/img/menu.png" alt=""></button>
            <!--            the top right corner shows user information-->
            <div class="topbar-left-container">
                <button id="icon-btn"><img src="../assets/img/profo.png" alt="" class="avatar"></button>
                <span class="name"><?php echo $_SESSION["username"] ?></span>
            </div>
        </div>