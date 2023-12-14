<?php

$servername = "localhost";
$username = "root";
$password = ""; // No password for the root user

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS todo_db";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully\n";
} else {
    echo "Error creating database: " . $conn->error . "\n";
}

// Select the database
$conn->select_db("todo_db");

// Create table
$tableSql = "CREATE TABLE IF NOT EXISTS tasks (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    task_name VARCHAR(255) NOT NULL,
    task_description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($tableSql) === TRUE) {
    echo "Table 'tasks' created successfully\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}

// Close connection
$conn->close();
?>
