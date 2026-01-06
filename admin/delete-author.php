<?php
// Fetching all the Functions and DB Code
require('../includes/functions.inc.php');
require('../includes/database.inc.php');
session_start();

// Check if user is authenticated (admin session)
if (!isset($_SESSION['ADMIN_LOGGED_IN']) || $_SESSION['ADMIN_LOGGED_IN'] !== 'YES') {
    redirect_with_alert('./login.php', 'Please login as Admin first.', 'warning', 'Access Denied');
}

// Validate and sanitize author_id parameter
if (!isset($_GET['author_id']) || $_GET['author_id'] === '') {
    redirect_with_alert('./authors.php', 'Invalid author ID.', 'error', 'Error!');
}

$author_id = (int) $_GET['author_id'];

// Verify author exists before deletion
$verify_sql = "SELECT author_id, author_name FROM author WHERE author_id = $author_id";
$verify_result = mysqli_query($con, $verify_sql);

if (mysqli_num_rows($verify_result) === 0) {
    mysqli_close($con);
    redirect_with_alert('./authors.php', 'Author not found.', 'error', 'Error!');
}

$author_data = mysqli_fetch_assoc($verify_result);
$author_name = $author_data['author_name'];

try {
    // Start transaction for data integrity
    mysqli_query($con, "START TRANSACTION");

    // Step 1: Get all article IDs written by this author
    $get_articles_sql = "SELECT article_id FROM article WHERE author_id = $author_id";
    $articles_result = mysqli_query($con, $get_articles_sql);

    $article_ids = array();
    while ($article = mysqli_fetch_assoc($articles_result)) {
        $article_ids[] = $article['article_id'];
    }

    // Step 2: Delete all bookmarks associated with articles by this author
    if (!empty($article_ids)) {
        $article_ids_string = implode(',', $article_ids);
        $delete_bookmarks_sql = "DELETE FROM bookmark WHERE article_id IN ($article_ids_string)";
        if (!mysqli_query($con, $delete_bookmarks_sql)) {
            throw new Exception("Error deleting bookmarks: " . mysqli_error($con));
        }
    }

    // Step 3: Delete all articles written by this author
    $delete_articles_sql = "DELETE FROM article WHERE author_id = $author_id";
    if (!mysqli_query($con, $delete_articles_sql)) {
        throw new Exception("Error deleting articles: " . mysqli_error($con));
    }

    // Step 4: Delete the author account
    $delete_author_sql = "DELETE FROM author WHERE author_id = $author_id";
    if (!mysqli_query($con, $delete_author_sql)) {
        throw new Exception("Error deleting author: " . mysqli_error($con));
    }

    // Commit transaction
    mysqli_query($con, "COMMIT");

    $articles_count = count($article_ids);
    $alertType = 'success';
    $alertTitle = 'Success!';
    $alertMessage = "Author '$author_name' was deleted successfully ($articles_count related articles).";

} catch (Exception $e) {
    // Rollback transaction on error
    mysqli_query($con, "ROLLBACK");

    $alertType = 'error';
    $alertTitle = 'Error!';
    $alertMessage = 'Failed to delete author. Please try again.';
}

// Close database connection
mysqli_close($con);

// Redirect back to authors list
redirect_with_alert('./authors.php', $alertMessage, $alertType, $alertTitle);
?>