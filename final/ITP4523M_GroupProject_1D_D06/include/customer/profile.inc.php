<?php
include "../db.php";
$conn = getDBconnection();
session_start();
// check if the user has clicked the editAccount button
if(isset($_POST["editAccount"])){
    extract($_POST);
    // get customer's email from session
    $customerEmail = $_SESSION["customerEmail"];

    // update customer's information
    $sql = "UPDATE customer SET customerName='$name',customerPassword='$password',phoneNumber='$phoneNumber',address='$address' 
            WHERE customerEmail = '$customerEmail'";
    mysqli_query($conn, $sql) or die("SQL command fails " . mysqli_error($conn));
    $num = mysqli_affected_rows($conn);
    if($num = 0){
        echo "Record not found";
    }

    // save username to session
    $_SESSION["username"] = $name;
    mysqli_close($conn);
    header("Location: ../../customer/profile.php");
}

// check if the user has clicked the delete button
if(isset($_GET["deleteAccount"])){
    // get customer's email from session
    $customerEmail = $_SESSION["customerEmail"];

    // delete airway bill record based on the user account
    $sqlDeleteAirwaybill = "DELETE FROM airwaybill WHERE customerEmail = '$customerEmail'";

    // delete airway bill record and  airway bill delivery record based on the user account
    $sqlDeletedeliveryRecord = "DELETE airwaybill,airwaybilldeliveryRecord FROM airwaybill
                            INNER JOIN airwaybilldeliveryRecord 
                            WHERE airwaybill.airWaybillNo = airwaybilldeliveryRecord.airWaybillNo AND airwaybill.customerEmail = '$customerEmail'";
    // delete user's account
    $sqlDeleteAccount = "DELETE FROM customer WHERE customerEmail = '$customerEmail'";

    // turn off foreign key constraint
    mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=0") or die("SQL command fails " . mysqli_error($conn));
    mysqli_query($conn, $sqlDeletedeliveryRecord) or die("SQL command fails " . mysqli_error($conn));
    mysqli_query($conn, $sqlDeleteAirwaybill) or die("SQL command fails " . mysqli_error($conn));
    mysqli_query($conn, $sqlDeleteAccount) or die("SQL command fails " . mysqli_error($conn));
    // turn on foreign key constraint
    mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=1") or die("SQL command fails " . mysqli_error($conn));
    $num = mysqli_affected_rows($conn);
    if($num = 0){
        echo "Record not found";
    }

    // destroy session data
    session_start();
    session_unset();
    session_destroy();
    mysqli_close($conn);
    header("Location: ../../index.php");
}
?>
