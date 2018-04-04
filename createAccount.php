<?php
    require_once('createDB.php');
    $firstName =  preg_replace("/\t|\R/",' ',$_POST['firstName']);
    $lastName  =  preg_replace("/\t|\R/",' ',$_POST['lastName']);
    $email     =  preg_replace("/\t|\R/",' ',$_POST['email']);
    $userName  =  preg_replace("/\t|\R/",' ',$_POST['userName']);
    $password  =  preg_replace("/\t|\R/",' ',$_POST['password']);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="stylesheets/stylesheet.css">
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <body>
    <form class="pure-form pure-form-stacked">
    <fieldset>
        <h1>Registration Form</h1>

        <div class="pure-g">
            <div class="pure-u-1 pure-u-md-1-3">
                <label for="firstName">First Name</label>
                <input id="firstName" class="pure-u-23-24" type="text">
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="lastName">Last Name</label>
                <input id="lastName" class="pure-u-23-24" type="text">
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="email">E-Mail</label>
                <input id="email" class="pure-u-23-24" type="email" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="userNAme">User Name</label>
                <input id="userName" class="pure-u-23-24" type="text" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="password">Password</label>
                <input id="password" class="pure-u-23-24" type="text">
            </div>
        </div>

        <label for="terms" class="pure-checkbox">
            <input id="terms" type="checkbox"> I've read the terms and conditions
        </label>
        <a class="pure-button pure-button-primary" href="login.php">Create Account</a>


    </fieldset>
</form>

    </body>
    </head>
</html>

