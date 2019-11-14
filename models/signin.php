<?php
require_once('database_connection.php');
class signin extends dbconnection
{

    public function __construct()
    { }

    public function authenticate($email, $password)
    {
        $search = "SELECT * FROM CdEgjh5AXU.admin_accounts WHERE email= ?";
        $pre = $this->connectDb()->prepare($search);
        $pre->execute([$email]);
        $rows = $pre->rowCount();
        //no user
        if ($rows < 1) {
            echo '<script> alert(\'User does not exist.\')</script>';
            echo '<script> window.open(\'../\',\'_self\')</script>';
        } else {

            //get the password
            if ($row = $pre->fetch(PDO::FETCH_ASSOC)) {
                $verifiedPass = password_verify($password, $row['password']);
                //password do not match
                if (!$verifiedPass) {
                    echo '<script> alert(\'Incorrect password.\')</script>';
                    echo '<script> window.open(\'../\',\'_self\')</script>';
                } else {
                    try {
                        //get user into the system
                        session_start();
                        $_SESSION['email'] = $row['email'];
                        header("Location: ../views/events.php");
                    } catch (Exception $e) {
                        echo 'Error Can not Acces the Index page' . $e->getMessage();
                    }
                }
            } else {
                echo '<script> alert(\'Cant Get The Password.\')</script>';
                echo '<script> window.open(\'../login.php\',\'_self\')</script>';
            }
        }
    }
}
