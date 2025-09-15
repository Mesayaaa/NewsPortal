<?php
// Fetching all the Navbar Data
require('./includes/nav.inc.php');

// Checking if the User is logged in already
if (isset($_SESSION['USER_LOGGED_IN']) && $_SESSION['USER_LOGGED_IN'] == "YES") {

    // Redirected to home page
    redirect('./index.php');
}

// Whenever signup button is pressed
if (isset($_POST['signup-submit'])) {

    // Fetching values via POST and passing them to user defined 
    // function to get rid of special characters used in SQL
    $signupName = get_safe_value($_POST['signup-name']);
    $signupEmail = get_safe_value($_POST['signup-email']);
    $signupPassword = get_safe_value($_POST['signup-password']);

    // Creating new password hash using a strong one-way hashing algorithm => CRYPT_BLOWFISH algorithm
    $strg_pass = password_hash($signupPassword, PASSWORD_BCRYPT);

    // Check Query to check if the email submitted is present or registered already
    $check_sql = "SELECT user_email FROM user 
                  WHERE user_email = '{$signupEmail}'";

    // Running the Check Query
    $check_result = mysqli_query($con, $check_sql);

    // Returns the number of rows from the result retrieved.
    $check_row = mysqli_num_rows($check_result);

    // If query has any result (records) => If any user with the email exists
    if ($check_row > 0) {

        // Redirecting to the registration page along with a message
        alert("Email Already Exists", "error", "Registration Failed");
        redirect('./user-register.php');
    }

    // If the query has no records => No user with the email exists (New User)
    else {

        // Signup Query to insert values into the DB
        $signupQuery = "INSERT INTO user 
                      (user_name, user_email, user_password) 
                      VALUES 
                      ('{$signupName}', '{$signupEmail}', '{$strg_pass}')";

        // Running the signup query
        $result = mysqli_query($con, $signupQuery);

        //If Query ran successfully
        if ($result) {

            // Redirected to login page with a message
            alert("Signup Successful, Please Login", "success", "Registration Success");
            redirect('./user-login.php');
        }

        // If the Query failed
        else {

            // Print the error
            echo "Error: " . mysqli_error($con);
        }
    }
}
?>

<div class="container p-2">
    <!-- Container to store the registration form -->
    <div class="forms-container">
        <!-- Registration form container -->
        <div class="register-form-wrapper">
            <div class="form-title">
                <h4>Reader Registration</h4>
                <p>Join our news platform to bookmark articles and stay updated!</p>
            </div>
            <div class="signup-form-container">
                <!-- Form for Registration -->
                <form method="POST" class="signup-form" id="signup-form">
                    <div class="input-field">
                        <input type="text" name="signup-name" id="signup-name" placeholder=" Full Name"
                            autocomplete="off" required>
                    </div>
                    <div class="input-field">
                        <input type="email" name="signup-email" id="signup-email" placeholder=" Email Address"
                            autocomplete="off" required>
                    </div>
                    <div class="input-field">
                        <input type="password" name="signup-password" id="signup-password" placeholder=" Password"
                            autocomplete="off" required>
                    </div>
                    <div class="input-field">
                        <input type="password" name="signup-confirm-password" id="signup-confirm-password"
                            placeholder=" Confirm Password" autocomplete="off" required>
                    </div>
                    <div class="input-field">
                        <button type="submit" name="signup-submit">Create Account</button>
                    </div>
                </form>
            </div>

            <!-- Link to login page -->
            <div class="form-footer">
                <p>Already have an account? <a href="./user-login.php" class="form-link">Login here</a></p>
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