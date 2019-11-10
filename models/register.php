<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '\churchil_event_tickets\models\database_connection.php');

class register extends dbconnection
{

    public function __construct()
    { }

       public function checkEmailIfExists($email)
    {
        $search = "SELECT * FROM churchill_event_tickets.customer_accounts WHERE email= ?";
        $pre = $this->connectDb()->prepare($search);
        $pre->execute([$email]);
        $rows = $pre->rowCount();
        if ($rows < 1) {
            return false;
        } else {
            return true;
        }
    }

    public function register_customer($name, $email, $password)
    {
        if (empty($email)) {
            echo '<script> alert(\'Email address field is empty.\')</script>';
            echo '<script> window.open(\'../index.php\',\'_self\')</script>';
            return;
        }
        if (empty($name)) {
            echo '<script> alert(\'Full name field is empty.\')</script>';
            echo '<script> window.open(\'../index.php\',\'_self\')</script>';
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<script> alert(\'Invalid email address.\')</script>';
            echo '<script> window.open(\'../index.php\',\'_self\')</script>';
            return;
        }

        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            echo '<script> alert(\'Invalid user name.\')</script>';
            echo '<script> window.open(\'../index.php\',\'_self\')</script>';
            return;
        }

        if (strlen($password) <= '8') {
            echo '<script> alert(\'Your Password Must Contain At Least 8 Characters!\')</script>';
            echo '<script> window.open(\'../index.php\',\'_self\')</script>';
            return;
        } elseif (!preg_match("#[0-9]+#", $password)) {
            echo '<script> alert(\'Your Password Must Contain At Least 1 Number!\')</script>';
            echo '<script> window.open(\'../index.php\',\'_self\')</script>';
            return;
        } elseif (!preg_match("#[A-Z]+#", $password)) {
            echo '<script> alert(\'Your Password Must Contain At Least 1 Capital Letter!\')</script>';
            echo '<script> window.open(\'../index.php\',\'_self\')</script>';
            return;
        } elseif (!preg_match("#[a-z]+#", $password)) {
            echo '<script> alert(\'Your Password Must Contain At Least 1 Lowercase Letter!\')</script>';
            echo '<script> window.open(\'../index.php\',\'_self\')</script>';
            return;
        }

        // check if email address exists
        if ($this->checkEmailIfExists($email) == true) {
            echo '<script> alert(\'Email address already used.Use another email address.\')</script>';
            echo '<script> window.open(\'../index.php\',\'_self\')</script>';
            return;
        }

        $id = uniqid();
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $insertuser = "INSERT INTO  churchill_event_tickets.customer_accounts(account_id, name, email, password)  VALUES ('$id','$name','$email','$password_hash') ";
        try {
            $this->connectDb()->exec($insertuser);
        } catch (Exception $e) {
            echo "ERROR: " . $e->getMessage();
        }

        try {
            //get user into the system
            session_start();
            $_SESSION['email'] = $email;
            echo '<script> alert(\'Account created successfully.\')</script>';
            echo '<script> window.open(\'../index.php\',\'_self\')</script>';
            header("Location: http://127.0.0.1/churchil_event_tickets/views/admin_dash.php");
        } catch (Exception $e) {
            echo 'Error Can not Acces the Index page' . $e->getMessage();
        }
    }
}
