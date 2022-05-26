<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Eastern Delivery Express System</title>
    <script
      src="https://code.jquery.com/jquery-3.6.0.js"
      integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
      crossorigin="anonymous"
    ></script>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap"
      rel="stylesheet"
    />
      <script src="https://kit.fontawesome.com/1fe43f3190.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/customer/common.css" />
  </head>
  <body>
    <div class="d-flex justify-content-center align-items-center vh-100">
      <form
        method="POST"
        action="include/login.inc.php"
        class="bg-light p-5 bg-body shadow-lg"
      >
        <h1 class="font-weight-bold fs-4">Eastern Delivery Express System</h1>
        <h4 class="font-weight-bold my-3">Login</h4>
          <?php
          if (isset($_GET["error"])) {
              echo "<i class='fas fa-exclamation-triangle text-danger'></i> <p class='text-danger d-inline-block px-2'> Invalid account or password </p>";
          }
          ?>
        <div class="form-group">
          <label class="account-label" for="account">Email</label>
          <input
            type="account"
            name="account"
            class="form-control"
            id="account"
            placeholder="Enter email"
            required
          />
        </div>
        <div class="form-group mt-3">
          <label for="password">Password</label>
          <input
            type="password"
            name="password"
            class="form-control"
            id="password"
            placeholder="Password"
            required
          />
        </div>
        <div class="d-flex mt-4">
          <div class="col form-check">
            <input
              class="form-check-input"
              type="radio"
              name="role"
              value="customer"
              id="radioCustomer"
              checked
            />
            <label class="form-check-label" for="radioCustomer">Customer</label>
          </div>
          <div class="col form-check">
            <input
              class="form-check-input"
              type="radio"
              name="role"
              value="staff"
              id="radioStaff"
            />
            <label class="form-check-label" for="radioStaff">Staff</label>
          </div>
        </div>
        <button type="submit" name="login" class="btn btn-primary mt-4 w-100">
          Login
        </button>
      </form>
    </div>
  </body>
  <script src="assets/js/customer/index.js"></script>
</html>
