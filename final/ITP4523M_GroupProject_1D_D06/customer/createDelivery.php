<?php include '../include/customer/header.php' ?>
    <div class="container bg-white mt-5 py-4">
        <!-- airway bill record section-->
        <div class="d-flex justify-content-between align-items-center border-bottom mb-4 pb-3">
            <h3>AirWaybill</h3>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#createDelivery">
                Create new delivery request
            </button>
        </div>
        <table id="airWaybillTable" class="table table-striped" style="width:100%">
            <thead>
            <tr>
                <th>Air Waybill’s Number</th>
                <th>Sender’s Name</th>
                <th>Receiver’s Name</th>
                <th>Receiver’s Phone Number</th>
                <th>Receiver’s Address</th>
                <th>Location ID</th>
            </tr>
            </thead>
            <tbody>
            <!-- show all record-->
            <?php
            include_once '../include/db.php';
            $customerEmail = $_SESSION["customerEmail"];

            $conn = getDBconnection();
            $sql = "SELECT * FROM airwaybill, customer 
                    WHERE customer.customerEmail = airwaybill.customerEmail
                   AND airwaybill.customerEmail = '$customerEmail'";
            $result = mysqli_query($conn, $sql) or die("SQL command fails " . mysqli_error($conn));
            $num = mysqli_num_rows($result);

            while ($rec = mysqli_fetch_assoc($result)) {
                extract($rec);
                echo <<<EOD
                <tr>
                    <td>$airWaybillNo</td>
                    <td>$customerName</td>
                    <td>$receiverName</td>
                    <td>$receiverPhoneNumber</td>
                    <td>$receiverAddress</td>
                    <td>$locationID</td>
                </tr>
EOD;
            }
            mysqli_free_result($result);
            mysqli_close($conn);
            ?>
            </tbody>
        </table>


        <!-- AirWay bill Delivery record section-->
        <div class="d-flex justify-content-between align-items-center border-bottom mb-4 pb-3" style="margin-top: 100px">
            <h3>AirWaybillDeliveryRecord</h3>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#statusDetail">
                Detail of status ID
            </button>
        </div>
        <table id="deliveryRecordTable" class="table table-striped" style="width:100%">
            <thead>
            <tr>
                <th>Delivery Record ID</th>
                <th>Air Waybill’s Number</th>
                <th>Delivery Status ID</th>
                <th>Record Date Time</th>
                <th>Current Location</th>
            </tr>
            </thead>
            <tbody>
            <!--show all record-->
            <?php
            include_once '../include/db.php';
            $customerEmail = $_SESSION["customerEmail"];

            $conn = getDBconnection();
            $sql = "SELECT * FROM airwaybill,airwaybilldeliveryrecord 
                    WHERE airwaybill.airWaybillNo = airwaybilldeliveryrecord.airWaybillNo
                    AND airwaybill.customerEmail = '$customerEmail'";
            $result = mysqli_query($conn, $sql) or die("SQL command fails " . mysqli_error($conn));
            $num = mysqli_num_rows($result);

            while ($rec = mysqli_fetch_assoc($result)) {
                extract($rec);
                $currentLocation != null? $stringLocation = $currentLocation : $stringLocation = "Null";
                echo <<<EOD
                <tr>
                    <td>$airWaybillDeliveryRecordID</td>
                    <td>$airWaybillNo</td>
                    <td><span class="bg-success rounded px-3 text-white">$deliveryStatusID</span></td>
                    <td>$recordDateTime</td>
                    <td>$stringLocation</td>
                </tr>
EOD;
            }
            mysqli_free_result($result);
            mysqli_close($conn);
            ?>
            </tbody>
        </table>

        <!-- Modal for creating delivery -->
        <div class="modal fade" id="createDelivery" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Create new delivery request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="../include/customer/createDelivery.inc.php">
                            <div class="form-group mt-2">
                                <label for="senderEmail">Sender’s Email</label>
                                <input type="email" class="form-control" id="senderEmail" name="senderEmail" value="<?php echo $_SESSION['customerEmail']?>" disabled>
                            </div>
                            <div class="form-group mt-2">
                                <label for="receiverName">Receiver's Name</label>
                                <input type="text" class="form-control" id="receiverName" name="receiverName" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="receiverPhoneNumber">Receiver's Phone Number</label>
                                <input type="text" class="form-control" id="receiverPhoneNumber" name="receiverPhoneNumber" pattern="[0-9]{8}" title="8 digit eg: 28880000" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="receiverAddress">Receiver's Address</label>
                                <input type="text" class="form-control" id="receiverAddress" name="receiverAddress" required>
                            </div>
                            <div class="form-group">
                                <label for="location">Location ID</label>
                                <select class="form-control" id="location" name="location">
                                    <option value="1">1 (China Shanghai)</option>
                                    <option value="2">2 (Japan)</option>
                                    <option value="3">3 (Australia)</option>
                                </select>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary mt-2 w-100">Submit</button>
                            <button type="reset" class="btn btn-secondary mt-2 w-100">Clear</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for the detail of status number-->
    <div class="modal" id="statusDetail" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delivery Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item">Delivery ID : 1 - &nbsp Waiting for confirmation</li>
                        <li class="list-group-item">Delivery ID : 2 - &nbsp Confirmed</li>
                        <li class="list-group-item">Delivery ID : 3 - &nbsp In Transit</li>
                        <li class="list-group-item">Delivery ID : 4 - &nbsp Delivering</li>
                        <li class="list-group-item">Delivery ID : 5 - &nbsp Completed</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php include '../include/customer/footer.php' ?>