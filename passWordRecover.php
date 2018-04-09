<?php
//Load Composer's autoloader
 require("createDB.php");

  if (isset($_REQUEST['submit'])) {
            $email = trim($_REQUEST['email']);
            $email = strip_tags($_REQUEST['email']);
            $email = htmlspecialchars($_REQUEST['email']);

            $sql = "SELECT ID, Password FROM userLogin where Email = '$email'";
            $result = mysqli_query($link, $sql);
            $row = mysqli_fetch_array($result);
            $password = $row[1];
            $found = isset($row['found']);
            $counter = mysqli_num_rows($result);

    if ($counter == 1) {
        require 'PHPMailer\PHPMailerAutoload.php';

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
        );

    $mail->isSMTP();     
    $mail->Host='smtp.gmail.com';
    $mail->Username='431basketball@gmail.com'; //Add new email
    $mail->Password='431Rocks!'; //add new password
    $mail->SMTPSecure='tls';
    $mail->SMTPAuth = true;

    $mail->Port=587;
    $mail->setFrom('431Basketball@gmail.com', 'Admin');
    $mail->addAddress($email, 'user');

    $mail->WordWrap = 50;                                 // set word wrap to 50 characters
    $mail->IsHTML(true); 

    $mail->Subject = 'Password Recovery';
    $mail->Body    = 'Your password is <b>'.$password.'</b>';

    if($mail->Send())
    {
        echo "Message has been sent";
        require("login.php");
    } else {
        echo "Email error";
        require("login.php");
    }     
  } else {
        echo "Email not Found";
        require("login.php");
  }
}
?>