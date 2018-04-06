<?
    session_start();
    require_once('createDB.php');
 
    $firstName = trim($_POST['firstName']);
    $firstName = strip_tags($_POST['firstName']);
    $firstName = htmlspecialchars($_POST['firstName']);

    $lastName = trim($_POST['lastName']);
    $lastName = strip_tags($_POST['lastName']);
    $lastName = htmlspecialchars($_POST['lastName']);

    $email = trim($_POST['email']);
    $email = strip_tags($_POST['email']);
    $email = htmlspecialchars($_POST['email']);

    $userName = trim($_POST['userName']);
    $userName = strip_tags($_POST['userName']);
    $userName = htmlspecialchars($_POST['userName']);

    $password = trim($_POST['password']);
    $password = strip_tags($_POST['password']);
    $password = htmlspecialchars($_POST['password']); 

    $sqlReg = "INSERT INTO userlogin(Name_First, Name_Last, Email, UserName, Password)
        VALUES ('$firstName', '$lastName', '$email', '$userName', '$password')";
    $resultReg = mysql_query($sqlReg) or die(mysql_error());
    if ($resultReg) {
        echo "New Record Recorded";
    }
    echo $firstName;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="stylesheets/stylesheet.css">
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <body>
    <form class="pure-form pure-form-stacked" method="post" action="newRegistration.php">
    <fieldset>
        <h1>Registration Form</h1>
        <div class="pure-g">
            <div class="pure-u-1 pure-u-md-1-3">
                <label for="firstName">First Name</label>
                <input id="firstName" class="pure-u-23-24" type="text" name="firstName">
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="lastName">Last Name</label>
                <input id="lastName" class="pure-u-23-24" type="text" name="lastName">
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="email">E-Mail</label>
                <input id="email" class="pure-u-23-24" type="email" required name="email">
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="userName">User Name</label>
                <input id="userName" class="pure-u-23-24" type="text" required name="userName">
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="password">Password</label>
                <input id="password" class="pure-u-23-24" type="text" required name="password">
            </div>
        </div>

        <label for="terms" class="pure-checkbox">
            <input id="terms" type="checkbox"> I've read the terms and conditions
        </label>
        <button class="pure-button pure-button-primary" type="submit" name="submit" value="submit">Register</button>
    </fieldset>
</form>
    </body>
    </head>
</html>

