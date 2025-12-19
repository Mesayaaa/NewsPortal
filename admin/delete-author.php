<?php
/**
 * Delete Author Handler
 * Deletes an author account and all associated articles, bookmarks, and related data
 * 
 * GET Parameters:
 * - author_id: The ID of the author to delete
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

// Validate and sanitize author_id parameter
if (!isset($_GET['author_id']) || empty($_GET['author_id'])) {
    $_SESSION['delete_error'] = 'Invalid author ID';
    header('Location: ./authors.php');
    exit();
}

$author_id = intval($_GET['author_id']);

// Verify author exists before deletion
$verify_sql = "SELECT author_id, author_name FROM author WHERE author_id = $author_id";
$verify_result = mysqli_query($con, $verify_sql);

if (mysqli_num_rows($verify_result) === 0) {
    $_SESSION['delete_error'] = 'Author not found';
    header('Location: ./authors.php');
    exit();
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

    // Set success message
    $articles_count = count($article_ids);
    $_SESSION['delete_success'] = "Author '$author_name' and " . $articles_count . " associated article(s) have been successfully deleted.";

} catch (Exception $e) {
    // Rollback transaction on error
    mysqli_query($con, "ROLLBACK");
    $_SESSION['delete_error'] = "Error deleting author: " . $e->getMessage();
}

// Close database connection
mysqli_close($con);

// Redirect back to authors list
header('Location: ./authors.php');
exit();
?>