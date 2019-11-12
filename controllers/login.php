<?php
require_once('../models/signin.php');
class login extends signin
{
   private $email;
   private $password;

   public function __construct()
   { }

   public function setEmail($email)
   {
      $this->email = $email;
   }
   public function setPassword($password)
   {
      $this->password = $password;
   }

   public function getEmail()
   {
      return $this->email;
   }

   public function getPassword()
   {
      return $this->password;
   }
}
if (isset($_POST['login'])) {
   $email = $_POST['email'];
   $password = $_POST['password'];
   $login = new login();
   $login->setEmail($email);
   $login->setPassword($password);
   $login->authenticate($login->getEmail(), $login->getPassword());
}
