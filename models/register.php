<?php
require_once('database_connection.php');

class register extends dbconnection
{

    public function __construct()
    { }

    public function checkEmailIfExists($email)
    {
        $search = "SELECT * FROM CdEgjh5AXU.admin_accounts WHERE email= ?";
        $pre = $this->connectDb()->prepare($search);
        $pre->execute([$email]);
        $rows = $pre->rowCount();
        if ($rows < 1) {
            return false;
        } else {
            return true;
        }
    }

    public function register_customer($email, $password)
    {
        session_start();
        $error = null;

        if (empty($email)) {
            $error = "Email address field is empty";
            $_SESSION['errors'] = $error;
            header('Location: ../views/admin_sign_up.php');
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email address";
            $_SESSION['errors'] = $error;
            header('Location: ../views/admin_sign_up.php');
            return;
        }

        if (strlen($password) <= '8') {
            $error = "Your Password Must Contain At Least 8 Characters!";
            $_SESSION['errors'] = $error;
            header('Location: ../views/admin_sign_up.php');
            return;
        } elseif (!preg_match("#[0-9]+#", $password)) {
            $error = "Your Password Must Contain At Least 1 Number!";
            $_SESSION['errors'] = $error;
            header('Location: ../views/admin_sign_up.php');
            return;
        } elseif (!preg_match("#[A-Z]+#", $password)) {
            $error = "Your Password Must Contain At Least 1 Capital Letter!";
            $_SESSION['errors'] = $error;
            header('Location: ../views/admin_sign_up.php');
            return;
        } elseif (!preg_match("#[a-z]+#", $password)) {
            $error = "Your Password Must Contain At Least 1 Capital Letter!";
            $_SESSION['errors'] = $error;
            header('Location: ../views/admin_sign_up.php');
            return;
        }

        // check if email address exists
        if ($this->checkEmailIfExists($email) == true) {
            $error = "Email address already used.Use another email address.";
            $_SESSION['errors'] = $error;
            header('Location: ../views/admin_sign_up.php');
            return;
        }

        $id = uniqid();
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $insertuser = "INSERT INTO  CdEgjh5AXU.admin_accounts(account_id, email, password)  VALUES ('$id','$email','$password_hash') ";
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
            header("Location: ../views/events.php");
        } catch (Exception $e) {
            echo 'Error Can not Acces the Index page' . $e->getMessage();
        }
    }
}
