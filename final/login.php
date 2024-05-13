<html>
    <head>
        <title>My Application</title>
    </head>
    <body>
        <h1>My Application</h1>
        <table>
            <thead>
                <tr>
                    <th>Jabril</th>
                    <th>Login</th>
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