<?php
require('./includes/nav.inc.php');

if (isset($_GET['id'])) {
  $article_id = $_GET['id'];
} else {
  redirect('./articles.php');
}
if ($article_id == '' || $article_id == null) {
  redirect('./articles.php');
}

$sql = "UPDATE article 
          SET article_active = 0 
          WHERE article_id = {$article_id}";

$result = mysqli_query($con, $sql);

if ($result) {
  redirect_with_alert('./articles.php', "Deactivated Article", "success", "Success");
} else {
  redirect_with_alert('./articles.php', "Something went wrong. Please try again later", "error", "Error!");
}
?>

<?php
require('./includes/footer.inc.php')
  ?>