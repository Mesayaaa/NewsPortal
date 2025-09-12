<?php
require('../includes/functions.inc.php');
require('../includes/database.inc.php');
session_start();

if (!isset($_SESSION['ADMIN_LOGGED_IN'])) {
  alert("Please Login to Enter Admin Panel", "warning", "Access Denied");
  redirect('./login.php');
}

$admin_name = "Admin";

// Getting the URI From the Web
$uri = $_SERVER['REQUEST_URI'];

// Variable to store the page title used in title tag
$page_title = "";

// Flag variables to know which Page we are at
$home = true;
$pass = false;
$category = false;
$article = false;

// Strpos returns the position of the search string in the main string or returns 0 (false)
// Checking if the page is Home Page
if (strpos($uri, "/index.php") != false) {
  $page_title = " Dashboard";
}

if (strpos($uri, "/articles.php") != false) {
  $page_title = " Articles";
  $home = false;
  $article = true;
}

if (strpos($uri, "/categories.php") != false) {
  $page_title = " Categories";
  $home = false;
  $category = true;
}

if (strpos($uri, "/add-category.php") != false) {
  $page_title = "Add Category";
  $category = true;
  $home = false;
}

if (strpos($uri, "/change-password.php") != false) {
  $page_title = "Change Password";
  $home = false;
  $pass = true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>NewsGrid Admin Panel | <?php echo $page_title ?></title>

  <link href="../assets/css/partials/4-component.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon" />
  <link href="../assets/css/admin/style.css" rel="stylesheet" />
  <link href="../assets/css/partials/1-variables.css" rel="stylesheet" />

  <!-- SWEETALERT2 CSS & JS -->
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js"></script>

  <!-- CUSTOM SWEETALERT2 WRAPPER -->
  <script src="../assets/js/sweetalert-wrapper.js"></script>

  <!-- BOOTSTRAP JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <!-- ADMIN ENHANCEMENTS -->
  <script src="../assets/js/admin/admin-enhancements.js"></script>
  <script src="../assets/js/admin/file-upload-enhanced.js"></script>
</head>

<body>
  <nav class="navbar navbar-default navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
          aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./index.php">
          <i class="glyphicon glyphicon-dashboard"></i>
          NewsGrid Admin
        </a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li <?php if ($home)
            echo 'class="active"' ?>>
              <a href="./index.php">
                <i class="glyphicon glyphicon-home"></i>
                Dashboard
              </a>
            </li>
            <li <?php if ($article)
            echo 'class="active"' ?>>
              <a href="./articles.php">
                <i class="glyphicon glyphicon-pencil"></i>
                Articles
              </a>
            </li>
            <li <?php if ($category)
            echo 'class="active"' ?>>
              <a href="./categories.php">
                <i class="glyphicon glyphicon-list"></i>
                Categories
              </a>
            </li>
            <li <?php if ($pass)
            echo 'class="active"' ?>>
              <a href="./change-password.php">
                <i class="glyphicon glyphicon-cog"></i>
                Settings
              </a>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                aria-expanded="false">
                <i class="glyphicon glyphicon-user"></i>
              <?php echo $admin_name ?>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="./change-password.php"><i class="glyphicon glyphicon-cog"></i> Settings</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="./logout.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header id="header">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1><?php echo $page_title ?></h1>
        </div>
      </div>
    </div>
  </header>