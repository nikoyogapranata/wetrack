<?php
$servername = "localhost";
$username = "root";
$dbname = "wetrack";
$password = "";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select the database
if (!mysqli_select_db($conn, $dbname)) {
    die("Database selection failed: " . mysqli_error($conn));
}
?>