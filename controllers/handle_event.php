<?php
session_start();
require_once('../models/manage_events.php');
class handleEvent extends manageEvents
{
    private $name;
    private $location;
    private $date;
    private $description;
    private $vip_quantity;
    private $regular_quantity;
    private $vip_price;
    private $regular_price;

    public function __construct()
    { }

    public function setName($name)
    {
        $this->name = $name;
    }
    public function setLocation($location)
    {
        $this->location = $location;
    }
    public function setDate($date)
    {
        $this->date = $date;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function setVip_quantity($vip_quantity)
    {
        $this->vip_quantity = $vip_quantity;
    }
    public function setRegular_quantity($regular_quantity)
    {
        $this->regular_quantity = $regular_quantity;
    }
    public function setVip_price($vip_price)
    {
        $this->vip_price = $vip_price;
    }
    public function setRegular_price($regular_price)
    {
        $this->regular_price = $regular_price;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getLocation()
    {
        return $this->location;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getVip_quantity()
    {
        return $this->vip_quantity;
    }
    public function getRegular_quantity()
    {
        return $this->regular_quantity;
    }
    public function getVip_price()
    {
        return $this->vip_price;
    }
    public function getRegular_price()
    {
        return $this->regular_price;
    }
}

//create event
if (isset($_POST['add_event'])) {
    $name = $_POST['name'];
    $location = filter_var($_POST['location'], FILTER_SANITIZE_STRING);
    $date = $_POST['date'];
    // $description = $_POST['event_description'];
    $description = filter_var($_POST['event_description'], FILTER_SANITIZE_STRING);
    $vip_quantity = $_POST['vip_quantity'];
    $regular_quantity = $_POST['regular_quantity'];
    $vip_price = $_POST['vip_price'];
    $regular_price = $_POST['regular_price'];
    $bunner = $_FILES['file'];
    $bunnerName = $_FILES['file']['name'];
    $bunnerTmpName = $_FILES['file']['tmp_name'];
    $bunnerSize = $_FILES['file']['size'];
    $bunnerError = $_FILES['file']['error'];

    $newEvent = new handleEvent();
    $newEvent->setName($name);
    $newEvent->setLocation($location);
    $newEvent->setDate($date);
    $newEvent->setDescription($description);
    $newEvent->setVip_price($vip_price);
    $newEvent->setVip_quantity($vip_quantity);
    $newEvent->setRegular_price($regular_price);
    $newEvent->setRegular_quantity($regular_quantity);

    //setCookies
    setcookie("Name", $newEvent->getName(), time() + (60), "/");
    setcookie("Location", $newEvent->getLocation(), time() + (60), "/");
    setcookie("Date", $newEvent->getDate(), time() + (60), "/");
    setcookie("Description", $newEvent->getDescription(), time() + (60), "/");
    setcookie("Vip_price", $newEvent->getVip_price(), time() + (60), "/");
    setcookie("Vip_quantity", $newEvent->getVip_quantity(), time() + (60), "/");
    setcookie("Regular_price", $newEvent->getRegular_price(), time() + (60), "/");
    setcookie("Regular_quantity", $newEvent->getRegular_quantity(), time() + (60), "/");


    $bunnerExt = explode('.', $bunnerName);
    $formatedExt = strtolower(end($bunnerExt));

    $allowed = array('jpg', 'png', 'jpeg');
    $fileName = null;

    if (empty($bunnerName)) {
        $newEvent->submitEvent(
            $newEvent->getName(),
            $newEvent->getLocation(),
            $newEvent->getDate(),
            $newEvent->getDescription(),
            $newEvent->getVip_quantity(),
            $newEvent->getRegular_quantity(),
            $newEvent->getVip_price(),
            $newEvent->getRegular_price(),
            $fileName
        );
    } else {

        if (in_array($formatedExt, $allowed)) {
            if ($bunnerError === 0) {
                $fileName = uniqid('', true) . "." . $formatedExt;
                $destination = '../images/' . $fileName;
                move_uploaded_file($bunnerTmpName, $destination);

                $newEvent->submitEvent(

                    $newEvent->getName(),
                    $newEvent->getLocation(),
                    $newEvent->getDate(),
                    $newEvent->getDescription(),
                    $newEvent->getVip_quantity(),
                    $newEvent->getRegular_quantity(),
                    $newEvent->getVip_price(),
                    $newEvent->getRegular_price(),
                    $fileName
                );
            } else {
                $error = "Error occured during file upload";
                $_SESSION['errors'] = $error;
                header('Location: ../views/addEvent.php');
                return;
            }
        } else {

            $error = "The type of file Uploaded is not allowed, only images are allowed";
            $_SESSION['errors'] = $error;
            // header('Location: ../views/addEvent.php');
            return;
        }
    }
}



// update event
if (isset($_POST['edit_event'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    // $description = $_POST['event_description'];
    $description = filter_var($_POST['event_description'], FILTER_SANITIZE_STRING);
    $vip_quantity = $_POST['vip_quantity'];
    $regular_quantity = $_POST['regular_quantity'];
    $vip_price = $_POST['vip_price'];
    $regular_price = $_POST['regular_price'];
    $id = $_POST['id'];

    $bunner = $_FILES['file'];
    $bunnerName = $_FILES['file']['name'];
    $bunnerTmpName = $_FILES['file']['tmp_name'];
    $bunnerSize = $_FILES['file']['size'];
    $bunnerError = $_FILES['file']['error'];

    $newEvent = new handleEvent();
    $newEvent->setName($name);
    $newEvent->setLocation($location);
    $newEvent->setDate($date);
    $newEvent->setDescription($description);
    $newEvent->setVip_price($vip_price);
    $newEvent->setVip_quantity($vip_quantity);
    $newEvent->setRegular_price($regular_price);
    $newEvent->setRegular_quantity($regular_quantity);

    $bunnerExt = explode('.', $bunnerName);
    $formatedExt = strtolower(end($bunnerExt));

    $allowed = array('jpg', 'png', 'jpeg');
    $fileName = null;

    if (empty($bunnerName)) {
        $newEvent->updateEvents(
            $id,
            $newEvent->getName(),
            $newEvent->getLocation(),
            $newEvent->getDate(),
            $newEvent->getDescription(),
            $newEvent->getVip_quantity(),
            $newEvent->getRegular_quantity(),
            $newEvent->getVip_price(),
            $newEvent->getRegular_price(),
            $fileName
        );
    } else {

        if (in_array($formatedExt, $allowed)) {
            if ($bunnerError === 0) {
                $fileName = uniqid('', true) . "." . $formatedExt;
                $destination = '../images/' . $fileName;
                move_uploaded_file($bunnerTmpName, $destination);

                $newEvent->updateEvents(
                    $id,
                    $newEvent->getName(),
                    $newEvent->getLocation(),
                    $newEvent->getDate(),
                    $newEvent->getDescription(),
                    $newEvent->getVip_quantity(),
                    $newEvent->getRegular_quantity(),
                    $newEvent->getVip_price(),
                    $newEvent->getRegular_price(),
                    $fileName
                );
            } else {
                $error = "Error occured during file upload";
                $_SESSION['errors'] = $error;
                header('Location: ../views/addEvent.php');
                return;
            }
        } else {

            $error = "The type of file Uploaded is not allowed, only images are allowed";
            $_SESSION['errors'] = $error;
            header('Location: ../views/addEvent.php');
            return;
        }
    }
}

//delete events
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $viewEvent  = new manageEvents();
    $viewEvent->deleteEvent($id);
}
