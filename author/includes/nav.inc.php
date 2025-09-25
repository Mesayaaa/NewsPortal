<?php
require('../includes/functions.inc.php');
require('../includes/database.inc.php');
session_start();

if (!isset($_SESSION['AUTHOR_LOGGED_IN'])) {
  alert("Please Login to Enter Author Portal", "warning", "Access Denied");
  redirect('../author-login.php');
}
$author_id = $_SESSION['AUTHOR_ID'];
$author_name = $_SESSION['AUTHOR_NAME'];

// Getting the URI From the Web
$uri = $_SERVER['REQUEST_URI'];

// Variable to store the page title used in title tag
$page_title = "";

// Flag variables to know which Page we are at
$home = true;
$pass = false;
$name = false;
$article = false;
$edit = false;

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

if (strpos($uri, "/edit-article.php") != false) {
  $page_title = "Edit Article";
  $home = false;
}

if (strpos($uri, "/add-article.php") != false) {
  $page_title = "Add Article";
  $home = false;
}

if (strpos($uri, "/change-password.php") != false) {
  $page_title = "Change Password";
  $home = false;
  $pass = true;
}
if (strpos($uri, "/change-name.php") != false) {
  $page_title = "Change Name";
  $home = false;
  $name = true;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>WinniCode Author Panel | <?php echo $page_title ?></title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon" />
  <link href="../assets/css/admin/style.css" rel="stylesheet" />
  <link href="../assets/css/partials/1-variables.css" rel="stylesheet" />

  <!-- SWEETALERT2 CSS & JS -->
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js"></script>

  <!-- CUSTOM SWEETALERT2 WRAPPER -->
  <script src="../assets/js/sweetalert-wrapper.js"></script>
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
        <a class="navbar-brand">WinniCode Author</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li <?php if ($home)
            echo 'class="active"' ?>><a href="./index.php"><i class="glyphicon glyphicon-home"></i>
                Dashboard</a></li>
            <li <?php if ($article)
            echo 'class="active"' ?>><a href="./articles.php"><i
                  class="glyphicon glyphicon-pencil"></i> Articles</a></li>
            <li <?php if ($pass)
            echo 'class="active"' ?>><a href="./change-password.php"><i
                  class="glyphicon glyphicon-cog"></i> Change Password</a></li>
            <li <?php if ($name)
            echo 'class="active"' ?>><a href="./change-name.php"><i
                  class="glyphicon glyphicon-user"></i> Change Name</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                aria-expanded="false">
                <i class="glyphicon glyphicon-user"></i>
              <?php echo $author_name ?>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="./logout.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header id="header">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-10">
          <h1><?php echo $page_title ?></h1>
        </div>
        <div class="col-md-2 btn-box">
          <a href="./add-article.php" class="btn btn-warning" type="button">
            Write New Article
          </a>
        </div>
      </div>
    </div>
  </header>