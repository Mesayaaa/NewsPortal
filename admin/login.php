<?php
// Fetching all the Functions and DB Code
require('../includes/functions.inc.php');
require('../includes/database.inc.php');
session_start();

// Checking if the Admin is logged in already
if (isset($_SESSION['ADMIN_LOGGED_IN']) && $_SESSION['ADMIN_LOGGED_IN'] == "YES") {

  // Redirected to admin dashboard
  redirect('./index.php');
}

// Whenever login button is pressed
if (isset($_POST['login-submit'])) {

  // Fetching values via POST and passing them to user defined function 
  // to get rid of special characters used in SQL
  $loginEmail = get_safe_value($_POST['login-email']);
  $loginPassword = get_safe_value($_POST['login-password']);

  // Login Query to check if the email submitted is present or registered
  $loginQuery = " SELECT * FROM admin 
                    WHERE admin_email = '{$loginEmail}'";

  // Running the Login Query
  $result = mysqli_query($con, $loginQuery);

  // Returns the number of rows from the result retrieved.
  $rows = mysqli_num_rows($result);

  // If query has any result (records) => If any user with the email exists
  if ($rows > 0) {

    // Fetching the data of particular record as an Associative Array
    while ($data = mysqli_fetch_assoc($result)) {

      // Verifying whether the password matches the hash from DB
      $password_check = password_verify($loginPassword, $data['admin_password']);

      // If password matches with the data from DB
      if ($password_check) {

        // Setting admin specific session variables
        $_SESSION['ADMIN_LOGGED_IN'] = "YES";
        $_SESSION['ADMIN_ID'] = $data['admin_id'];

        // Unsetting all the user & author specific session variables
        unset($_SESSION['USER_NAME']);
        unset($_SESSION['USER_LOGGED_IN']);
        unset($_SESSION['USER_ID']);
        unset($_SESSION['USER_EMAIL']);

        unset($_SESSION['AUTHOR_NAME']);
        unset($_SESSION['AUTHOR_LOGGED_IN']);
        unset($_SESSION['AUTHOR_ID']);
        unset($_SESSION['AUTHOR_EMAIL']);

        // Redirected to admin dashboard
        redirect('./index.php');
      }

      // If the password fails to match
      else {
        $_SESSION['LOGIN_ERROR'] = 'Password salah!';
        redirect('./login.php');
      }
    }
  }

  // If the email is not registered 
  else {

    // Email tidak ditemukan
    $_SESSION['LOGIN_ERROR'] = 'Email tidak terdaftar untuk Admin!';
    redirect('./login.php');
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>WinniCode Admin Panel | Login</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon" />
  <link href="../assets/css/admin/style.css" rel="stylesheet" />
  <link href="../assets/css/partials/1-variables.css" rel="stylesheet" />

  <!-- SWEETALERT2 CSS & JS -->
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js"></script>

  <!-- CUSTOM SWEETALERT2 WRAPPER -->
  <script src="../assets/js/sweetalert-wrapper.js"></script>
</head>

<body>
  <header id="header">
    <div class="container">
      <div class="row" style="display: flex; align-items: center; min-height: 80px;">
        <div style="display: flex; align-items: center;">
          <a href="/index.php" class="back-nav">
            <span class="glyphicon glyphicon-home back-nav-icon" aria-hidden="true"></span>
            Home
          </a>
          <h1 class="login-title" style="margin:0 0 0 18px; color:#fff;">Admin Login
          </h1>
        </div>
      </div>
    </div>
  </header>

  <section id="main" class="login-main">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <form id="login" method="POST" class="well">
            <div class="form-group">
              <label>Email Address</label>
              <input type="email" class="form-control" placeholder="Enter Email" name="login-email" />
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" placeholder="Password" name="login-password" />
            </div>
            <button type="submit" class="btn btn-danger btn-block" name="login-submit">
              Login
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>


  <?php
  require('./includes/footer.inc.php')
    ?>

  <script>
    // Menampilkan alert jika ada error login
    <?php if (isset($_SESSION['LOGIN_ERROR'])): ?>
      Swal.fire({
        icon: 'error',
        title: 'Login Gagal',
        text: '<?php echo $_SESSION['LOGIN_ERROR']; ?>'
      });
      <?php unset($_SESSION['LOGIN_ERROR']); ?>
    <?php endif; ?>
  </script>