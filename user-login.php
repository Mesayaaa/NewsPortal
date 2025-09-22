<?php
// Fetching all the Navbar Data
require('./includes/nav.inc.php');

// Checking if the User is logged in already
if (isset($_SESSION['USER_LOGGED_IN']) && $_SESSION['USER_LOGGED_IN'] == "YES") {

  // Redirected to home page
  redirect('./index.php');
}

// Whenever login button is pressed
if (isset($_POST['login-submit'])) {

  // Fetching values via POST and passing them to user defined function 
  // to get rid of special characters used in SQL
  $loginEmail = get_safe_value($_POST['login-email']);
  $loginPassword = get_safe_value($_POST['login-password']);

  // Login Query to check if the email submitted is present or registered
  $loginQuery = " SELECT * FROM user 
                    WHERE user_email = '{$loginEmail}'";

  // Running the Login Query
  $result = mysqli_query($con, $loginQuery);

  // Returns the number of rows from the result retrieved.
  $rows = mysqli_num_rows($result);

  // If query has any result (records) => If any user with the email exists
  if ($rows > 0) {

    // Fetching the data of particular record as an Associative Array
    while ($data = mysqli_fetch_assoc($result)) {

      // Verifing whether the password matches the hash from DB
      $password_check = password_verify($loginPassword, $data['user_password']);

      // If password matches with the data from DB
      if ($password_check) {

        // Setting user specific session variables
        $_SESSION['USER_NAME'] = $data['user_name'];
        $_SESSION['USER_LOGGED_IN'] = "YES";
        $_SESSION['USER_ID'] = $data['user_id'];
        $_SESSION['USER_EMAIL'] = $data['user_email'];

        // Unsetting all the author specific session variables
        unset($_SESSION['AUTHOR_NAME']);
        unset($_SESSION['AUTHOR_LOGGED_IN']);
        unset($_SESSION['AUTHOR_ID']);
        unset($_SESSION['AUTHOR_EMAIL']);

        // Redirected to home page
        redirect('./index.php');
      }

      // If the password fails to match
      else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
          Swal.fire({icon: 'error', title: 'Login Gagal', text: 'Password salah!'}).then(() => {
            window.location.href = 'user-login.php';
          });
        </script>";
      }
    }
  }
  // If the email is not registered 
  else {

    // Email tidak ditemukan
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
      Swal.fire({icon: 'error', title: 'Login Gagal', text: 'Email tidak ditemukan!'}).then(() => {
        window.location.href = 'user-login.php';
      });
    </script>";
  }
}
?>
<div class="container p-2">
  <!-- Container to store the login form -->
  <div class="forms-container">
    <!-- Login form container -->
    <div class="login-only-wrapper">
      <div class="form-title">
        <h4>Reader Login</h4>
        <p>Welcome back! Please sign in to your account.</p>
      </div>
      <div class="login-form-container">
        <!-- Form for Login -->
        <form method="POST" class="login-form" id="login-form">
          <div class="input-field">
            <input type="email" name="login-email" id="login-email" placeholder=" Email Address" autocomplete="off"
              required>
          </div>
          <div class="input-field">
            <input type="password" name="login-password" id="login-password" placeholder=" Password" autocomplete="off"
              required>
          </div>
          <div class="input-field">
            <button type="submit" name="login-submit">Login</button>
          </div>
        </form>
      </div>

      <!-- Link to registration page -->
      <div class="form-footer">
        <p>Don't have an account? <a href="./user-register.php" class="form-link">Register here</a></p>
      </div>
    </div>
  </div>
</div>

<!-- Script for form Validation -->
<script src="./assets/js/form-validate.js"></script>

<?php

// Fetching all the Footer Data
require('./includes/footer.inc.php');
?>