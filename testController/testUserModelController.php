<?php
    /**
     * Example of a simple test controller
     * to test the model ONLY!!
     * #########################################################
     * #### Real controllers are at the root of the project ####
     * #########################################################
     * 
     * @author: p.reuter
     * @date: Dec. 2023
     */

    
    // do all necessary includes first
    // __DIR__ allows you to use relative paths explicitly
    // for this test controller (i.e. a controller that is not calling the view, just to test the model)
    require_once(__DIR__."/../model/UserModel.php");

    $userModel = new UserModel();

    // p.ex. Homer, Simpson, donut, 123

    // test function check_login(string $login, string $password);
    // test for existing login password
    $login = "donut";
    $password = "123";
    
    $result = $userModel->check_login($login, $password);
    print_r($result);

    // test function check_login(string $login, string $password);
    // test for existing login and wrong password
    $login = "donut";
    $password = "1ded23";
    
    $result = $userModel->check_login($login, $password);
    print_r($result);

    // test function check_login(string $login, string $password);
    // test for non-existing login
    $login = "donutt";
    $password = "1ded23";
    
    $result = $userModel->check_login($login, $password);
    print_r($result);
