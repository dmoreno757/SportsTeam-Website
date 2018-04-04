<!DOCTYPE html>
 <?php
            require('createDB.php');
            session_start();

            $userName="";
            $passWord="";

            $userName = mysqli_real_escape_string($link,$_POST['userName']);
            $passWord = mysqli_real_escape_string($link,$_POST['passWord']);

            $sql = "SELECT ID FROM userLogin where UserName = '$userName' AND Password = '$passWord'";
            $result = mysqli_query($link, $sql);
            $row = mysqli_fetch_array($result);

            $found = $row['found'];
            $counter = mysqli_num_rows($result);

             if($counter == 1) {
                $_SESSION['login_user'] = $myusername;
                 header("location: welcome.php");
                }else {
                    echo ("Your Login Name or Password is invalid");
                }
        ?>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="stylesheets/stylesheet.css">
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <body>
       
        <h1>CSUF Basketball Analytics</h1>
        <h4>Please Sign in to enter the website</h4>
        
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
            <h4>Create Account</h4>
            <a class="pure-button pure-button-primary" href="createAccount.php">Register</a>
    </body>
</head>
</html>