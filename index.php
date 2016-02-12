<?php

$mysqli = new mysqli("localhost", "lee", "lee1", "todo_list");

if (isset($_POST['todo_new'])) {
  $mysqli->query("INSERT INTO list_data (description) VALUES ('$_POST[todo_new]');");
}
elseif (isset($_POST['checkbox'])) {
  foreach ($_POST['checkbox'] as $check) {
    $mysqli->query("DELETE FROM list_data WHERE id = '$check';");
  }
}

?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>number8pie's todo list</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/app.css" />
  </head>
  <body>
    <div class="row">
        <div class="large-12 colums">
            <h1>To-Do List</h1>
        </div>
    </div>

    <div class="row">
        <div class="large-6 columns">
        <div class="add">
            <form method="post" action="index.php">
                <label for="todo_new">Write a new item on the todo list:</label>
                <input type="text" name="todo_new" id="todo_new">
                <input type="submit" value="add to list">
            </form>
          </div>
        </div>

        <div class="large-6 columns">
          <div class="list">
            <form method="post" action="index.php">
              <table>
                <?php

                $query = "SELECT * FROM list_data;";
                $list = $mysqli->query($query);

                while ($row = $list->fetch_array(MYSQLI_ASSOC)):
                echo "<tr>";

                echo "<td><input type='checkbox' name='checkbox[]' value='" . $row['id'] . "'></td><td class='description'>" . $row['description'] . "</td>";

                echo "</tr>";

                endwhile;

                ?>
              </table>
              <input type="submit" value="remove checked items"></input>
            </form>
          </div>
        </div>
    </div>

    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/vendor/what-input.min.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
