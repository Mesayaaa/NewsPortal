<?php

// Development Connection
// Server name or IP Address
$host = "localhost";

// MySQL Username
$user = "root";

// MySQL Password
$pass = "";

// Default Database name
$db = "news-portal";

// Creating a connection to the DataBase with optimized settings
$con = mysqli_connect($host, $user, $pass, $db);

/* Deployment Connection

$host = "SERVER_URL";
$user = "USERNAME";
$pass = "PASSWORD";
$db = "DATABASE_NAME";
$port = 'PORT_NO';

$con = mysqli_connect($host, $user, $pass, $db, $port);
*/

// Checking If the connection is obtained
if (!$con) {
  die("Database Connection Error: " . mysqli_connect_error());
}

// Set connection charset to UTF-8 for better compatibility
mysqli_set_charset($con, "utf8mb4");

// Optional: Set timeout for queries (in seconds)
// mysqli_options($con, MYSQLI_OPT_CONNECT_TIMEOUT, 5);
