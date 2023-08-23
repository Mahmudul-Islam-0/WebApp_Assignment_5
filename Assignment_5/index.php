<?php
if (isset($_POST['Task'])) {
    $task = $_POST['Task'];
}
$link = mysqli_connect("localhost", "root", "", "tdl");

if ($link === false) {
    die("ERROR: Could not connect." . mysqli_connect_error());
}

$sql = "INSERT INTO `information`(`Activities`) VALUES ('$task')";

mysqli_query($link, $sql);
mysqli_close($link);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="header">
        <h1>To-Do-List</h1>
    </div>
    <div id="content">
        <div class="form_div">
            <form id="task_form" action="index.php" method="POST">
                <input id="task_input" name="Task" type="text" class="taskEntry" placeholder="Add a task">
                <input type="submit" value="submit" class="submit_btn">
            </form>
        </div>
        <div class="task_list">
            <ul id="tasks">

            </ul>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            async function fetchTasks() {
                const response = await fetch('retrieve.php');
                if (response.ok) {
                    const tasks = await response.json();
                    tasksList.innerHTML = '';
                    tasks.forEach(taskText => {
                        const li = document.createElement('li');
                        li.textContent = taskText;
                        tasksList.appendChild(li);
                    });
                }
            }

            fetchTasks();

            taskForm.addEventListener('submit', async (event) => {
                event.preventDefault();
                const taskText = taskInput.value;
                if (taskText.trim() === '') {
                    return;
                }

                const response = await fetch(taskForm.action, {
                    method: 'POST',
                    body: new URLSearchParams(new FormData(taskForm))
                });

                if (response.ok) {
                    taskInput.value = '';
                    fetchTasks();
                }
            });
        });
    </script>
</body>

</html>