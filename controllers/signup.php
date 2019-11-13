<?php
require_once('../models/register.php');
class signup extends register
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
if (isset($_POST['signup'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $signup = new signup();
    $signup->setEmail($email);
    $signup->setPassword($password);
    $signup->register_customer($signup->getEmail(), $signup->getPassword());
}
