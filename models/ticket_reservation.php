<?php
require_once('database_connection.php');
require_once('manage_events.php');
require_once('../vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class TicketReservation extends dbconnection
{
    public function __construct()
    { }


    public function getEvent($id)
    {

        $query = "SELECT `name`, `location`,`time`, `vip_price`, `regular_price` FROM churchill_event_tickets.events WHERE event_id= ? ";
        $pre = $this->connectDb()->prepare($query);
        $pre->execute([$id]);
        $vip_price = 0;
        $regular_price = 0;
        $name = null;
        $location = null;
        $time = null;
        while ($row = $pre->fetch(PDO::FETCH_ASSOC)) {
            $vip_price = $row['vip_price'];
            $regular_price = $row['regular_price'];
            $name = $row['name'];
            $location = $row['location'];
            $time = $row['time'];
        }

        return array($vip_price, $regular_price, $name, $location, $time);
    }

    public function emailBodyElements($id, $vip_quantity, $regular_quantity)
    {
        $event = $this->getEvent($id);
        $vip_total_price = ($event[0] * $vip_quantity);
        $regular_total_price = ($event[1] * $regular_quantity);
        $total_price = ($vip_total_price + $regular_total_price);

        return array($total_price, $event[2], $event[3], $event[4]);
    }
    public function sendMail($id, $email, $vip_quantity, $regular_quantity)
    {
        $mailbody = $this->emailBodyElements($id, $vip_quantity, $regular_quantity);
        $name = ucfirst($mailbody[1]);
        $location = ucfirst($mailbody[2]);
        $date = date("F j, Y, g:i a");
        $mail = new PHPMailer(true);
        try {
            // $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com;';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'codezonetesting@gmail.com';
            $mail->Password   = 'password2015Gmail';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('codezonetesting@gmail.com', 'Churchil Laughing Industry Team');
            $mail->addAddress($email);
            $mail->addAddress($email, 'Customer');

            $mail->isHTML(true);
            $mail->Subject = 'Churchil Laughing Industry Events Ticket Reservation';
            $mail->Body    =  "<div>
            <p>Dear Customer,</p>
            <div>
                <p>You have successfully reserved your ticket(s).</p>
                <p>Vip: $vip_quantity Tickets</p>
                <p>Regular: $regular_quantity Tickets</p>
                <p>Total Cost: $mailbody[0]/=</p>
                <p>For <b>$name </b>to be held at  <b>$location</b> on <b>$date</b></p>
                <p>Thank you.</p>
                <p>Yours,</p>
                <span>Churchill Laugh Industry Team</span></p>
            </div>
        </div>";
            $mail->AltBody = 'Body in plain text for non-HTML mail clients';
            $mail->send();
            return;
        } catch (Exception $e) {
            echo "Error occured in sending the email.Try again by refreshing your page or Check your internet connectivity";
            return;
        }
    }
    public function totalInputTickets($vip_quantity, $regular_quantity)
    {
        return $vip_quantity + $regular_quantity;
    }
    public function totalTicketsInDbOfUser($id, $email)
    {
        $sql = "SELECT `vip_ticket_quantity`,`regular_ticket_quantity` FROM churchill_event_tickets.reserved_tickets WHERE user_id= :email AND event_id=:id";
        $stmt = $this->connectDb()->prepare($sql);
        $stmt->execute([':email' => $email, ':id' => $id]);
        $result = $stmt->fetchAll();
        $regular_total = 0;
        $vip_total = 0;
        foreach ($result as $array) {
            $regular_total  += $array['regular_ticket_quantity'];
        }
        foreach ($result as $array) {
            $vip_total  += $array['vip_ticket_quantity'];
        }
        return   $regular_total + $vip_total;
    }

    public function reserveTicket($id, $email, $vip_quantity, $regular_quantity)
    {
        session_start();
        $error = null;
        // $remTickets = new manageEvents();
        // $rem = $remTickets->remainingTickets($id);
        // if ($vip_quantity > $rem[0]) {
        //     $error = "Only $rem[0] vip tickets left";
        //     $_SESSION['errors'] = $error;
        //     header('Location: ../views/reserve_ticket.php');
        //     return;
        // }
        // if ($regular_quantity > $rem[1]) {
        //     $error = "Only $rem[1] regular tickets left";
        //     $_SESSION['errors'] = $error;
        //     header('Location: ../views/reserve_ticket.php');
        //     return;
        // }


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email address";
            $_SESSION['errors'] = $error;
            header('Location: ../views/reserve_ticket.php');
            return;
        } elseif ($this->totalInputTickets($vip_quantity, $regular_quantity) > 5) {
            $error = "You're only allowed to book a maximum of 5 tickets";
            $_SESSION['errors'] = $error;
            header('Location: ../views/reserve_ticket.php');
            return;
        } elseif ($this->totalTicketsInDbOfUser($id, $email) == 5) {
            echo "tickets are= $this->totalTicketsInDbOfUser($email)";
            $error = "Your tickets slots are already full";
            $_SESSION['errors'] = $error;
            header('Location: ../views/reserve_ticket.php');
            return;
        } elseif (($this->totalInputTickets($vip_quantity, $regular_quantity) + $this->totalTicketsInDbOfUser($id, $email)) > 5) {

            $remaining_slots = 5 - ($this->totalTicketsInDbOfUser($id, $email));
            $error = "You only have $remaining_slots remaining slots";
            $_SESSION['errors'] = $error;
            header('Location: ../views/reserve_ticket.php');
            return;
        } elseif ($this->totalInputTickets($vip_quantity, $regular_quantity) == 0) {
            $error = "You cannot submit 0 tickets)";
            $_SESSION['errors'] = $error;
            header('Location: ../views/reserve_ticket.php');
            return;
        } else {
            $reservation_id = uniqid();
            $query =  "INSERT INTO  churchill_event_tickets.reserved_tickets(id,user_id,event_id,vip_ticket_quantity,regular_ticket_quantity) 
         VALUES ('$reservation_id','$email','$id','$vip_quantity','$regular_quantity') ";
            try {
                $this->connectDb()->exec($query);
                $this->sendMail($id, $email, $vip_quantity, $regular_quantity);
                header('Location: ../index.php');
                echo '<script> alert(\'Ticket Reserved Successfully.Check your mail for more info.Thank you\')</script>';
                echo '<script> window.open(\'../index.php\')</script>';
            } catch (Exception $e) {
                echo "ERROR: " . $e->getMessage();
            }
        }
    }
}
