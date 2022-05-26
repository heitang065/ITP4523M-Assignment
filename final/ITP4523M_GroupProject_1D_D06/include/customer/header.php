<?php
session_start();
if(!isset($_SESSION["username"])) {
    header("location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eastern Delivery Express System</title>
    <script
            src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"
    ></script>
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
            crossorigin="anonymous"
    />
    <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"
    ></script>
    <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap"
            rel="stylesheet"
    />
    <script src="https://kit.fontawesome.com/1fe43f3190.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/customer/common.css">
    <link rel="stylesheet" href="../assets/css/customer/customer.css">
</head>
<body>
<div class="d-flex">
    <div id="sidebar">
        <ul>
            <li><a href="index.php"><i class="fas fa-building"></i>EDE Limited</a></li>
            <li><a href="profile.php"><i class="fas fa-user-circle"></i>My Profile</a></li>
            <li><a href="createDelivery.php"><i class="fas fa-truck"></i>Create Delivery Request</a></li>
            <li><a href="record.php"><i class="fas fa-history"></i>Track Delivery Status</a></li>
        </ul>
        <a href="../include/logout.inc.php" class="logout-link"><i class="fas fa-sign-out-alt"></i>Log Out</a>
    </div>

    <main id="main">
        <div id="topbar">
            <button id="sidebar-btn" type="button"><i class="fas fa-bars"></i></button>
            <div class="topbar-left-container">
                <button id="icon-btn" type="button">
                    <img src="https://www.w3schools.com/howto/img_avatar.png" alt="" class="avatar"/>
                </button>
                <span class="name"><?php echo $_SESSION["username"]?></span>
                <button id="switch-btn">
                    <span id="round"></span>
                </button>
                <div id="icon-menu">
                    <a href="profile.php">Your Profile</a>
                    <a href="../include/logout.inc.php">Sign out</a>
                </div>
            </div>
        </div>