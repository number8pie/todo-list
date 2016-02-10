<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    if ($name == "" OR $email == "" OR $message == "") {
        $error_message = "Please fill out the name, email and message fields.";
    }

    if (!isset($error_message)) {
        foreach ($_POST as $value) {
            if (stripos($value,'Content-Type:') !== FALSE) {
                $error_message = "There was a problem with the information you entered.";
            }
        }
    }

    if (!isset($error_message) && $_POST["address"] != "") {
        $error_message = "Your form submission has an error.";
    }

    require_once("/class.phpmailer.php");
    $mail = new PHPMailer();

    if (!isset($error_message) && !$mail->ValidateAddress($email)) {
        $error_message = "You must enter a valid email address.";
    }


    if (!isset($error_message)){
        $email_body = "";
        $email_body = $email_body . "Name: " . $name . "<br />";
        $email_body = $email_body . "Email: " . $email . "<br />";
        $email_body = $email_body . "Message: " . $message;

        $mail->SetFrom($email,$name);
        $address = "leethomas@corwenforestry.co.uk";
        $mail->AddAddress($address, "CF Racing");
        $mail->Subject    = "CF Racing - Landing Page Contact Form | " . $name;
        $mail->MsgHTML($email_body);

        if($mail->Send()) {
            header("Location: index.php?status=thanks");
            exit;            
        } else {
            $error_message = "There was a problem sending the email: " . $mail->ErrorInfo;
        }
    }
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

        <?php if (isset($_GET["status"]) AND $_GET["status"] == "thanks") { ?>
            <p>Thanks for getting in touch!</p>
        <?php } else { ?>

            <div id="contactform">
                <?php
                    if (isset($error_message)) {
                        echo '<p class="error-message">' . $error_message . '</p>';
                    }
                ?>
                <form method="post" action="index.php">
                    <table id="contact-table">
                        <tr>
                            <th><label for="name">Name:</label></th>
                            <td>
                                <input type="text" name="name" id="name" value="<?php if (isset($name)) { echo htmlspecialchars($name); }?>">
                            </td>
                        </tr>
                        <tr>
                            <th><label for="email">Email:</label></th>
                            <td>
                                <input type="text" name="email" id="email" value="<?php if (isset($email)) { echo htmlspecialchars($email); }?>">
                            </td>
                        </tr>
                        <tr id="honey">
                            <th><label for="address">Address:</label></th>
                            <td>
                                <input type="text" name="address" id="address">
                                <p>Please leave the address field blank.</p>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="message">Message:</label></th>
                            <td>
                                <textarea name="message" id="message"><?php if (isset($message)) { echo htmlspecialchars($message); }?>
                                </textarea>
                            </td>
                        </tr>
                    </table>
                    <input type="submit" value="Send">
                </form>
            </div>

        <?php } ?>

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
