<?php

// Function For Redirecting
function redirect($link)
{
  ?>
  <script>
    window.location.href = '<?php echo $link ?>';
  </script>
  <?php
  die();
}

// Store an alert to be shown on the next page load (after redirect)
function flash_alert($message, $type = 'info', $title = null)
{
  if (session_status() !== PHP_SESSION_ACTIVE) {
    if (!headers_sent()) {
      session_start();
    } else {
      return;
    }
  }

  $_SESSION['FLASH_ALERT'] = [
    'message' => (string) $message,
    'type' => (string) $type,
    'title' => $title !== null ? (string) $title : null,
  ];
}

// Convenience helper: flash an alert and redirect in one call.
function redirect_with_alert($link, $message, $type = 'info', $title = null)
{
  flash_alert($message, $type, $title);
  redirect($link);
}

// Render (and clear) any pending flash alert.
// Call this after SweetAlert2 + sweetalert-wrapper.js are loaded.
function render_flash_alert()
{
  if (session_status() !== PHP_SESSION_ACTIVE) {
    return;
  }
  if (!isset($_SESSION['FLASH_ALERT']) || !is_array($_SESSION['FLASH_ALERT'])) {
    return;
  }

  $flash = $_SESSION['FLASH_ALERT'];
  unset($_SESSION['FLASH_ALERT']);

  $message = isset($flash['message']) ? (string) $flash['message'] : '';
  $type = isset($flash['type']) ? (string) $flash['type'] : 'info';
  $title = isset($flash['title']) ? $flash['title'] : null;

  $jsMessage = json_encode($message, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  $jsType = json_encode($type, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  $jsTitle = json_encode($title !== null ? (string) $title : null, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

  ?>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      try {
        if (typeof Swal === 'undefined') return;

        var type = <?php echo $jsType; ?>;
        var title = <?php echo $jsTitle; ?>;
        var message = <?php echo $jsMessage; ?>;

        if (!title) {
          title = (type === 'success') ? 'Success!' : (type === 'error') ? 'Error!' : (type === 'warning') ? 'Warning!' : 'Notice';
        }

        if (type === 'success' && typeof showSuccess === 'function') {
          showSuccess(title, message);
        } else if (type === 'error' && typeof showError === 'function') {
          showError(title, message);
        } else if (type === 'warning' && typeof showWarning === 'function') {
          showWarning(title, message);
        } else if (typeof showInfo === 'function') {
          showInfo(title, message);
        } else {
          Swal.fire({
            icon: type || 'info',
            title: title,
            text: message,
            customClass: { popup: 'swal-flash-popup' }
          });
        }
      } catch (e) {
        // no-op
      }
    });
  </script>
  <?php
}

// Function For Enhanced Alert Message using SweetAlert2
function alert($message, $type = 'info', $title = null)
{
  // Auto-detect message type if not specified
  if ($type === 'info' && $title === null) {
    $message_lower = strtolower($message);
    if (
      strpos($message_lower, 'success') !== false ||
      strpos($message_lower, 'updated') !== false ||
      strpos($message_lower, 'added') !== false ||
      strpos($message_lower, 'activated') !== false ||
      strpos($message_lower, 'trending') !== false
    ) {
      $type = 'success';
      $title = $title ?: 'Success!';
    } elseif (
      strpos($message_lower, 'error') !== false ||
      strpos($message_lower, 'wrong') !== false ||
      strpos($message_lower, 'failed') !== false ||
      strpos($message_lower, 'not registered') !== false
    ) {
      $type = 'error';
      $title = $title ?: 'Error!';
    } elseif (
      strpos($message_lower, 'please') !== false ||
      strpos($message_lower, 'try again') !== false
    ) {
      $type = 'warning';
      $title = $title ?: 'Warning!';
    } else {
      $title = $title ?: 'Notice';
    }
  }

  $title = $title ?: 'Notice';
  ?>
  <script>
    // Wait for SweetAlert2 to be loaded
    document.addEventListener('DOMContentLoaded', function () {
      if (typeof Swal !== 'undefined') {
        <?php if ($type === 'success'): ?>
          showSuccess('<?php echo $title ?>', '<?php echo addslashes($message) ?>');
        <?php elseif ($type === 'error'): ?>
          showError('<?php echo $title ?>', '<?php echo addslashes($message) ?>');
        <?php elseif ($type === 'warning'): ?>
          showWarning('<?php echo $title ?>', '<?php echo addslashes($message) ?>');
        <?php else: ?>
          showInfo('<?php echo $title ?>', '<?php echo addslashes($message) ?>');
        <?php endif; ?>
      } else {
        // Fallback to native alert if SweetAlert2 is not loaded
        alert('<?php echo addslashes($message) ?>');
      }
    });
  </script>
  <?php
}

// Function to get Safe Values from Forms
function get_safe_value($str)
{
  global $con;
  $str = mysqli_real_escape_string($con, $str);
  return $str;
}

/**
 * Build optimized random selection query
 * 
 * This function generates a WHERE clause for efficient random row selection
 * Performance: 5-100x faster than ORDER BY RAND() depending on table size
 * 
 * @param string $table - Table name
 * @param string $idColumn - Primary key column name (default: 'id')
 * @param array $conditions - Additional WHERE conditions (optional)
 * @return string - WHERE clause for random selection
 * 
 * @example
 * $where = buildRandomQuery('article', 'article_id', ['article_active = 1']);
 * $sql = "SELECT * FROM article WHERE $where LIMIT 5";
 */
function buildRandomQuery($table, $idColumn = 'id', $conditions = [])
{
  $whereClause = '';

  // Add additional conditions if provided
  if (!empty($conditions)) {
    $whereClause = implode(' AND ', $conditions) . ' AND ';
  }

  // Add optimized random selection
  $whereClause .= "{$idColumn} >= (
    SELECT FLOOR(RAND() * (SELECT MAX({$idColumn}) FROM {$table}))
  )";

  return $whereClause;
}

/**
 * Sanitize integer input from GET/POST
 * 
 * Prevents SQL injection by ensuring value is an integer
 * 
 * @param mixed $value - Value to sanitize
 * @param int $default - Default value if sanitization fails
 * @return int - Sanitized integer value
 */
function sanitize_int($value, $default = 0)
{
  return filter_var($value, FILTER_VALIDATE_INT) !== false
    ? (int) $value
    : $default;
}

/**
 * Execute query with error handling
 * 
 * @param mysqli $con - Database connection
 * @param string $query - SQL query to execute
 * @return mysqli_result|false - Query result or false on failure
 */
function execute_query($con, $query)
{
  $result = mysqli_query($con, $query);

  if (!$result) {
    // In production, log this error instead of displaying
    error_log("Database Query Error: " . mysqli_error($con));
    error_log("Query: " . $query);
  }

  return $result;
}

// Function to Create Article Card
function createArticleCard($title, $img, $data, $category, $cat_id, $id, $color, $new, $trend, $marked)
{
  echo '
    <article class="card">
      <a href="';

  if (isset($_SESSION['USER_LOGGED_IN'])) {
    if ($marked) {
      echo 'remove-bookmark.php?id=' . $id;
    } else {
      echo 'add-bookmark.php?id=' . $id;
    }
  } else {
    echo 'bookmarks.php';
  }
  echo '" class="bookmark" title="';

  if ($marked) {
    echo 'Remove from Bookmarks">
      <i class="fas fa-bookmark"></i>
    </a>';
  } else {
    echo 'Add to Bookmarks">
      <i class="far fa-bookmark"></i>
    </a>';
  }

  echo '<div class="card-img">
        <img src="' . (!empty($img) ? './assets/images/articles/' . $img : './assets/images/fallback_news.png') . '" />
      </div>
      <div class="card-content">
        <div class="card-tags">
          <div class="tag ' . $color . '"><a href="articles.php?id=' . $cat_id . '">' . $category . '</a></div>';
  if ($new) {
    echo '  <div class="tag tag-new">NEW</div>';
  }
  if ($trend) {
    echo '  <div class="tag tag-trend"><a href="search.php?trending=1">TRENDING</a></div>';
  }
  echo '
        </div>
        <h3 class="card-title">
          ' . $title . '
        </h3>
        <p class="card-data">
          ' . $data . '
        </p>
        <a href="news.php?id=' . $id . '" class="btn btn-card">Read More <span>&rarr;</span></a>
      </div>
    </article>';
}

// Function to Create Category Card
function createCategoryCard($title, $img, $data, $id)
{
  echo '
    <article class="card">
      <div class="card-img">
        <img src="./assets/images/category/' . $img . '" />
      </div>
      <div class="card-content">
        <h3 class="card-title text-center">
          ' . $title . '
        </h3>
        <p class="card-data">
          ' . $data . '
        </p>
        <div class="btn-block">
          <a href="articles.php?id=' . $id . '" class="btn btn-card">
            Read More 
            <span>&rarr;</span>
          </a>
        </div>
      </div>
    </article>';
}

// Function to Create a More Card
function createMoreCard($link)
{
  echo '
    <a href="' . $link . '" class="card card-more d-flex">
      <h3>MORE +</h3>
    </a>
    ';
}

// Function to Create a No Articles Card
function createNoArticlesCard()
{
  echo '
    <div class="no-articles-wrapper w-100 d-flex justify-content-center">
      <div class="no-articles-card">
        <div class="no-articles-icon">
          <i class="far fa-bookmark"></i>
        </div>
        <h3 class="no-articles-title">No Articles Yet!</h3>
        <p class="no-articles-text">Start exploring articles you want to read.</p>
        <div class="no-articles-actions">
          <a href="./index.php" class="btn btn-primary-custom">
            <i class="fas fa-home me-2"></i>Browse Articles
          </a>
          <a href="./categories.php" class="btn btn-outline-custom">
            <i class="fas fa-tags me-2"></i>View Categories
          </a>
        </div>
      </div>
    </div>
    ';
}

// Function to Create a No Bookmarks Card
function createNoBookmarksCard()
{
  echo '
    <div class="no-articles-wrapper no-articles-wrapper--center w-100 d-flex justify-content-center">
      <div class="no-articles-card">
        <div class="no-articles-icon">
          <i class="far fa-bookmark"></i>
        </div>
        <h3 class="no-articles-title">No Articles Yet!</h3>
        <p class="no-articles-text">Start exploring articles you want to read later.</p>
        <div class="no-articles-actions">
          <a href="./index.php" class="btn btn-primary-custom">
            <i class="fas fa-home me-2"></i>Browse Articles
          </a>
          <a href="./categories.php" class="btn btn-outline-custom">
            <i class="fas fa-tags me-2"></i>View Categories
          </a>
        </div>
      </div>
    </div>
    ';
}

// Function to Create a Slider
function createSlider($active, $img, $color, $category, $title, $content, $id, $new, $trend)
{
  // Strip HTML tags from content for slider preview
  $content = strip_tags($content);

  echo '
    <div class="slide ' . $active . '">
      <div class="slide-image-wrapper">
        <img src="' . (!empty($img) ? './assets/images/articles/' . $img : './assets/images/fallback_news.png') . '"/>
        <div class="info">
          <div class=" tag ' . $color . '">' . $category . '</div>';
  if ($new) {
    echo '  <div class="tag tag-new">NEW</div>';
  }
  if ($trend) {
    echo '  <div class="tag tag-trend">TRENDING</div>';
  }
  echo
    '
          <h1>' . $title . '</h1>
          <p>
            ' . $content . '
          </p>
          <a href="news.php?id=' . $id . '" class="btn btn-primary">Read More</a>
        </div>
      </div>
    </div>';
}

// Function to Create Aside Card
function createAsideCard($img, $id, $title, $author, $date)
{
  echo '
      <div class="aside-card">
        <div class="aside-card-img">
          <img src="' . (!empty($img) ? './assets/images/articles/' . $img : './assets/images/fallback_news.png') . '" />
        </div>
        <div>
          <a class="aside-card-title" href="news.php?id=' . $id . '">
          ' . $title . '
          </a>
          <div class="aside-card-author">
            <i class="fas fa-user-alt"></i> ' . $author . '
          </div>
          <div class="aside-card-date">
            <i class="fas fa-calendar-alt"></i> ' . $date . '
          </div>
        </div>
      </div>
    ';
}

?>