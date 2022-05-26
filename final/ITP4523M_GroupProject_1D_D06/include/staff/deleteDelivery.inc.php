<?php
include "../db.php";
$conn = getDBconnection();
extract($_GET);
// delete two table record
$sql = "DELETE airwaybill,airwaybilldeliveryRecord FROM airwaybill
        INNER JOIN airwaybilldeliveryRecord WHERE airwaybill.airWaybillNo = airwaybilldeliveryRecord.airWaybillNo
        AND airwaybilldeliveryRecord.airWaybillNo = '$airWaybillNo'";
$sqltwo = "DELETE airwaybill FROM airwaybill WHERE airWaybillNo = '$airWaybillNo'";
mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=0") or die("SQL command fails " . mysqli_error($conn));
mysqli_query($conn, $sql) or die("SQL command fails " . mysqli_error($conn));
mysqli_query($conn, $sqltwo) or die("SQL command fails " . mysqli_error($conn));
mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=1") or die("SQL command fails " . mysqli_error($conn));
$num = mysqli_affected_rows($conn);
if($num = 0){
    echo "Record not found";
}
mysqli_close($conn);
header("Location: ../../staff/bill.php");
?>
