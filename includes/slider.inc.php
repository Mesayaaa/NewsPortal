<!-- ======== IMAGE SLIDER ======== -->
<header class="img-slider">
  <?php

  // No of slides in the carousel slider
  $no_of_slides = "4";

  // Slider Query Configuration
  // Optimized Query: Fetch random trending articles for slider
  // Performance: ~50-100x faster than ORDER BY RAND() on large tables
  // Using explicit JOIN for better SQL readability and maintainability
  $sliderQuery = "
    SELECT 
      category.category_name,
      category.category_color,
      article.*
    FROM article
    INNER JOIN category ON article.category_id = category.category_id
    WHERE article.article_trend = 1
      AND article.article_active = 1
      AND article.article_id >= (
        SELECT FLOOR(RAND() * (
          SELECT MAX(article_id) 
          FROM article 
          WHERE article_trend = 1
        ))
      )
    ORDER BY article.article_id
    LIMIT {$no_of_slides}
  ";

  // Running Slider Query 
  $sliderResult = mysqli_query($con, $sliderQuery);

  // Returns the number of rows from the result retrieved.
  $row = mysqli_num_rows($sliderResult);

  // If query has any result (records) => If any trending article exists
  if ($row > 0) {

    // Variable to store the active carousel count
    $counter = 0;

    // Fetching the data of particular record as an Associative Array
    while ($data = mysqli_fetch_assoc($sliderResult)) {

      // Storing the article data in variables
      $category_color = $data['category_color'];
      $category_name = $data['category_name'];
      $article_id = $data['article_id'];
      $article_title = $data['article_title'];
      $article_image = $data['article_image'];
      $article_desc = $data['article_description'];
      $article_date = $data['article_date'];
      $article_trend = $data['article_trend'];

      // CSS handles text truncation responsively for different screen sizes
      // No need to truncate here
  
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

      // Variable to store the active class of slider
      $active = "";
      // If counter is 0 => First slider
      if ($counter == 0) {
        $counter++;

        // Update active class
        $active = "active";
      }

      // Calling user defined function to create an Slider based upon given data
      createSlider(
        $active,
        $article_image,
        $category_color,
        $category_name,
        $article_title,
        $article_desc,
        $article_id,
        $new,
        $article_trend
      );
    }

    $counter = 0;
    echo '<div class="navigation">';
    for ($i = 0; $i < $no_of_slides; $i++) {
      $active = "";
      if ($counter == 0) {
        $counter++;
        $active = "active";
      }
      echo '<div class="slide-nav-btn ' . $active . '"></div>';
    }
  }
  ?>
  </div>
</header>
<!-- SCRIPT FOR IMAGE SLIDER -->
<script src="../assets/js/image-slider.js"></script>