<?php
include "../db.php";
$conn = getDBconnection();
extract($_POST);
if (empty($weight) || empty($customerEmail)){
    header("Location: ../../staff/bill.php?empty");
    exit();
}else if ($weight > 10){
    header("Location: ../../staff/bill.php?error");
    exit();
}
$sql = "SELECT accountCreationDate FROM customer WHERE customerEmail = '$customerEmail'";
$result = mysqli_query($conn, $sql) or die("SQL command fails " . mysqli_error($conn));
$num = mysqli_num_rows($result);

if ($num > 0) {
    $rs = mysqli_fetch_array($result);
    extract($rs);

    $url = "http://127.0.0.1:8080/api/discountCalculator/$accountCreationDate";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);

    $data = json_decode($response, true);

    $totalFee = 0;
    if($response){
        $weight = ceil($weight);
        $sql = "SELECT rate FROM chargetable WHERE locationID = '$locationID' AND weight = '$weight'";
        $result = mysqli_query($conn, $sql) or die("SQL command fails " . mysqli_error($conn));
        $num = mysqli_num_rows($result);

        // if the information is correct calculate the total fee
        if ($num > 0) {
            $rs = mysqli_fetch_array($result);
            extract($rs);
            $totalFee = $rate * (1 - $data["discount"]);

            // update the new information to the table
            $updateSql = "UPDATE airwaybill SET staffID = '$staffId', weight='$weight',totalPrice='$totalFee' WHERE airWaybillNo='$airWaybillNo'";
            mysqli_query($conn, $updateSql) or die("SQL command fails " . mysqli_error($conn));
            $num = mysqli_affected_rows($conn);
            if($num = 0){
                echo "Record not found";
            }

            header("Location: ../../staff/bill.php");
        }
    }
}
?>