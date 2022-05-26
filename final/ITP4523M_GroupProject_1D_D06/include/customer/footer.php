</main>
</body>
<script src="../assets/js/customer/customer.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
<script>
    // call table lib
    $(document).ready(function() {
        $('#airWaybillTable').DataTable();
    } );

    $(document).ready(function() {
        $('#deliveryRecordTable').DataTable();
    } );

    $(document).ready(function() {
        $('#trackingTable').DataTable();
    } );
</script>
</html>
