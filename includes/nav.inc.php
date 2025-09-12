<?php
// Fetching all the Functions and DB Code
require('./includes/functions.inc.php');
require('./includes/database.inc.php');

// Creates a session or resumes the current one based on a session identifier. 
session_start();

// Getting the URI From the Web
$uri = $_SERVER['REQUEST_URI'];

// Variable to store the page title used in title tag
$page_title = "";

// Flag variables to know which Page we are at
$home = true;
$login = false;
$register = false;
$bookmark = false;
$changePass = false;
$category = false;
$search = false;

// Strpos returns the position of the search string in the main string or returns 0 (false)
// Checking if the page is Home Page
if (strpos($uri, "index.php") != false) {
  $page_title = " Home";
}

// Checking if the page is Login Page
if (strpos($uri, "login.php") != false) {
  $home = false;
  $login = true;

  // More specific title based on login type
  if (strpos($uri, "user-login.php") != false) {
    $page_title = " User Login";
  } else if (strpos($uri, "author-login.php") != false) {
    $page_title = " Author Login";
  } else {
    $page_title = " Login";
  }
}

// Checking if the page is Register Page
if (strpos($uri, "register.php") != false) {
  $home = false;
  $register = true;

  // More specific title based on register type
  if (strpos($uri, "user-register.php") != false) {
    $page_title = " User Registration";
  } else if (strpos($uri, "author-register.php") != false) {
    $page_title = " Author Registration";
  } else {
    $page_title = " Register";
  }
}

// Checking if the page is Bookmarks Page
if (strpos($uri, "bookmarks.php") != false) {
  $page_title = " Bookmarks";
  $home = false;
  $bookmark = true;
}

// Checking if the page is Bookmarks Page
if (strpos($uri, "user-change-password.php") != false) {
  $page_title = " Change Password";
  $home = false;
  $changePass = true;
}

// Checking if the page is Home Page
if (strpos($uri, "categories.php") != false) {
  $page_title = " Categories";
  $home = false;
  $category = true;
}

// Checking if the page is Search Page
if (strpos($uri, "search.php") != false) {
  $page_title = " Search";
  $home = false;
  $search = true;
}

// Checking if the page is Articles Page
if (strpos($uri, "articles.php") != false) {
  $home = false;
  $page_title = "All Article";
}

// Checking if the page is New Article Page
if (strpos($uri, "news.php") != false) {
  $home = false;
  $page_title = "News Article";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- PARTIAL CSS INCLUSIONS -->
  <link rel="stylesheet" href="./assets/css/partials/0-fonts.css" />
  <link rel="stylesheet" href="./assets/css/partials/1-variables.css" />
  <link rel="stylesheet" href="./assets/css/partials/2-reset.css" />
  <link rel="stylesheet" href="./assets/css/partials/3-typography.css" />
  <link rel="stylesheet" href="./assets/css/partials/4-component.css" />

  <!-- CUSTOM CSS INCLUSIONS -->
  <link rel="stylesheet" href="./assets/css/style.css" />

  <!-- RESPONSIVITY CSS INCLUSIONS -->
  <link rel="stylesheet" href="./assets/css/responsivity/media-queries.css" />

  <!-- BOOTSTRAP CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- SEARCH PAGE CSS -->
  <link rel="stylesheet" href="./assets/css/search.css" />

  <!-- FAVICON LINK -->
  <link rel="icon" href="./assets/images/favicon.ico" type="image/x-icon" />

  <!-- TITLE OF THE PAGE -->
  <title>NewsGrid | The Official News Portal | <?php echo $page_title; ?></title>

  <!-- FONTAWESOME LINK -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />

  <!-- SWEETALERT2 CSS & JS -->
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js"></script>

  <!-- CUSTOM SWEETALERT2 WRAPPER -->
  <script src="./assets/js/sweetalert-wrapper.js"></script>

  <!-- NAVBAR DROPDOWN SCRIPT -->
  <script src="./assets/js/navbar-dropdown.js"></script>
</head>

<body>

  <!-- ======== BACK TO TOP BUTTON ======== -->
  <button onclick="topFunction()" class="topNavBtn" id="topNavBtn" title="Go to top"><i
      class="fa fa-arrow-up"></i></button>


  <!-- ======== NAVBAR ======== -->
  <nav class="navbar">
    <div class="logo"><a href="./index.php"><img src="./assets/images/logo.png" /></a></div>

    <!-- Hamburger Menu Button -->
    <div class="hamburger" id="hamburger">
      <span></span>
      <span></span>
      <span></span>
    </div>

    <ul class="nav-menu" id="nav-menu">
      <!-- We ECHO class current based upon the boolean variables used in above PHP Snippet -->
      <li><a href="./index.php" <?php if ($home)
        echo 'class="current"' ?>>Home</a></li>
        <li><a href="./categories.php" <?php if ($category)
        echo 'class="current"' ?>>Categories</a></li>
        <li><a href="./bookmarks.php" <?php if ($bookmark)
        echo 'class="current"' ?>>Bookmarks</a></li>
        <?php
      if (isset($_SESSION['USER_NAME'])) {
      } else {
        ?>
        <!-- Desktop login dropdown -->
        <li class="dropdown desktop-only">
          <a href="./user-login.php" class="dropdown-toggle<?php if ($login || $register)
            echo ' current' ?>">Login <i class="fas fa-chevron-down"></i></a>
            <ul class="dropdown-menu">
              <li><a href="./user-login.php">Reader</a></li>
              <li><a href="./author-login.php">Author</a></li>
            </ul>
          </li>

          <!-- Mobile login menu items -->
          <li class="mobile-only"><a href="./user-login.php" <?php if ($login && strpos($uri, "user-login.php") != false)
            echo ' class="current"' ?>>Login as Reader</a></li>
          <li class="mobile-only"><a href="./author-login.php" <?php if ($login && strpos($uri, "author-login.php") != false)
            echo ' class="current"' ?>>Login as Author</a></li>
        <?php
      }
      ?>
      <li>
        <a href="./search.php" <?php if ($search)
          echo 'class="current"' ?>>
            <span>Search</span>
            <i id="search-icon" class="fas fa-search"></i>
          </a>
        </li>
        <?php

        // If user is logged in
        if (isset($_SESSION['USER_NAME'])) {
          // Desktop dropdown Settings
          echo '
          <li class="dropdown desktop-only">
            <a href="#" class="dropdown-toggle' . ($changePass ? ' current' : '') . '">Settings <i class="fas fa-chevron-down"></i></a>
            <ul class="dropdown-menu">
              <li><a href="./user-change-password.php">Change Password</a></li>
              <li><a href="./logout.php">Logout</a></li>
            </ul>
          </li>
          ';

          // Mobile menu items (akan disembunyikan di desktop)
          echo '<li class="mobile-only"><a href="./user-change-password.php"' . ($changePass ? ' class="current"' : '') . '>Change Password</a></li>';
          echo '<li class="mobile-only"><a href="./logout.php">Logout</a></li>';

          echo '<li class="user-greeting"><a disabled>Hello ' . $_SESSION["USER_NAME"] . ' !</a></li>';
        }
        ?>
    </ul>
  </nav>

  <!-- NAVBAR RESPONSIVE SCRIPT -->
  <script src="./assets/js/navbar-collapse.js"></script>