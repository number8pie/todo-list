<?php

$mysqli = new mysqli("localhost", "lee", "lee1", "todo_list");

if ($mysqli->query("INSERT INTO list_data (description) VALUES ('$_POST[todo_new]');") === TRUE) {
	echo "Entry successful!";
	echo "<br /><a href='index.php'>Go back to list page.</a>";
}

?>