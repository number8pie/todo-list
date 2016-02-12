<?php

$mysqli = new mysqli("localhost", "lee", "lee1", "todo_list");

if (isset($_POST['todo_new'])) {
  $mysqli->query("INSERT INTO list_data (description) VALUES ('$_POST[todo_new]');");
}
elseif (isset($_POST['checkbox'])) {
  printf($_post[checkbox]);
  //$mysqli->query("DELETE FEOM list_data (description) VALUES ('$_POST[checkbox]');");
}

?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Foundation | Welcome</title>
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
          <form method="post" action="index.php">
              <label for="todo_new">Enter new todo list item:</label>
              <input type="text" name="todo_new" id="todo_new">
              <input type="submit" value="add to list">
          </form>
        </div>
        <div class="large-6 columns">
          <!--
          Tried using a foreach loop, turnsout I don't need one! See below.
          <table>
              <?php

              //$query = "SELECT * FROM list_data;";
              //$list = $mysqli->query($query);

              //while ($row = $list->fetch_array(MYSQLI_ASSOC)):
                  //echo "<tr>";

                  //foreach($row as $list_item) {
                      //echo "<td>" . $list_item . "</td>";
                  //}

                  //foreach ($row as $id => $description) {
                    //echo "<td>" . $id . $description . "</td>";
                  //}

                  //echo "</tr>";

              //endwhile;

              ?>
          </table>
          -->
          <table>
            <form method="post" action="index.php">
              <?php

              $query = "SELECT * FROM list_data;";
              $list = $mysqli->query($query);

              while ($row = $list->fetch_array(MYSQLI_ASSOC)):
              echo "<tr>";

              echo "<td><input type='checkbox' value='" . $row['id'] . "'></td><td>" . $row['description'] . "</td>";

              echo "</tr>";

              endwhile;

              ?>
              <input type="submit" value="remove checked items"></input>
            </form>
          </table>
        </div>
    </div>

    <hr>
    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/vendor/what-input.min.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
