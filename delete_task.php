<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todo_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $taskId = $_POST["taskId"];

    $sql = "DELETE FROM tasks WHERE id='$taskId'";

    if ($conn->query($sql) !== TRUE) {
        echo "Error deleting task: " . $conn->error;
    } else {
        // Display the updated task list
        $result = $conn->query("SELECT * FROM tasks");
        include 'tasks_table.php';
    }
}

$conn->close();
?>
