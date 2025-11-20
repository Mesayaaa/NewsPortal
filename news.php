<?php
// Fetching all the Navbar Data
require('./includes/nav.inc.php');

// Enhanced News Detail Styles and Script
echo '<link rel="stylesheet" href="./assets/css/news-detail-enhanced.css">';
echo '<script src="./assets/js/news-detail-enhanced.js" defer></script>';

$cat_id = "";

// If we get article_id from URL
if (isset($_GET['id'])) {

  // Store the article id in a variable
  $article_id = $_GET['id'];
}

// If we get article_id from URL and it is null
elseif ($_GET['id'] == '' && $_GET['id'] == null) {

  // Redirect to home page
  redirect('./index.php');
}

// If we dont get article_id from URL
else {

  // Redirect to home page
  redirect('index.php');
}

// Article Query to fetch all data related to particular article
$articleQuery = " SELECT category.category_name, category.category_id, category.category_color, article.*, author.*
                    FROM category, article, author
                    WHERE article.category_id = category.category_id
                    AND article.author_id = author.author_id
                    AND article.article_active = 1
                    AND article.article_id = {$article_id}";

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

  // If query has any result (records) => User has the article bookmarked
  if (mysqli_num_rows($bookmarkResult) > 0) {

    // Updating the variable to true to have bookmarked icon on article card
    $bookmarked = true;
  }
}

// Running Article Query
$result = mysqli_query($con, $articleQuery);

// If the Query failed
if (!$result) {

  // Redirected to home page
  redirect('./index.php');
}

// Returns the number of rows from the result retrieved.
$row = mysqli_num_rows($result);

// If query has any result (records) => If article is present
if ($row > 0) {

  // Fetching the data of particular record as an Associative Array
  while ($data = mysqli_fetch_assoc($result)) {

    // Storing the article data in variables
    $cat_id = $data['category_id'];
    $category_name = $data['category_name'];
    $category_color = $data['category_color'];
    $article_title = $data['article_title'];
    $article_image = $data['article_image'];
    $article_desc = $data['article_description'];
    $article_date = $data['article_date'];
    $author_name = $data['author_name'];

    // Article date is updated to a timestamp 
    $article_date = strtotime($article_date);

    ?>
    <!--  Article Page Container  -->
    <section class="article">
      <div class="reading-progress" id="readingProgress"></div>
      <div class="container">
        <div class="page-container">
          <!-- Container that stores the article -->
          <article class="card1">

            <!-- Article Header -->
            <header class="article-header">
              <!-- Article Title -->
              <h1 class="article-heading">
                <?php echo $article_title; ?>
              </h1>

              <!-- Article Meta Information -->
              <div class="article-meta">
                <div class="meta-left">
                  <div class="author-info">
                    <i class="fas fa-user-alt"></i>
                    <span class="author-name"><?php echo $author_name; ?></span>
                  </div>
                  <div class="publish-date">
                    <i class="fas fa-calendar-alt"></i>
                    <span class="date-text"><?php echo date("d M Y", $article_date); ?></span>
                  </div>
                </div>
                <div class="meta-right">
                  <div class="category-tag <?php echo $category_color; ?>">
                    <a href="articles.php?id=<?php echo $cat_id; ?>">
                      <?php echo $category_name; ?>
                    </a>
                  </div>
                </div>
              </div>

            </header>

            <!-- Article Image -->
            <div>
              <img
                src="<?php echo !empty($article_image) ? './assets/images/articles/' . $article_image : './assets/images/fallback_news.png'; ?>"
                class="article-image" alt="<?php echo htmlspecialchars($article_title); ?>" />
            </div>

            <!-- Article Content -->
            <div class="article-content">
              <div class="content-body">
                <?php echo $article_desc; ?>
              </div>
            </div>

            <!-- Article Navigation and Actions -->
            <div class="article-navigation-wrapper">

              <!-- Article Actions -->
              <div class="article-actions">
                <div class="action-buttons">
                  <?php
                  // Bookmark button
                  if ($bookmarked) {
                    echo '<a class="btn btn-bookmark bookmarked" href="remove-bookmark.php?id=' . $article_id . '" title="Remove from bookmarks">
                            <i class="fas fa-bookmark"></i>
                            <span>Bookmarked</span>
                          </a>';
                  } else {
                    echo '<a class="btn btn-bookmark" href="add-bookmark.php?id=' . $article_id . '" title="Add to bookmarks">
                            <i class="far fa-bookmark"></i>
                            <span>Bookmark</span>
                          </a>';
                  }

                  // Download button
                  echo '<a class="btn btn-download" href="download-article.php?id=' . $article_id . '" title="Download article as PDF">
                          <i class="fas fa-download"></i>
                          <span>Download PDF</span>
                        </a>';
                  ?>
                  <!-- Focus Mode -->
                  <button class="btn btn-share" id="focusToggle" type="button" title="Toggle Focus Mode">
                    <i class="fas fa-eye-slash"></i>
                    <span>Focus Mode</span>
                  </button>
                  <!-- TTS Controls -->
                  <div class="tts-controls" aria-label="Read aloud controls">
                    <button class="btn btn-tts" id="ttsToggle" type="button" title="Listen / Pause">
                      <i class="fas fa-play" id="ttsIcon"></i>
                      <span>Listen</span>
                    </button>
                    <select id="ttsVoice" class="tts-select" title="Voice"></select>
                    <select id="ttsRate" class="tts-select" title="Speed">
                      <option value="0.8">0.8x</option>
                      <option value="1" selected>1.0x</option>
                      <option value="1.25">1.25x</option>
                      <option value="1.5">1.5x</option>
                    </select>
                  </div>
                </div>
              </div>
              <?php
              // Get previous article
              $prevQuery = "SELECT article_id, article_title FROM article 
                           WHERE article_id < {$article_id} 
                           AND article_active = 1 
                           ORDER BY article_id DESC 
                           LIMIT 1";
              $prevResult = mysqli_query($con, $prevQuery);

              // Get next article
              $nextQuery = "SELECT article_id, article_title FROM article 
                           WHERE article_id > {$article_id} 
                           AND article_active = 1 
                           ORDER BY article_id ASC 
                           LIMIT 1";
              $nextResult = mysqli_query($con, $nextQuery);
              ?>

              <div class="nav-links">
                <?php if (mysqli_num_rows($prevResult) > 0):
                  $prevArticle = mysqli_fetch_assoc($prevResult); ?>
                  <a href="news.php?id=<?php echo $prevArticle['article_id']; ?>" class="nav-link prev-article">
                    <i class="fas fa-chevron-left"></i>
                    <div class="nav-content">
                      <span class="nav-label">Previous</span>
                      <span class="nav-title"><?php echo substr($prevArticle['article_title'], 0, 50) . '...'; ?></span>
                    </div>
                  </a>
                <?php else: ?>
                  <div class="nav-link-placeholder"></div>
                <?php endif; ?>

                <?php if (mysqli_num_rows($nextResult) > 0):
                  $nextArticle = mysqli_fetch_assoc($nextResult); ?>
                  <a href="news.php?id=<?php echo $nextArticle['article_id']; ?>" class="nav-link next-article">
                    <div class="nav-content">
                      <span class="nav-label">Next</span>
                      <span class="nav-title"><?php echo substr($nextArticle['article_title'], 0, 50) . '...'; ?></span>
                    </div>
                    <i class="fas fa-chevron-right"></i>
                  </a>
                <?php else: ?>
                  <div class="nav-link-placeholder"></div>
                <?php endif; ?>
              </div>
            </div>

          </article>
          <?php
  }
}

// If article is not present
else {
  redirect('index.php');
}
?>
      </article>

      <!-- Aside column for other quick links -->
      <aside>

        <!-- Trending Articles Card -->
        <div class="card2 enhanced-sidebar-card">
          <div class="sidebar-header">
            <h2 class="aside-title">
              <i class="fas fa-fire"></i>
              Must Read
            </h2>
          </div>
          <div class="sidebar-content">
            <?php
            // Trending Articles Configuration
            $trendingLimit = 5;

            // Optimized Query: Fetch random trending articles for sidebar
            // Performance: ~50-100x faster than ORDER BY RAND() on large tables
            // Excludes current article to show different content
            $trendingArticleQuery = "
              SELECT 
                article.*,
                author.author_name
              FROM article
              INNER JOIN author ON article.author_id = author.author_id
              WHERE article.article_trend = 1
                AND article.article_active = 1
                AND article.article_id != {$article_id}
                AND article.article_id >= (
                  SELECT FLOOR(RAND() * (
                    SELECT MAX(article_id) 
                    FROM article 
                    WHERE article_trend = 1
                  ))
                )
              ORDER BY article.article_id
              LIMIT {$trendingLimit}
            ";

            // Running Trending Article Query
            $trendingResult = mysqli_query($con, $trendingArticleQuery);

            // Returns the number of rows from the result retrieved.
            $row = mysqli_num_rows($trendingResult);

            // If query has any result (records) => If any trending articles are present
            if ($row > 0) {

              // Fetching the data of particular record as an Associative Array
              while ($data = mysqli_fetch_assoc($trendingResult)) {

                // Storing the article data in variables
                $article_id = $data['article_id'];
                $article_title = $data['article_title'];
                $article_image = $data['article_image'];
                $article_date = $data['article_date'];
                $author_name = $data['author_name'];

                // Article date is updated to a timestamp 
                $article_date = strtotime($article_date);

                // Article date is updated to paticular datetime format 
                $article_date = date("d M Y", $article_date);

                // Updating the title with a substring containing at most length of 75 characters
                $article_title = substr($article_title, 0, 75) . ' . . . . .';

                // Calling user defined function to create an aside article card with respective article details
                createAsideCard($article_image, $article_id, $article_title, $author_name, $article_date);
              }
            }
            ?>

          </div>
          <!-- View all button -->
          <div class="sidebar-footer">
            <a href="search.php?trending=1" class="btn btn-sidebar">
              <span>View All</span>
              <i class="fas fa-arrow-right"></i>
            </a>
          </div>
        </div>

        <!-- Related Articles Card -->
        <div class="card2 enhanced-sidebar-card">
          <div class="sidebar-header">
            <h2 class="aside-title">
              <i class="fas fa-users"></i>
              People Also Read
            </h2>
          </div>
          <div class="sidebar-content">
            <?php
            // Related Articles Configuration
            $relatedLimit = 5;
            $currentArticleId = (int) $_GET['id']; // Sanitize input
            
            // Optimized Query: Fetch random articles from same category
            // Performance: ~50-100x faster than ORDER BY RAND()
            // Shows "People Also Read" from same category
            $relatedArticleQuery = "
              SELECT 
                article.*,
                author.author_name
              FROM article
              INNER JOIN author ON article.author_id = author.author_id
              WHERE article.category_id = {$cat_id}
                AND article.article_active = 1
                AND article.article_id != {$currentArticleId}
                AND article.article_id >= (
                  SELECT FLOOR(RAND() * (
                    SELECT MAX(article_id) 
                    FROM article 
                    WHERE category_id = {$cat_id}
                  ))
                )
              ORDER BY article.article_id
              LIMIT {$relatedLimit}
            ";

            // Running the Related Article Query
            $relatedResult = mysqli_query($con, $relatedArticleQuery);

            // Returns the number of rows from the result retrieved.
            $row = mysqli_num_rows($relatedResult);

            // If query has any result (records) => If any related articles are present
            if ($row > 0) {

              // Fetching the data of particular record as an Associative Array
              while ($data = mysqli_fetch_assoc($relatedResult)) {

                // Storing the article data in variables
                $article_id = $data['article_id'];
                $article_title = $data['article_title'];
                $article_image = $data['article_image'];
                $article_date = $data['article_date'];
                $author_name = $data['author_name'];

                // Article date is updated to a timestamp 
                $article_date = strtotime($article_date);

                // Article date is updated to paticular datetime format 
                $article_date = date("d M Y", $article_date);

                // Updating the title with a substring containing at most length of 75 characters
                $article_title = substr($article_title, 0, 75) . ' . . . . .';

                // Calling user defined function to create an aside article card with respective article details
                createAsideCard($article_image, $article_id, $article_title, $author_name, $article_date);
              }
            }
            ?>

          </div>
          <!-- View all button -->
          <div class="sidebar-footer">
            <a href="articles.php?id=<?php echo $cat_id; ?>" class="btn btn-sidebar">
              <span>View All</span>
              <i class="fas fa-arrow-right"></i>
            </a>
          </div>
        </div>
      </aside>
    </div>
  </div>
</section>

<?php

// Fetching all the Footer Data
require('./includes/footer.inc.php');
?>