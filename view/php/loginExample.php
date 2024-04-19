<!-- 
    Example HTML file to showcase a simple login form which uses
        - a php controller script (logic-related aspects) that calls a php model script (data-related aspects)
        - a php view script (UI-related aspects)

* @author: w.delamare
* @date: Dec. 2023
 -->

<?php
    // do all necessary includes first
    // __DIR__ allows you to use relative paths explicitly
    // here, the file is in the same folder as the includes.php file (view/)
    include_once __DIR__ . '/includes.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="view/css/example.css">
        <title>Login Example</title>
    </head>
    <body>
        
        <!-- PHP only used to display stuff -->
        <?php include_header(); ?>

        <?php 
            // if an error happened
            if (isset($something_to_say)) {
                include_error_message($something_to_say);
            }
        ?>

        <form method="post" action="loginController.php">
            <fieldset>
                <legend>Login</legend>
                <input type="text" placeholder="login" id="login" name="login">
                <input type="password" placeholder='password' id='pwd' name="pwd">
                <button type="submit">Submit</button>
            </fieldset>
        </form>

        <?php include_footer(); ?>

    </body>
</html>