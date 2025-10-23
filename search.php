<?php
// Fetching all the Navbar Data
require('./includes/nav.inc.php');
?>

<!-- Enhanced Search Section -->
<section class="search-hero">
  <div class="container">
    <!-- Enhanced Search Form -->
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="search-card">
          <form method="GET" class="search-form">
            <!-- Main Search Input -->
            <div class="search-input-group mb-4">
              <div class="input-group input-group-lg">
                <span class="input-group-text search-icon">
                  <i class="fas fa-search"></i>
                </span>
                <input 
                  class="form-control search-main-input" 
                  type="text" 
                  name="name" 
                  id="name" 
                  placeholder="Search articles, news, topics..." 
                  autocomplete="off"
                  value="<?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : ''; ?>"
                />
              </div>
            </div>

            <!-- Advanced Filters -->
            <div class="advanced-filters">
              <div class="row g-3">
                <!-- Category Filter -->
                <div class="col-md-6 col-lg-3">
                  <label for="category_select" class="form-label">
                    <i class="fas fa-tags me-2"></i>Category
                  </label>
                  <select name="category_select" id="category_select" class="form-select">
                    <option value="">All Categories</option>
            <?php

            // Category Query to fetch all the categories from DB in lexicographic order
            $categoryQuery = "SELECT * FROM category ORDER BY category_name ASC";

            // Running the Category query
            $result = mysqli_query($con, $categoryQuery);

            // Returns the number of rows from the result retrieved.
            $row = mysqli_num_rows($result);

            // If query has any result (records) => If there are categories
            if ($row > 0) {

              // Fetching the data of particular record as an Associative Array
              while ($data = mysqli_fetch_assoc($result)) {

                // Storing the category data in variables
                $category_id = $data['category_id'];
                $category_name = $data['category_name'];

                // Creating an option using the data retrieved
                echo '<option value="' . $category_id . '">' . $category_name . '</option>';
              }
            }
                    ?>
                  </select>
                </div>

                <!-- From Date Filter -->
                <div class="col-md-6 col-lg-3">
                  <label for="from_date" class="form-label">
                    <i class="fas fa-calendar-alt me-2"></i>From Date
                  </label>
                  <input 
                    type="date" 
                    name="from_date" 
                    id="from_date" 
                    class="form-control"
                    max="<?php echo date("Y-m-d") ?>"
                    value="<?php echo isset($_GET['from_date']) ? $_GET['from_date'] : ''; ?>"
                  />
                </div>

                <!-- To Date Filter -->
                <div class="col-md-6 col-lg-3">
                  <label for="to_date" class="form-label">
                    <i class="fas fa-calendar-check me-2"></i>To Date
                  </label>
                  <input 
                    type="date" 
                    name="to_date" 
                    id="to_date" 
                    class="form-control"
                    max="<?php echo date("Y-m-d") ?>"
                    value="<?php echo isset($_GET['to_date']) ? $_GET['to_date'] : ''; ?>"
                  />
                </div>

                <!-- Trending Filter -->
                <div class="col-md-6 col-lg-3">
                  <label class="form-label">
                    <i class="fas fa-fire me-2"></i>Options
                  </label>
                  <div class="form-check trending-check">
                    <input 
                      class="form-check-input" 
                      type="checkbox" 
                      name="trending" 
                      id="trending" 
                      value="1"
                      <?php echo (isset($_GET['trending']) && $_GET['trending'] == '1') ? 'checked' : ''; ?>
                    />
                    <label class="form-check-label" for="trending">
                      <i class="fas fa-chart-line me-1"></i>Trending Only
                    </label>
                  </div>
                </div>
              </div>
              
              <!-- Action Buttons -->
              <div class="row mt-4">
                <div class="col-12 text-center">
                  <button type="submit" name="search" class="btn btn-search me-3">
                    <i class="fas fa-search me-2"></i>Search Articles
                  </button>
                  <?php
                  // Check if any filters are active
                  $hasActiveFilters = !empty($_GET['name']) || !empty($_GET['category_select']) || 
                                    !empty($_GET['from_date']) || !empty($_GET['to_date']) || 
                                    !empty($_GET['trending']);
                  
                  if ($hasActiveFilters) {
                    echo '<a href="./search.php" class="btn btn-clear">
                            <i class="fas fa-times me-2"></i>Clear Filters
                          </a>';
                  }
                  ?>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Container to store the Search Results -->
<section class="py-1 category-list"></section>
  <div class="container">
    <h2 class="search-heading">Search Results :</h2>
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

      // Declaring trending variable
      $trending = "";

      // Check if we get trending value from URL
      if (isset($_GET['trending'])) {

        // Fetching trending value via GET and passing them to user defined 
        // function to get rid of special characters used in SQL
        $trending = get_safe_value($_GET['trending']);
      }

      // Declaring category ID variable
      $cat_id = "";

      // Check if we get category_ID value from URL
      if (isset($_GET['category_select'])) {

        // Fetching category_ID value via GET and passing them to user defined 
        // function to get rid of special characters used in SQL
        $cat_id = get_safe_value($_GET['category_select']);
      }

      // Declaring name variable
      $name = "";

      // Check if we get name value from URL
      if (isset($_GET['name'])) {

        // Fetching name value via GET and passing them to user defined 
        // function to get rid of special characters used in SQL
        $name = get_safe_value($_GET['name']);
      }

      // Declaring from date variable
      $from_date = "";

      // Check if we get from_date value from URL
      if (isset($_GET['from_date'])) {

        // Fetching from date value via GET and passing them to user defined 
        // function to get rid of special characters used in SQL
        $from_date = get_safe_value($_GET['from_date']);
      }

      $to_date = "";
      // Check if we get to_date value from URL
      if (isset($_GET['to_date'])) {

        // Fetching to date value via GET and passing them to user defined 
        // function to get rid of special characters used in SQL
        $to_date = get_safe_value($_GET['to_date']);
      }

      // Initialising the Search Query with simple select Query
      $searchQuery = "SELECT * FROM article WHERE ";

      // If Category_ID filter is present
      if ($cat_id != "") {

        // Search Query is updated with category_ID condition
        $searchQuery .= "category_id = {$cat_id}";
      }

      // If Category_ID filter is not present
      else {

        // Search Query is updated with category_ID condition
        $searchQuery .= "category_id IS NOT NULL";
      }

      // If name filter is present
      if ($name != "") {

        // Search Query is updated with name condition
        $searchQuery .= ' AND article_title LIKE "%' . $name . '%"';
      }

      // If name filter is not present
      else {

        // Search Query is updated with name condition
        $searchQuery .= " AND article_title IS NOT NULL";
      }

      // If trending filter is present
      if ($trending != "") {

        // Search Query is updated with trending condition
        $searchQuery .= " AND article_trend = 1";
      }

      // If trending filter is not present
      else {

        // Search Query is updated with trending condition
        $searchQuery .= " AND article_trend IS NOT NULL";
      }

      // If both from and to date filters are present
      if ($from_date != "" && $to_date != "") {

        // Search Query is updated with from and to date condition
        $searchQuery .= ' AND article_date BETWEEN "' . $from_date . '" AND "' . $to_date . '" ';
      }

      // If both to and from date filter values are same
      else if ($to_date == $from_date && $to_date != "") {

        // Search Query is updated with date condition
        $searchQuery .= ' AND article_date ="' . $from_date . '"';
      }

      // If only from date filter is present 
      else if ($to_date == "" && $from_date != "") {

        // Search Query is updated with from date condition
        $searchQuery .= ' AND article_date >= "' . $from_date . '"';
      }

      // If only to date filter is present
      else if ($from_date == "" && $to_date != "") {

        // Search Query is updated with to date condition
        $searchQuery .= ' AND article_date <= "' . $to_date . '"';
      }

      // Search Query is updated with the article active condition => all articles with above search filters
      $searchQuery .= " AND article_active = 1 ";

      // Search Query1 is updated with lexicographic order condition and LIMIT condition => limit no of articles with above search filters
      $searchQuery1 = $searchQuery . " ORDER BY article_title LIMIT {$offset}, {$limit}";

      // Running the Search Query
      $searchResult = mysqli_query($con, $searchQuery1);

      // Returns the number of rows from the result retrieved.
      $row = mysqli_num_rows($searchResult);

      // If query has any result (records) => If any articles are present with the above filters
      if ($row > 0) {

        // Fetching the data of particular record as an Associative Array
        while ($data = mysqli_fetch_assoc($searchResult)) {

          // Storing the article data in variables
          $article_id = $data['article_id'];
          $category_id = $data['category_id'];
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

          // Category Query to fetch the category details of the particular article
          $categorysql = "SELECT category_name, category_color 
                            FROM category 
                            WHERE category_id = {$category_id}";

          // Running the Category Query
          $categoryres = mysqli_query($con, $categorysql);

          // Fetching the data of particular record as an Associative Array
          $categorydata = mysqli_fetch_assoc($categoryres);

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

          // Declaring the Category variables
          $category_color = $categorydata['category_color'];
          $category_name = $categorydata['category_name'];

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

      // If query has no records => If no articles are present with the above filters
      else {
        echo "</div>";

        // Calling user defined function to create a card that says no articles present
        createNoArticlesCard();
      }

      // Running Search Query to get all the article with above search filters
      $paginationResult = mysqli_query($con, $searchQuery);

      // If query has any result (records) => If articles are present with above search filters
      if (mysqli_num_rows($paginationResult) > 0) {

        // Returns the number of rows from the result retrieved => total no of articles
        $total_articles = mysqli_num_rows($paginationResult);

        // Calculated no of pages based on limit and no of articles
        $total_page = ceil($total_articles / $limit);


        echo "</div>";
        ?>


        <!-- Enhanced Pagination Block -->
        <div class="search-pagination-wrapper">
          <div class="search-pagination">
            <?php
            // Function to build clean pagination URL
            function buildPaginationUrl($page_num) {
              global $cat_id, $name, $from_date, $to_date, $trending;
              $params = array();
              if ($cat_id != "") $params['category_select'] = $cat_id;
              if ($name != "") $params['name'] = $name;
              if ($from_date != "") $params['from_date'] = $from_date;
              if ($to_date != "") $params['to_date'] = $to_date;
              if ($trending != "") $params['trending'] = $trending;
              $params['page'] = $page_num;
              return 'search.php?' . http_build_query($params);
            }

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
      <?php
      }
      ?>
        </div>

      </div>
    </div>
</section>


<?php

// Fetching all the Footer Data
require('./includes/footer.inc.php');
?>