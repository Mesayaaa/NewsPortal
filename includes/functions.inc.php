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
      strpos($message_lower, 'login') !== false ||
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
    <div class="w-100 d-flex justify-content-center">
      <div class="no-articles-card">
        <div class="no-articles-icon">
          <i class="far fa-bookmark"></i>
        </div>
        <h3 class="no-articles-title">No Bookmarks Yet!</h3>
        <p class="no-articles-text">Start exploring and bookmark articles you want to read later.</p>
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
  echo '
    <div class="slide ' . $active . '">
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