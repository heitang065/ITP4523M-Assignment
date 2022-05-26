<?php include '../include/staff/header.php' ?>
    <!--the form for create a new shipment tracker-->
    <form action="../include/staff/createDelivery.inc.php" method="POST">
        <h3>Delivery Record</h3>
        <label>Air Waybill's Number:</label>
        <input type="text" name="airWaybillNo">
        <label>Shipment Status:</label>
        <select name="status" class="selectMenu">
            <option value="2" selected>Confirmed</option>
            <option value="3">In Transit</option>
            <option value="4">Delivering</option>
            <option value="5">Completed</option>
        </select><br>
        <label>Current Location:</label>
        <input type="text" name="location">
        <input type="submit" value="Create Record">
        <!--      if user got error the message will show-->
	  <?php
	  if (isset($_GET["error"])) {
		echo "<h4 style='color: red'>The airway bill doesn't exist!</h4>";
	  } else if (isset($_GET["empty"])) {
		echo "<h4 style='color: red'>The location can not be empty!</h4>";
	  }
	  ?>
    </form>
    <table>
        <tr>
            <th>Air Waybill’s No.</th>
            <th>Date & Time</th>
            <th>Shipment Status</th>
            <th>Current Location</th>
        </tr>
        <tbody>
        <!--select the table to show the information for shipment tracker table-->
		<?php
		include_once '../include/db.php';

		$conn = getDBconnection();
		$sql = "SELECT * FROM airwaybilldeliveryrecord 
                INNER JOIN deliveryStatus WHERE airwaybilldeliveryrecord.deliveryStatusID = deliveryStatus.deliveryStatusID ORDER BY recordDateTime DESC";
		$result = mysqli_query($conn, $sql) or die("SQL command fails " . mysqli_error($conn));
		$num = mysqli_num_rows($result);

		while ($rec = mysqli_fetch_assoc($result)) {
		  extract($rec);
		  $currentLocation != null ? $stringLocation = $currentLocation : $stringLocation = "Null";
		  echo <<<EOD
            <tr>
                    <td>$airWaybillNo</td>
                    <td>$recordDateTime</td>
                    <td class="status">$deliveryStatusName</td>
                    <td>$stringLocation</td>
            </tr>
EOD;
		}
		mysqli_free_result($result);
		mysqli_close($conn);
		?>
        </tbody>
    </table>
<?php include '../include/staff/footer.php' ?>