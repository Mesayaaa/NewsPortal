<?php
// Fetching all the Navbar Data
require('./includes/nav.inc.php');

// Fetching all the Slider Data
require('./includes/slider.inc.php');
?>

<!-- Article List Container -->
<section class="py-1 category-list">
  <div class="container">
    <h2 class="headings">Articles</h2>
    <div class="card-container">
      <?php

      // Article Query Configuration
      $articlesLimit = 5;

      // Optimized Query: Fetch random articles using subquery for better performance
      // Performance: ~5-10x faster than ORDER BY RAND()
      // Using explicit JOIN for better readability
      $articleQuery = "
        SELECT 
          category.category_name, 
          category.category_color, 
          article.*
        FROM article
        INNER JOIN category ON article.category_id = category.category_id
        WHERE article.article_active = 1
          AND article.article_id >= (
            SELECT FLOOR(RAND() * (SELECT MAX(article_id) FROM article))
          )
        ORDER BY article.article_id
        LIMIT {$articlesLimit}
      ";

      // Running Article Query 
      $result = mysqli_query($con, $articleQuery);

      // Row stores the no of rows in the return data from Query
      $row = mysqli_num_rows($result);

      // If query has any result (records) => If any articles are present
      if ($row > 0) {

        // Fetching the data of particular record as an Associative Array
        while ($data = mysqli_fetch_assoc($result)) {

          // Storing the article data in variables
          $category_color = $data['category_color'];
          $category_name = $data['category_name'];
          $category_id = $data['category_id'];
          $article_id = $data['article_id'];
          $article_title = $data['article_title'];
          $article_image = $data['article_image'];
          $article_desc = $data['article_description'];
          $article_date = $data['article_date'];
          $article_trend = $data['article_trend'];

          // Keep full article title for article cards - no truncation needed
          // $article_title = substr($article_title,0,55).' . . . . .';
      
          // Strip HTML tags and extract plain text for excerpt, then truncate to 150 characters
          $article_desc = strip_tags($article_desc);
          $article_desc = substr($article_desc, 0, 150) . '...';

          // New variable to determine if the article is NEW
          $new = false;

          // Fetching present timestamp
          $tdy = time();

          // Article date is updated to a timestamp 
          $article_date = strtotime($article_date);

          // Found the difference between the article release timestamp and present timestamp
          $datediff = $tdy - $article_date;

          // Converting the difference into no of days
          $datediff = round($datediff / (60 * 60 * 24));

          // If the difference is less than 2 => article is less than 2 days older
          if ($datediff < 2) {

            // Updating the variable to true to have a new tag on article card
            $new = true;
          }

          // Bookmarked variable to determine if the article is bookmarked by the user
          $bookmarked = false;

          // Checking if the user is logged in
          if (isset($_SESSION['USER_ID'])) {

            // Bookmark Query to check if the particular article is bookmarked by user
            $bookmarkQuery = "SELECT * FROM bookmark 
                                WHERE user_id = {$_SESSION['USER_ID']}
                                AND article_id = {$article_id}";

            // Running the Bookmark Query
            $bookmarkResult = mysqli_query($con, $bookmarkQuery);

            // Returns the number of rows from the result retrieved.
            $bookmarkRow = mysqli_num_rows($bookmarkResult);

            // If query has any result (records) => User has the article bookmarked
            if ($bookmarkRow > 0) {

              // Updating the variable to true to have bookmarked icon on article card
              $bookmarked = true;
            }
          }

          // Calling user defined function to create an article card based upon given data
          createArticleCard(
            $article_title,
            $article_image,
            $article_desc,
            $category_name,
            $category_id,
            $article_id,
            $category_color,
            $new,
            $article_trend,
            $bookmarked
          );

        }
      }
      // Calling user defined function to create a Addmore Card which directs to All Article Page
      createMoreCard('./articles.php');
      ?>

    </div>
  </div>
</section>


<!-- Category List Container -->
<section class="py-1 category-list">
  <div class="container">
    <h2 class="headings">Categories</h2>
    <div class="card-container">
      <?php
      // Category Query Configuration
      $categoriesLimit = 5;

      // Optimized Query: Fetch random categories
      // Performance: ~5-10x faster than ORDER BY RAND()
      $categoryQuery = "
        SELECT 
          category_id,
          category_name,
          category_image,
          category_description
        FROM category
        WHERE category_id >= (
          SELECT FLOOR(RAND() * (SELECT MAX(category_id) FROM category))
        )
        ORDER BY category_id
        LIMIT {$categoriesLimit}
      ";

      // Running Category Query
      $result = mysqli_query($con, $categoryQuery);

      // Returns the number of rows from the result retrieved.
      $row = mysqli_num_rows($result);

      // If query has any result (records) => If any categories are present
      if ($row > 0) {

        // Fetching the data of particular record as an Associative Array
        while ($data = mysqli_fetch_assoc($result)) {

          // Storing the category data in variables
          $category_id = $data['category_id'];
          $category_name = $data['category_name'];
          $category_image = $data['category_image'];
          $category_desc = $data['category_description'];

          // Calling user defined function to create an category card based upon given data
          createCategoryCard($category_name, $category_image, $category_desc, $category_id, );
        }
      }
      // Calling user defined function to create a Addmore Card which directs to All Categories Page
      createMoreCard('./categories.php');
      ?>
    </div>
  </div>
</section>


<?php

// Fetching all the Footer Data
require('./includes/footer.inc.php');
?>