<?php
// db_config.php

function connectToDatabase() {
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "scholars_database";
    $connection = new mysqli($servername, $username, $password, $dbname);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    return $connection;
}
