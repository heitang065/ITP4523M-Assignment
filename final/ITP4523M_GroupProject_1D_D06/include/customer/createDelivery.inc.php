<?php
include "../db.php";
$conn = getDBconnection();
extract($_POST);
session_start();
$customerEmail = $_SESSION["customerEmail"];

// insert a new airway bill record
$sql = "INSERT INTO airwaybill(airWaybillNo, customerEmail, staffID, locationID, date, receiverName, 
        receiverPhoneNumber, receiverAddress, weight, totalPrice) 
        VALUES (null,'$customerEmail',null,'$location',now(),'$receiverName','$receiverPhoneNumber','$receiverAddress',null,null)";

// insert a new airwaybilldeliveryrecord
$sql2 = "INSERT INTO `airwaybilldeliveryrecord`(`airWaybillDeliveryRecordID`, `airWaybillNo`, `deliveryStatusID`, `recordDateTime`, `currentLocation`) 
        VALUES (null,LAST_INSERT_ID(),1,now(),null)";
mysqli_query($conn, $sql) or die("SQL command fails " . mysqli_error($conn));
mysqli_query($conn, $sql2) or die("SQL command fails " . mysqli_error($conn));
$num = mysqli_affected_rows($conn);
if($num = 0){
    echo "Record not found";
}
mysqli_close($conn);
header("Location: ../../customer/createDelivery.php");
?>