<?php include '../include/customer/header.php' ?>
    <div class="container bg-white mt-3 py-4">
        <h3 class="border-bottom pb-3">Tracking Delivery Status</h3>
        <table id="trackingTable" class="table table-striped bg-white" style="width:100%">
            <thead>
            <tr>
                <th>Air Waybill’s Number</th>
                <th>Record’s Datetime</th>
                <th>Sender’s Name</th>
                <th>Receiver’s Name</th>
                <th>Receiver’s Phone Number</th>
                <th>Parcel’s Weight</th>
                <th>Shipment Status Name</th>
                <th>Current Location</th>
            </tr>
            </thead>
            <tbody>
            <?php
            include_once '../include/db.php';
            $customerEmail = $_SESSION["customerEmail"];

            $conn = getDBconnection();
            $sql = "SELECT * FROM customer,airwaybill,airwaybilldeliveryrecord,deliverystatus
WHERE customer.customerEmail = airwaybill.customerEmail
AND airwaybill.airWaybillNo = airwaybilldeliveryrecord.airWaybillNo
AND airwaybilldeliveryrecord.deliveryStatusID = deliverystatus.deliveryStatusID
AND airwaybill.customerEmail = '$customerEmail' ORDER BY recordDateTime desc";
            $result = mysqli_query($conn, $sql) or die("SQL command fails " . mysqli_error($conn));
            $num = mysqli_num_rows($result);

            while ($rec = mysqli_fetch_assoc($result)) {
                extract($rec);
                $weight != null? $stringWeight = $weight : $stringWeight = "Null";
                $currentLocation != null? $stringLocation = $currentLocation : $stringLocation = "Null";
                echo <<<EOD
            <tr>
                <td>$airWaybillNo</td>
                <td>$recordDateTime</td>
                <td>$customerName</td>
                <td>$receiverName</td>
                <td>$receiverPhoneNumber</td>
                <td>$stringWeight</td>
                <td>$deliveryStatusName</td>
                <td>$stringLocation</td>
            </tr>
EOD;
            }
            mysqli_free_result($result);
            mysqli_close($conn);
            ?>
            </tbody>
        </table>
    </div>
<?php include '../include/customer/footer.php' ?>