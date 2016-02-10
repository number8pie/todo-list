<?php

$mysqli = new mysqli("localhost", "lee", "lee1", "todo_list");

if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    $mysqli->query("INSERT INTO list_data (description) VALUES ('$_POST[todo_new]');");
}

?>

<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div>
            <form method="post" action="index.php">
                <label for="todo_new">Enter new todo list item:</label>
                <input type="text" name="todo_new" id="todo_new">
                <input type="submit" value="add to list">
            </form>
        </div>

        <table>
            <?php

            $query = "SELECT * FROM list_data;";
            $list = $mysqli->query($query);

            while ($row = $list->fetch_array(MYSQLI_ASSOC)):
                echo "<tr>";
                foreach($row as $list_item) {
                    echo "<td>" . $list_item . "</td>";
                }
                echo "</tr>";
            endwhile;

            ?>
        </table>

        <?php 
            //$data = $db->query("SELECT * FROM list_data");

            //echo "<pre>";
            //$screenData = $data->fetchAll(PDO::FETCH_ASSOC);
            //var_dump($screenData);
            //echo "</pre>";
        ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
</html>
