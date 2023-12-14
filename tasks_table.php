<?php
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Task Name</th><th>Task Description</th><th>Created At</th><th>Updated At</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['task_name']}</td>";
        echo "<td>{$row['task_description']}</td>";
        echo "<td>{$row['created_at']}</td>";
        echo "<td>{$row['updated_at']}</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No tasks found.";
}
?>
