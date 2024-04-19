<?php
    /**
     * Example of a simple controller
     * It will call the model to get the data
     * and then decide which view to display (login form or welcome page)
     * 
     * @author: w.delamare
     * @date: Dec. 2023
     */

    
    // do all necessary includes first
    // __DIR__ allows you to use relative paths explicitly
    require_once(__DIR__."/model/php/UserModel.php");



    // Check if the user comes from the form...
    if (isset($_POST['login']) && isset($_POST['pwd'])) {

        // check if all fields have an input
        if (strlen($_POST['login']) > 0 && strlen($_POST['pwd']) > 0) {
            $userModel = new UserModel();
            // Call the model to check if the user exists
            // How is the information stored? In a database? In a file? In a cloud? In a cookie?
            // The controller does not care about that. It just calls the model.
            $result = $userModel->check_login($_POST['login'], $_POST['pwd']);
            // If the search (in the db here) is successful
            if (isset($result['firstname'])) {
                // the controller can now redirect to the correct welcome webpage
                // making sure the firstname and lastname are registered throughout the **session**
                session_start();
                $_SESSION['firstname'] = $result['firstname'];
                $_SESSION['lastname'] = $result['lastname'];
                $_SESSION['id'] = $result['id'];
            }
            else {
                // set the error message to be displayed in the view
                $something_to_say = "Invalid login and/or password.";  
            }
        }
        else {
            // set the error message to be displayed in the view
            $something_to_say = "Missing login and/or password";
        }
    }

    // If the user wants to logout, simply destroy the session
    // (and hence redirect to the login form)
    if (isset($_POST['logout'])) {
        session_start();
        session_destroy();
    }


    // Now, let's call the view.
    // If something to say, the view will display it
    // Otherwise, the view will simply display the login form
    // the form if not logged in, the welcome page if logged in
    if (isset($_SESSION['firstname'])) {
        require_once(__DIR__."/view/php/welcomePage.php");
    }
    else {
        require_once(__DIR__."/view/php/loginExample.php");
    }

