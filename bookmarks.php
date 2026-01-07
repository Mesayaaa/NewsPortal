<?php
// Fetching all the Navbar Data
require('./includes/nav.inc.php');

// If user not logged in
if (!isset($_SESSION['USER_LOGGED_IN'])) {

  // Redirected to login page along with a message
  redirect_with_alert('./user-login.php', "Please login to view your bookmarks", "warning", "Access Denied");
}

// Function to build pagination URL with current parameters
function buildPaginationUrl($page)
{
  $params = $_GET;
  $params['page'] = $page;
  return 'bookmarks.php?' . http_build_query($params);
}

?>

<!-- Article List Container -->
<section class="py-1 category-list">
  <div class="container">
    <h2 class="headings">Bookmarks</h2>
    <div class="card-container">
      <?php

      // Limit variable to specify the maximum no of articles in each page
      $limit = 6;

      // Check if we get page no from URL
      if (isset($_GET['page'])) {

        // Update the page
        $page = $_GET['page'];
      }

      // If page no is not fetched from URL => default to first page
      else {

        // Update to 1 as first page
        $page = 1;
      }

      // Calculate the offset value for SQL Query => pagination
      $offset = ($page - 1) * $limit;

      // Article Query to fetch all bookmarked articles of the user
      $articleQuery = " SELECT category.category_name, category.category_color, article.*
                          FROM category, article, bookmark
                          WHERE article.category_id = category.category_id
                          AND bookmark.article_id = article.article_id
                          AND article.article_active = 1
                          AND bookmark.user_id = {$_SESSION['USER_ID']}
                          ORDER BY article.article_title LIMIT {$offset},{$limit}";


      // Query to Get all the Details required for the Article Card
      // We get details from ARTICLE & CATEGORY Table in ASC order
      
      // Running the Article Query
      $result = mysqli_query($con, $articleQuery);

      // Returns the number of rows from the result retrieved.
      $row = mysqli_num_rows($result);

      // If query has any result (records) => If any bookmarked article is present
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

          // Updating the title with a substring containing at most length of 55 characters
          $article_title = substr($article_title, 0, 55) . ' . . . . .';

          // Strip HTML tags and extract plain text for excerpt, then truncate to 150 characters
          $article_desc = strip_tags($article_desc);
          $article_desc = substr($article_desc, 0, 150) . ' . . . . .';

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

          // Bookmarked variable is set to true for this page
          $bookmarked = true;

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
      } else {
        // Calling user defined function to create a card that says no articles present
        createNoBookmarksCard();
      }
      ?>
    </div>
    <?php

    // Pagination Query to get number of bookmarked articles
    $paginationQuery = "SELECT category.category_name, category.category_color, article.*
                          FROM category, article, bookmark
                          WHERE article.category_id = category.category_id
                          AND article.article_active = 1
                          AND bookmark.article_id = article.article_id
                          AND bookmark.user_id = {$_SESSION['USER_ID']}";


    // Running Pagination Query
    $paginationResult = mysqli_query($con, $paginationQuery);

    // If query has any result (records) => If bookmarked articles are present
    if (mysqli_num_rows($paginationResult) > 0) {

      // Returns the number of rows from the result retrieved => total no of bookmarked articles
      $total_articles = mysqli_num_rows($paginationResult);

      // Calculated no of pages based on limit and no of bookmarked articles
      $total_page = ceil($total_articles / $limit);
      ?>


      <div class="text-center py-2">
        <!-- Enhanced Pagination Block -->
        <div class="search-pagination-wrapper">
          <div class="search-pagination">
            <?php

            // Previous page link
            if ($page > 1) {
              echo '<a href="' . buildPaginationUrl($page - 1) . '" class="pagination-btn prev-btn" title="Previous Page">';
              echo '<i class="fas fa-chevron-left"></i>';
              echo '<span class="d-none d-sm-inline">Previous</span>';
              echo '</a>';
            }

            // Page numbers with smart truncation
            $start_page = max(1, $page - 2);
            $end_page = min($total_page, $page + 2);

            // Show first page if not in range
            if ($start_page > 1) {
              echo '<a href="' . buildPaginationUrl(1) . '" class="pagination-number">1</a>';
              if ($start_page > 2) {
                echo '<span class="pagination-ellipsis">...</span>';
              }
            }

            // Show page numbers in range
            for ($i = $start_page; $i <= $end_page; $i++) {
              $active_class = ($i == $page) ? 'active' : '';
              echo '<a href="' . buildPaginationUrl($i) . '" class="pagination-number ' . $active_class . '">' . $i . '</a>';
            }

            // Show last page if not in range
            if ($end_page < $total_page) {
              if ($end_page < $total_page - 1) {
                echo '<span class="pagination-ellipsis">...</span>';
              }
              echo '<a href="' . buildPaginationUrl($total_page) . '" class="pagination-number">' . $total_page . '</a>';
            }

            // Next page link
            if ($total_page > $page) {
              echo '<a href="' . buildPaginationUrl($page + 1) . '" class="pagination-btn next-btn" title="Next Page">';
              echo '<span class="d-none d-sm-inline">Next</span>';
              echo '<i class="fas fa-chevron-right"></i>';
              echo '</a>';
            }
            ?>
          </div>
        </div>
      </div>
      <?php
    }
    ?>
  </div>
</section>

<?php

// Fetching all the Footer Data
require('./includes/footer.inc.php');
?>