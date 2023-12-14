<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todo_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Task Name</th><th>Task Description</th><th>Created At</th><th>Updated At</th><th>Action</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['task_name']}</td>";
        echo "<td>{$row['task_description']}</td>";
        echo "<td>{$row['created_at']}</td>";
        echo "<td>{$row['updated_at']}</td>";
        echo "<td><button class='edit-button' data-task-id='{$row['id']}' data-task-name='{$row['task_name']}' data-task-description='{$row['task_description']}'>Edit</button> ";
        echo "<button class='delete-button' data-task-id='{$row['id']}'>Delete</button></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No tasks found.";
}

$conn->close();
?>
