<?php
/**
 * Delete User Handler
 * Deletes a user account and all associated data (bookmarks)
 * 
 * GET Parameters:
 * - user_id: The ID of the user to delete
 */

// Start session for authentication
session_start();

// Include database connection
include_once '../includes/database.inc.php';

// Check if user is authenticated (admin session)
if (!isset($_SESSION['admin_id'])) {
    header('Location: ./login.php');
    exit();
}

// Validate and sanitize user_id parameter
if (!isset($_GET['user_id']) || empty($_GET['user_id'])) {
    $_SESSION['delete_error'] = 'Invalid user ID';
    header('Location: ./users.php');
    exit();
}

$user_id = intval($_GET['user_id']);

// Verify user exists before deletion
$verify_sql = "SELECT user_id, user_name FROM user WHERE user_id = $user_id";
$verify_result = mysqli_query($con, $verify_sql);

if (mysqli_num_rows($verify_result) === 0) {
    $_SESSION['delete_error'] = 'User not found';
    header('Location: ./users.php');
    exit();
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

    // Set success message
    $_SESSION['delete_success'] = "User '$user_name' has been successfully deleted along with all associated bookmarks.";

} catch (Exception $e) {
    // Rollback transaction on error
    mysqli_query($con, "ROLLBACK");
    $_SESSION['delete_error'] = "Error deleting user: " . $e->getMessage();
}

// Close database connection
mysqli_close($con);

// Redirect back to users list
header('Location: ./users.php');
exit();
?>