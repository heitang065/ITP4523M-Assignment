<?php include '../include/staff/header.php' ?>
    <!--the form for searching delivery report-->
    <form action="" method="POST">
        <h3>Delivery Report</h3>
        <label>Air Waybill's No.:</label>
        <input type="text" name="searchNumber">
        <input type="submit" value="Search" name="search">
        <input type="submit" value="clear" name="clear">
	  <?php
	  if (isset($_GET["error"])) {
		echo "<h4 style='color: red'>Some information are wrong/empty.</h4>";
	  }
	  ?>
    </form>
    <table>
        <tr>
            <th>Air Waybill's No.</th>
            <th>Customer's Email</th>
            <th>Customer's Name</th>
            <th>Staff ID</th>
            <th>Date & Time</th>
            <th>Receiver Name</th>
            <th>Receiver Phone No.</th>
            <th>Receiver Address</th>
            <th>Weight</th>
            <th>Total Price</th>
        </tr>
        <tbody>
        <!--select the table to show the information for report table-->
		<?php
		include_once '../include/db.php';

		$conn = getDBconnection();
        $sql ="";

        if (isset($_POST['clear'])){
            unset($_POST['search']);
        }
		if (isset($_POST['search'])){
		    $searchNumber = $_POST["searchNumber"];
            $sql = "SELECT * FROM customer,airwaybill
                WHERE customer.customerEmail = airwaybill.customerEmail AND airwaybill.airWayBillNo = '$searchNumber' ORDER BY Date DESC";
        }else{
            $sql = "SELECT * FROM customer,airwaybill
                WHERE customer.customerEmail = airwaybill.customerEmail ORDER BY Date DESC";
        }
		$result = mysqli_query($conn, $sql) or die("SQL command fails " . mysqli_error($conn));
		$num = mysqli_num_rows($result);

		while ($rec = mysqli_fetch_assoc($result)) {
		  extract($rec);
		  $weight != null ? $stringWeight = $weight : $stringWeight = "Null";
		  $totalPrice != null ? $stringPrice = $totalPrice : $stringPrice = "Null";
		  $staffID != null ? $stringStaffID = $staffID : $stringStaffID = "Null";
		  echo <<<EOD
            <tr>
                <td>$airWaybillNo</td>
                <td>$customerEmail</td>
                <td>$customerName</td>
                <td>$stringStaffID</td>
                <td>$date</td>
                <td>$receiverName</td>
                <td>$receiverPhoneNumber</td>
                <td>$receiverAddress</td>
                <td>$stringWeight</td>
                <td>$stringPrice</td>
            </tr>
EOD;
		}
		mysqli_free_result($result);
		mysqli_close($conn);
		?>
        </tbody>
    </table>
<?php include '../include/staff/footer.php' ?>