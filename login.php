<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="stylesheets/stylesheet.css">
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <body>
        <?php
            require('loginData.php');
        ?>
        <h1>CSUF Basketball Analytics</h1>
        <h4>Please Sign in to enter the website</h4>
        <br>
        <?php
            if ((!isset($_POST['name'])) || (!isset($_POST['password']))) {

        ?>
        

        <form class="pure-form pure-form-stacked" method="post">
            <fieldset>
                <div class="pure-control-group">
                    <p><label for="userName">Username:</label>
                <input type="text" name="userName" value="" id="userName" maxlength="100" placeholder="User Name">
                        <span class="pure-form-message">This is a required field.</span>
                </div>
                <br>
                Password:
                <input type="text" name="passWord" value="" maxlength="100" placeholder="Password">
                <br>
                <button class="pure-button pure-button-primary" type="submit">Sign In</button>
                <button class="pure-button pure-button-primary">I forgot password</button>
            </fieldset>
        </form>
                <?php
                if ($_POST['userName'] == 'user' && $_POST['passWord'] == 'pass' ) {
                    echo '<p>You in!!!</p>';

                }
                else {
                         echo '<p>One of the fields are missing</p>';
                }
            }        
           ?> 
        
        
    </body>
</head>
</html>