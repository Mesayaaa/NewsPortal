<?php
$art_sql = "SELECT COUNT(article_id) 
              AS no_of_articles 
              FROM article";
$art_result = mysqli_query($con, $art_sql);
$art_data = mysqli_fetch_assoc($art_result);
$no_of_articles = $art_data['no_of_articles'];


$cat_sql = "SELECT COUNT(category_id) 
              AS no_of_categories 
              FROM category";
$cat_result = mysqli_query($con, $cat_sql);
$cat_data = mysqli_fetch_assoc($cat_result);
$no_of_categories = $cat_data['no_of_categories'];


?>
<div class="col-md-3">
  <div class="list-group">
    <div class="list-group-item1 active main-color-bg">
      <span class="glyphicon glyphicon-dashboard"></span>
      <strong>Admin Panel</strong>
    </div>
    <a href="./index.php" class="list-group-item">
      <span class="glyphicon glyphicon-home"></span>
      Dashboard
    </a>
    <a href="./articles.php" class="list-group-item">
      <span class="glyphicon glyphicon-pencil"></span>
      Articles
      <span class="badge"><?php echo $no_of_articles ?></span>
    </a>
    <a href="./categories.php" class="list-group-item">
      <span class="glyphicon glyphicon-list"></span>
      Categories
      <span class="badge"><?php echo $no_of_categories ?></span>
    </a>
    
    <a href="./add-category.php" class="list-group-item">
      <span class="glyphicon glyphicon-plus"></span>
      Add Category
    </a>
    <a href="../author/add-article.php" class="list-group-item">
      <span class="glyphicon glyphicon-plus-sign"></span>
      Add Article
    </a>
    
    <a href="./change-password.php" class="list-group-item">
      <span class="glyphicon glyphicon-cog"></span>
      Settings
    </a>
    <a href="../index.php" class="list-group-item" target="_blank">
      <span class="glyphicon glyphicon-eye-open"></span>
      View Site
    </a>
    <a href="./logout.php" class="list-group-item" style="color: red;">
      <span class=" glyphicon glyphicon-log-out"></span>
      Logout
    </a>
  </div>
</div>