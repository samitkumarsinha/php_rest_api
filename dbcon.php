<?php
    //db credentials
    $servername = "localhost";
    $username = "236430";
    $password = "Unicorn1";
    $dbname = "236430";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    //return connection object
    return $conn;
?>		