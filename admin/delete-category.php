<?php
require('./includes/nav.inc.php');

if (isset($_GET['id'])) {
    $category_id = $_GET['id'];
} else {
    redirect('./categories.php');
}
if (empty($category_id)) {
    redirect('./categories.php');
}

$sql_check = "SELECT COUNT(*) as total FROM article WHERE category_id = {$category_id}";
$result_check = mysqli_query($con, $sql_check);
$row_check = mysqli_fetch_assoc($result_check);

// If there are related articles, delete all articles and their images (manual cascade delete)
if ($row_check['total'] > 0) {
    $sql_articles = "SELECT article_id, article_image FROM article WHERE category_id = {$category_id}";
    $result_articles = mysqli_query($con, $sql_articles);
    while ($row_article = mysqli_fetch_assoc($result_articles)) {
        $article_id = $row_article['article_id'];
        $article_img = $row_article['article_image'];
        // Delete article image if exists
        if ($article_img && file_exists("../assets/images/articles/{$article_img}")) {
            unlink("../assets/images/articles/{$article_img}");
        }
        // Delete article
        mysqli_query($con, "DELETE FROM article WHERE article_id = {$article_id}");
    }
}

// Get category image
$sql_img = "SELECT category_image FROM category WHERE category_id = {$category_id}";
$result_img = mysqli_query($con, $sql_img);
$row_img = mysqli_fetch_assoc($result_img);
$category_img = $row_img['category_image'];

// Delete category image if exists
if ($category_img && file_exists("../assets/images/category/{$category_img}")) {
    unlink("../assets/images/category/{$category_img}");
}

// Delete category
$delete_sql = "DELETE FROM category WHERE category_id = {$category_id}";
$cat_result = mysqli_query($con, $delete_sql);

if ($cat_result) {
    alert('Category deleted successfully.', 'success', 'Success');
    redirect('./categories.php');
} else {
    alert('Failed to delete category.', 'error', 'Error');
    redirect('./categories.php');
}
?>

<?php
require('./includes/footer.inc.php');
?>