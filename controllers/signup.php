<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '\churchil_event_tickets\models\register.php');
class signup extends register
{
    private $name;
    private $email;
    private $password;

    public function __construct()
    { }

    public function setName($name)
    {
        $this->name = $name;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getName()
    {
        return $this->name;
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
    $name = $_POST['f_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $signup = new signup();
    $signup->setName($name);
    $signup->setEmail($email);
    $signup->setPassword($password);
    $signup->register_customer($signup->getName(), $signup->getEmail(), $signup->getPassword());
}
