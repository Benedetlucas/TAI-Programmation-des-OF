<?php

/**
 * Example class for handling database connection and requests.
 * The class has very few implemented methods since it is just meant to introduce an example
 * 
 * @author William Delamare
 * @created Dec. 2023
 */
class DBModel {

    // let's hide ou connection from others
    protected $db = null;
    protected $connected = false;


    /**
     * Constructor
     * takes care of connecting to the database
     */

     public function __construct() {
        $this->connected = $this->connect_to_db();
     }


    /**
     * Will try to connect to the pre-defined db
     * Private since the constructor will manage the connection
     *
     * @return: true if the connection was successful, false otherwise
     */
    private function connect_to_db() {   
        require __DIR__. "/env_settings.php";     
        try {
            $this->db = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $pwd, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            return true;
        }
        catch (Exception $e) {
            // return false;
            die("Connection to the database failed: " . $e->getMessage());
        }
    }


    // other useful methods to interact with the database
    // AND that are common to all models
    // should be implemented here


}

