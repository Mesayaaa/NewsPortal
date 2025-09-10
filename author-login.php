<?php
// Fetching all the Navbar Data
require('./includes/nav.inc.php');

// Checking if the Author is logged in already
if (isset($_SESSION['AUTHOR_LOGGED_IN']) && $_SESSION['AUTHOR_LOGGED_IN'] == "YES") {

  // Redirected to author dashboard
  redirect('./author/index.php');
}

// Whenever login button is pressed
if (isset($_POST['login-submit'])) {

  // Fetching values via POST and passing them to user defined function 
  // to get rid of special characters used in SQL
  $loginEmail = get_safe_value($_POST['login-email']);
  $loginPassword = get_safe_value($_POST['login-password']);

  // Login Query to check if the email submitted is present or registered
  $loginQuery = " SELECT * FROM author 
                    WHERE author_email = '{$loginEmail}'";

  // Running the Login Query
  $result = mysqli_query($con, $loginQuery);

  // Returns the number of rows from the result retrieved.
  $rows = mysqli_num_rows($result);

  // If query has any result (records) => If any user with the email exists
  if ($rows > 0) {

    // Fetching the data of particular record as an Associative Array
    while ($data = mysqli_fetch_assoc($result)) {

      // Verifing whether the password matches the hash from DB
      $password_check = password_verify($loginPassword, $data['author_password']);

      // If password matches with the data from DB
      if ($password_check) {

        // Setting author specific session variables
        $_SESSION['AUTHOR_NAME'] = $data['author_name'];
        $_SESSION['AUTHOR_LOGGED_IN'] = "YES";
        $_SESSION['AUTHOR_ID'] = $data['author_id'];
        $_SESSION['AUTHOR_EMAIL'] = $data['author_email'];

        // Unsetting all the user specific session variables
        unset($_SESSION['USER_NAME']);
        unset($_SESSION['USER_LOGGED_IN']);
        unset($_SESSION['USER_ID']);
        unset($_SESSION['USER_EMAIL']);

        // Redirected to author dashboard
        redirect('./author/index.php');
      }

      // If the password fails to match
      else {

        // Redirected to login page along with a message
        alert("Wrong Password");
        redirect('./author-login.php');
      }
    }
  }

  // If the email is not registered 
  else {

    // Redirected to signup page along with a message
    alert("This Email is not registered. Please Register");
    redirect('./author-login.php');
  }
}
?>


<div class="container p-2">
  <!-- Container to store the login form -->
  <div class="forms-container">
    <!-- Login form container -->
    <div class="login-only-wrapper">
      <div class="form-title">
        <h4>Author Login</h4>
        <p>Welcome back! Access your author dashboard.</p>
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
      <!-- Div to display the errors from the Login form -->
      <div class="form-errors">
        <p class="errors" id="login-errors"></p>
      </div>

      <!-- Link to registration page -->
      <div class="form-footer">
        <p>Don't have an author account? <a href="./author-register.php" class="form-link">Register here</a></p>
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