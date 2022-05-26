<?php
if(isset($_POST["login"])){
    $account = $_POST["account"];
    $pswd = $_POST["password"];
    $role = $_POST["role"];

    if(empty($account) || empty($pswd) || empty($role)){
        header('location: ../index.php?error');
        exit();
    }

    include_once '../include/db.php';
    $conn = getDBconnection();
    login($conn, $account, $pswd, $role);
}

function login($conn, $account, $pswd, $role){
    $user = isUserExist($conn, $account,$pswd, $role);
    if(!$user){
        header('location: ../index.php?error');
        exit();
    }
    session_start();
    if($role == 'staff'){
        $_SESSION["username"] = $user["staffName"];
        $_SESSION["staffID"] = $user["staffID"];
        $_SESSION["role"] = $role;
        header('location: ../staff/index.php');
        exit();
    }else if($role == 'customer'){
        $_SESSION["username"] = $user["customerName"];
        $_SESSION["customerEmail"] = $user["customerEmail"];
        $_SESSION["role"] = $role;
        header('location: ../customer/index.php');
        exit();
    }
}

function isUserExist($conn,$account,$pswd,$role)
{
    $sql = $role == 'staff'?
        "SELECT * FROM staff WHERE staffID = ? AND staffPassword = ?":
        "SELECT * FROM customer WHERE customerEmail = ? AND customerPassword = ?";

        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header('location: ../index.php?error=sql');
            exit();
        }
        mysqli_stmt_bind_param($stmt, "ss", $account,$pswd);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if ($user = mysqli_fetch_array($result)) {
            mysqli_stmt_close($stmt);
            return $user;
        }
        mysqli_stmt_close($stmt);
        return false;
}
?>