<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List</title>
    <link rel="stylesheet" href="styles.css?v=1">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Function to load and display tasks
            function loadTasks() {
                $.ajax({
                    type: "GET",
                    url: "get_tasks.php",
                    success: function (response) {
                        $("#taskList").html(response);
                    },
                    error: function (error) {
                        console.log("Error loading tasks:", error.responseText);
                    }
                });
            }

            // Initial load of tasks
            loadTasks();

            $("#taskForm").submit(function (e) {
                e.preventDefault();

                var taskName = $("#taskName").val();
                var taskDescription = $("#taskDescription").val();

                $.ajax({
                    type: "POST",
                    url: "add_task.php",
                    data: {
                        taskName: taskName,
                        taskDescription: taskDescription
                    },
                    success: function () {
                        // Reload tasks after adding a new one
                        loadTasks();
                        $(".edit-form").hide(); // Hide the edit form after adding
                    },
                    error: function (error) {
                        console.log("Error adding task:", error.responseText);
                    }
                });
            });

            $(document).on("click", ".edit-button", function () {
                var taskId = $(this).data("task-id");
                var taskName = $(this).data("task-name");
                var taskDescription = $(this).data("task-description");

                $("#editTaskId").val(taskId);
                $("#editTaskName").val(taskName);
                $("#editTaskDescription").val(taskDescription);

                $(".edit-form").show();
            });

            $("#cancelEdit").click(function () {
                $(".edit-form").hide();
            });

            $(document).on("click", ".delete-button", function () {
                var taskId = $(this).data("task-id");

                $.ajax({
                    type: "POST",
                    url: "delete_task.php",
                    data: {
                        taskId: taskId
                    },
                    success: function () {
                        // Reload tasks after deleting one
                        loadTasks();
                        $(".edit-form").hide(); // Hide the edit form after deleting
                    },
                    error: function (error) {
                        console.log("Error deleting task:", error.responseText);
                    }
                });
            });

            $("#editTaskForm").submit(function (e) {
                e.preventDefault();

                var taskId = $("#editTaskId").val();
                var taskName = $("#editTaskName").val();
                var taskDescription = $("#editTaskDescription").val();

                $.ajax({
                    type: "POST",
                    url: "edit_task.php",
                    data: {
                        taskId: taskId,
                        taskName: taskName,
                        taskDescription: taskDescription
                    },
                    success: function () {
                        // Reload tasks after editing
                        loadTasks();
                        $(".edit-form").hide(); // Hide the edit form after editing
                    },
                    error: function (error) {
                        console.log("Error updating task:", error.responseText);
                    }
                });
            });
        });
    </script>
</head>
<body>

<h2>Add a Task</h2>

<form id="taskForm">
    <label for="taskName">Task Name:</label>
    <input type="text" id="taskName" name="taskName" required>

    <label for="taskDescription">Task Description:</label>
    <textarea id="taskDescription" name="taskDescription" rows="4" required></textarea>

    <input type="submit" value="Add Task">
</form>

<h2>Task List</h2>

<div id="taskList">
    <!-- Task list will be displayed here -->
</div>

<div class="edit-form" style="display: none;">
    <h2>Edit Task</h2>
    <form id="editTaskForm">
        <input type="hidden" id="editTaskId" name="editTaskId">
        <label for="editTaskName">Task Name:</label>
        <input type="text" id="editTaskName" name="editTaskName" required>

        <label for="editTaskDescription">Task Description:</label>
        <textarea id="editTaskDescription" name="editTaskDescription" rows="4" required></textarea>

        <button type="submit">Update Task</button>
        <button type="button" id="cancelEdit">Cancel</button>
    </form>
</div>

</body>
</html>
