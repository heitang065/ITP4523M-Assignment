<?php include '../include/customer/header.php' ?>
    <section id="profile" class="d-flex justify-content-center align-items-center section-height">
        <div class="w-50 border border-2 bg-white">
            <div class="d-flex border-bottom border-2 p-3">
                <img src="https://www.w3schools.com/howto/img_avatar.png" alt="" class="avatar"/>
                <h2>Profile</h2>
            </div>
            <div class="px-3">
                <?php
                include_once '../include/db.php';
                $customerEmail = $_SESSION["customerEmail"];

                $conn = getDBconnection();
                $sql = "SELECT * FROM customer WHERE customerEmail = '$customerEmail'";
                $result = mysqli_query($conn, $sql) or die("SQL command fails " . mysqli_error($conn));
                $num = mysqli_num_rows($result);

                if ($num > 0) {
                    $user = mysqli_fetch_array($result);
                    extract($user);
                    echo <<<EOD
                <div class="row mt-3 p-2">
                    <div class="col">
                        Account Creation Date
                    </div>
                    <div class="col text-muted">
                        $accountCreationDate
                    </div>
                </div>
                <div class="row mt-3 p-2">
                    <div class="col">
                        Name
                    </div>
                    <div class="col text-muted">
                        $customerName
                    </div>
                </div>
                <div class="row mt-3 p-2">
                    <div class="col">
                        Email address
                    </div>
                    <div class="col text-muted">
                        $customerEmail
                    </div>
                </div>
                <div class="row mt-3 p-2">
                    <div class="col">
                        Password
                    </div>
                    <div class="col text-muted">
                        <input type="password" value="$customerPassword" disabled>
                    </div>
                </div>
                <div class="row mt-3 p-2">
                    <div class="col">
                        Phone Number
                    </div>
                    <div class="col text-muted">
                        $phoneNumber
                    </div>
                </div>
                <div class="row mt-3 p-2">
                    <div class="col">
                        Address
                    </div>
                    <div class="col text-muted">
                        $address
                    </div>
                </div>
EOD;
                }
                mysqli_free_result($result);
                mysqli_close($conn);
                ?>
            </div>
            <div class="d-flex mt-4 border-top border-2 py-3 px-2">
                <button type="button" class="btn btn-primary mx-2 px-5" data-bs-toggle="modal"
                        data-bs-target="#profileEditModal">
                    Edit
                </button>
                <button type="button" class="btn btn-danger px-5" data-bs-toggle="modal"
                        data-bs-target="#deleteAccountModal">
                    Delete
                </button>
            </div>
        </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="profileEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    include_once '../include/db.php';
                    $customerEmail = $_SESSION["customerEmail"];

                    $conn = getDBconnection();
                    $sql = "SELECT * FROM customer WHERE customerEmail = '$customerEmail'";
                    $result = mysqli_query($conn, $sql) or die("SQL command fails " . mysqli_error($conn));
                    $num = mysqli_num_rows($result);

                    if ($num > 0) {
                        $user = mysqli_fetch_array($result);
                        extract($user);
                        echo <<<EOD
                    <form method="POST" action="../include/customer/profile.inc.php">
                        <div class="form-group mt-2">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="$customerName" required>
                        </div>
                        <div class="form-group mt-2">
                             <label for="password">Password</label>
                             <input type="password" class="form-control" id="password" name="password" value="$customerPassword" required>
                        </div>
                        <div class="form-group mt-2">
                            <label for="phoneNumber">Phone Number</label>
                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="$phoneNumber" pattern="[0-9]{8}" title="8 digit eg:28880000" required>
                        </div>
                        <div class="form-group mt-2">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="$address" required>
                        </div>
                        <button type="submit" name="editAccount" class="btn btn-primary mt-2 w-100">Submit</button>
                        <button type="reset" class="btn btn-secondary mt-2 w-100">Clear</button>
                    </form>
EOD;
                    }
                    mysqli_free_result($result);
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body">
                    Are you sure that you want to delete your account?
                </div>
                <div class="modal-footer">
                    <a href="../include/customer/profile.inc.php?deleteAccount" type="button" class="btn btn-primary">Comfirm</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php include '../include/customer/footer.php' ?>