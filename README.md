# Example of a login page

This example demonstrates how to create a login page with PHP and MySQL.
The project includes examples of an MVC architecture (Model-View-Controller).
By following the MVC architecture, the project is divided into three main folders:
* `controller`: contains the controllers of the project (flow of the application)
* `model`: contains the models of the project (data of the application)
* `view`: contains the views of the project (display of the application)

## Installation

### Virtual Host

* Open WAMP server
* Visit `localhost` in your browser (or right-click on the WAMP icon and click on `localhost`)
* Click on `Add a Virtual Host`
* Set the `Project Root` to the project folder
* Set the `Virtual Host Name` to `tai`
* Click on `Start the creation of the Virtual Host`
* Right-click on the WAMP icon, select `Tools` and click on `Restart DNS`

<figure style="text-align:center">
    <img src="figs/dns.png?raw=true" width="600">
    <figcaption>Figure 1: 'Restart DNS' location</figcaption>
</figure>


### Project

* Download the project
* Extract the project in the `www` folder of WAMP (or the folder you set as `Project Root` in the Virtual Host creation)

### Database:

* Open PhpMyAdmin
* Create a database named `tai`
* Import the file `user.sql` from the project/sql folder


You can now visit the project at `tai` (or the name you set as `Virtual Host Name` in the Virtual Host creation)
Try to log in with the following credentials:

|First Name|Last name|Login|Password|
|:----------:|:---------:|:-----:|:--------:|
|Homer|Simpson|donut|123|
|Marge|Simpson|marge|revelation|
|Bart|Simpson|el barto|EatMyShorts|
|Lisa|Simpson|lisa_simpson|Th*s_is_a_diffiCULT_pw8|


## To Note

1. For the **model**, the project provides an example of class and subclass to interact with the database. This will prevent you from re-writing the same code over and over again. You can find the classes in the `model` folder.
1. For the **view**, the project provides an example of an include file to prevent you from re-writing the same code over and over again. You can find the include file in the `view` folder.
1. The code is **commented** to help you understand how it works. 

> Your project should follow the same architecture, as well as the same coding style (indentation, comments, etc.).


# MVC Architecture

## Components

### Model
The model is the data of the application. It is the part of the application that is responsible for managing the data. It receives user input from the controller.

### View
The view is the display of the application. It is the part of the application that is responsible for displaying the data to the user. It receives data from the controller.

### Controller
The controller is the flow of the application. It is the part of the application that is responsible for managing the flow of the application. It receives user input from the view and interacts with the model to retrieve the data. It then sends the data to the view to be displayed to the user.

## Flow


<figure style="text-align:center">
    <img src="figs/MVC.png?raw=true" width="600">
    <figcaption>Figure 2: MVC Architecture</figcaption>
</figure>


1. The user interacts with the view (e.g. clicks on a button)
1. The view sends the user input to the controller
1. The controller interacts with the model to retrieve the data
1. The model sends the data back to the controller
1. The controller processes the data (i.e., everything is ok? Should we provide an error message? etc.)
1. The controller sends the data to the view
1. The view displays the data to the user


## Rules

There are several ways to implement the MVC architecture. However, based on our simple example, here are some rules that should be followed:

* **The view and the model should never interact directly.**
* **The controller should never interact directly with the database (or the files, etc.).**
* **The model should never interact directly with the view.**
* **The view should include as little logic (PHP) as possible (loops and echoes).**


## Example

Here is a very basic example (not related to the project) of how the MVC architecture could be implemented:
Let's consider a simple application that displays a list of users, with the following information: first name, last name, and email address.


### Controller (the_controller.php)
This is the endpoint of the application (e.g., https://devweb.estia.fr/project/the_controller.php). It is the only file that is accessible by the user. It is the file that will interact with the model and the view.

```php
<?php
    // Include the model (the data) from the model folder
    include_once('scripts/php/models/the_model.php');
    
    // Get the list of users
    // after that line, the variable $users will contain the list of users
    $users = get_users();
    
    // Include the view (the display) from the view folder
    include_once('scripts/php/views/the_view.php');
?>
```

### View (the_view.php)
This is the display of the application. It is the file that will display the data to the user. It should include as little logic (PHP) as possible.

```php
<html>
    <head>
        <title>My Application</title>
    </head>
    <body>
        <h1>My Application</h1>
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // $users is the list of users and is already defined in the controller!!
                    // The view can now just display the data
                    // Loop through the list of users
                    foreach($users as $user) {
                        echo '<tr>';
                        echo '<td>'.$user['first_name'].'</td>';
                        echo '<td>'.$user['last_name'].'</td>';
                        echo '<td>'.$user['email_address'].'</td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
    </body>
```


## Model (the_model.php)
This is the data of the application. It is the file that will interact with the database (or the files, etc.). It should never interact directly with the view.

```php
<?php
    // Function that returns the list of users
    function get_users() {
        // Connect to the database
        $db = ...;
        
        $query = $db->prepare('SELECT * FROM users');
        $query->execute();
        $users = $query->fetchAll();

        // Return the results
        return $users;
    }
?>
```

