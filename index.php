<?php
// connecting to the database
  $db = mysqli_connect('localhost', 'root', 'root', 'todolist', '8889');

// inserting data into the database
    if (isset($_POST['submit'])) {

        $task = $_POST['task'];

        if (empty($task)) {

          $errors = "You must enter a task!";

        } else {

          mysqli_query($db, "INSERT INTO tasks (task) VALUES ('$task')");
          header('location: index.php');

        }

    }
    
    if (isset($_GET['delete_task'])) {

      $id = $_GET['delete_task'];
      mysqli_query($db, "DELETE FROM tasks WHERE id = $id");
      header('location: index.php');

    }

    $tasks = mysqli_query($db, "SELECT * FROM tasks");

?>


<!DOCTYPE html>
<html lang="en">

  <head>
  
    <meta charset="UTF-8">
    <meta name="viewport" width=device-width initial-scale=1.0>
    <link rel="stylesheet" type="text/css" href="main.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">


    <title>To Do List</title>
 
  </head>

  <body>

    <div class="container">
      <div class="calendario">
        <h1> <?php echo date('l, F jS, Y'); ?> </h1>
      </div>

      <ul>
      <?php while ($row = mysqli_fetch_array($tasks)) { ?>

        <input type="checkbox" name="check">
        <label class="task" for="check"><?php echo $row['task']; ?> </label>

        <button class="delete-button">

          <a href= "index.php?delete_task=<?php echo $row['id']; ?>">
            <i class="far fa-trash-alt"></i>
          </a>
        </button>

        <br>

      <?php } ?>

      </ul>

        <form method="POST" action="index.php">

        <?php if (isset($errors)) { ?>
            <p class="form-p"><?php echo $errors; ?></p>
        <?php } ?>

          <input class="new-task-input" type="text" name="task" placeholder="New Task" autofocus>

          <button class="task-button" type="submit" name="submit">Ok</button>

        </form>

    </div>

  </body>

</html>