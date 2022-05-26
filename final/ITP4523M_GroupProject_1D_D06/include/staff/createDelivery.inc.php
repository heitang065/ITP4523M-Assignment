<?php
include "../db.php";
$conn = getDBconnection();
extract($_POST);
$sql = "SELECT * FROM airwaybill WHERE airWayBillNo = '$airWaybillNo'";
$result = mysqli_query($conn, $sql) or die("SQL command fails " . mysqli_error($conn));
$num = mysqli_num_rows($result);

//if there is no record then redirect to record page
if ($num <= 0) {
    header("Location: ../../staff/record.php?error");
    exit();
}

//if status at 1 and 2 no need to enter the location
if($status == 1 || $status == 2){
    $sql = "INSERT INTO airwaybilldeliveryrecord(airWaybillDeliveryRecordID, airWaybillNo,
        deliveryStatusID, recordDateTime, currentLocation) 
        VALUES (null,'$airWaybillNo','$status',now(),null)";
}else{
    //if information is wrong
    if(empty($location)){
        header("Location: ../../staff/record.php?empty");
        exit();
    }
    $sql = "INSERT INTO airwaybilldeliveryrecord(airWaybillDeliveryRecordID, airWaybillNo,
        deliveryStatusID, recordDateTime, currentLocation) 
        VALUES (null,'$airWaybillNo','$status',now(),'$location')";
}
mysqli_query($conn, $sql) or die("SQL command fails " . mysqli_error($conn));
$num = mysqli_affected_rows($conn);
if($num = 0){
    echo "Record not found";
}
mysqli_close($conn);
header("Location: ../../staff/record.php");
?>
