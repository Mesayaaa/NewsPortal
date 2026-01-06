<?php
// Fetching all the Functions and DB Code
require('../includes/functions.inc.php');
require('../includes/database.inc.php');
session_start();

// Check if user is authenticated (admin session)
if (!isset($_SESSION['ADMIN_LOGGED_IN']) || $_SESSION['ADMIN_LOGGED_IN'] !== 'YES') {
    redirect_with_alert('./login.php', 'Please login as Admin first.', 'warning', 'Access Denied');
}

// Validate and sanitize user_id parameter
if (!isset($_GET['user_id']) || $_GET['user_id'] === '') {
    redirect_with_alert('./users.php', 'Invalid user ID.', 'error', 'Error!');
}

$user_id = (int) $_GET['user_id'];

// Verify user exists before deletion
$verify_sql = "SELECT user_id, user_name FROM user WHERE user_id = $user_id";
$verify_result = mysqli_query($con, $verify_sql);

if (mysqli_num_rows($verify_result) === 0) {
    mysqli_close($con);
    redirect_with_alert('./users.php', 'User not found.', 'error', 'Error!');
}

$user_data = mysqli_fetch_assoc($verify_result);
$user_name = $user_data['user_name'];

try {
    // Start transaction for data integrity
    mysqli_query($con, "START TRANSACTION");

    // Step 1: Delete all bookmarks associated with this user
    $delete_bookmarks_sql = "DELETE FROM bookmark WHERE user_id = $user_id";
    if (!mysqli_query($con, $delete_bookmarks_sql)) {
        throw new Exception("Error deleting bookmarks: " . mysqli_error($con));
    }

    // Step 2: Delete the user account
    $delete_user_sql = "DELETE FROM user WHERE user_id = $user_id";
    if (!mysqli_query($con, $delete_user_sql)) {
        throw new Exception("Error deleting user: " . mysqli_error($con));
    }

    // Commit transaction
    mysqli_query($con, "COMMIT");

    $alertType = 'success';
    $alertTitle = 'Success!';
    $alertMessage = "User '$user_name' was deleted successfully, including all related bookmarks.";

} catch (Exception $e) {
    // Rollback transaction on error
    mysqli_query($con, "ROLLBACK");

    $alertType = 'error';
    $alertTitle = 'Error!';
    $alertMessage = 'Failed to delete user. Please try again.';
}

// Close database connection
mysqli_close($con);

// Redirect back to users list
redirect_with_alert('./users.php', $alertMessage, $alertType, $alertTitle);
?>