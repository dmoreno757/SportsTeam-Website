 <?php
  class loginData {
    private $firstName = "";
    private $lastName = "";
    private $email = "";
    private $userName = "";
    private $password = "";
  }

  function userName() {
    if ( func_num_args() == 0)
      {
        return $this->userName;
      }
      else if (func_num_args() == 1)
      {
        $value = func_get_arg(0);
        $this->userName = htmlspecialchars(trim((string)func_get_arg(0)));
      }
      return $this;
  }

?>