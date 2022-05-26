<?php include '../include/staff/header.php' ?>
        <!--the form for update the air waybill no.-->
        <form action="../include/staff/callPythonRESTful.php" method="POST" class="airBill" >
            <?php
            if (isset($_GET["empty"])) {
                echo "<h4 style='color: red'>ALl text fields can not be empty.</h4><br>";
            }else if (isset($_GET["error"])){
                echo "<h4 style='color: red'>Weight can not exceed 10 kg.</h4><br>";
            }
            ?>
            <h3>Air Waybill</h3>
            <!-- show all the information for updating the new total price-->
            <label>Staff ID:</label><input type="text" name="staffId" value="<?php echo $_SESSION["staffID"]?>" class="displayBox" readonly><br>
            <label>Customer Email:</label>
            <input type="text" id="customerEmailLabel" name="customerEmail" value="" class="displayBox" readonly>
            <label>Location:</label>
            <input type="text" id="locationIDLabel" name="locationID" value="" class="displayBox" readonly><br>
            <label>Air Waybill's Nubmer:</label>
            <input type="text" name="airWaybillNo" id="airWaybillNo" value="" class="displayBox" readonly>
            <label for="weightLabel">Measured Weight(kg):</label>
            <input type="text" name="weight" id="weightLabel" class="callPythonApi"><br>
            <input type="submit">
        </form>
        <!--display the location name -->
        <table>
            <thead>
                <tr>
                    <th>Air Waybill's No.</th>
                    <th>Customer's Email</th>
                    <th>Location</th>
                    <th>Confirm By</th>
                    <th>Weight</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <!--select the table to show the information for changing the air waybill table-->
            <?php
            include_once '../include/db.php';
            $conn = getDBconnection();
            $sql = "SELECT * FROM airwaybill, location WHERE airwaybill.locationID = location.locationID";
            $result = mysqli_query($conn, $sql) or die("SQL command fails " . mysqli_error($conn));
            $num = mysqli_num_rows($result);

            while ($rec = mysqli_fetch_assoc($result)) {
                extract($rec);
                $weight != null? $stringWeight = $weight : $stringWeight = "Null";
                $totalPrice != null? $stringPrice = $totalPrice : $stringPrice = "Null";
                $staffID != null? $stringStaffID = $staffID : $stringStaffID = "Null";
                echo <<<EOD
                <tr>
                    <td class="airWaybillNo">$airWaybillNo</td>
                    <td class="customerEmail">$customerEmail</td>
                    <td class="locationID">$locationID</td>
                    <td class="staffID">$stringStaffID</td>
                    <td class="weight">$stringWeight</td>
                    <td>$stringPrice</td>
                    <td><input type="button" class="update" value="Update">
                        <a href="../include/staff/deleteDelivery.inc.php?airWaybillNo=$airWaybillNo"><input type="button" class="delete" value="Delete"></a></td>
                </tr>
EOD;
            }
            mysqli_free_result($result);
            mysqli_close($conn);
            ?>
            </tbody>
        </table>
<?php include '../include/staff/footer.php'?>