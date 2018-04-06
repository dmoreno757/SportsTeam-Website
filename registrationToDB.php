<?
    include_once('createDB.php');
    if (isset($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['userName'], $_POST['password'])) {
    // Sanitize and validate the data passed in
    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_EMAIL);
    $email = filter_var(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
    }
    $userName = filter_var(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= '<p class="error">Invalid password configuration.</p>';
    }

    $sqlReg = "INSERT INTO userlogin(Name_First, Name_Last, Email, UserName, Password)
        values ('$firstName', '$lastName', '$email', '$userName', '$password')";
    $resultReg = $link-query($sqlReg);
    if ($resultReg == TRUE) {
        echo "New Record Recorded";
    } else {
        echo "error:" .$sqlReg."</br>".$link->error;
    }
     header("location: login.php");
?>