<?php
    $servername = "localhost";
    $username = "root";
    $password = "sr19971008";
    $dbname = "scholars";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
