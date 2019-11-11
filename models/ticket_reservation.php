<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '\churchil_event_tickets\models\database_connection.php');

class TicketReservation extends dbconnection
{
    public function __construct()
    { }


    public function totalInputTickets($vip_quantity, $regular_quantity)
    {
        return $vip_quantity + $regular_quantity;
    }

    public function totalTicketsInDbOfUser($email)
    {
        $query = "SELECT `vip_ticket_quantity`, `regular_ticket_quantity` FROM churchill_event_tickets.reserved_tickets WHERE email= ? ";
        $pre = $this->connectDb()->prepare($query);
        $pre->execute([$email]);
        $total = 0;
        while ($row = $pre->fetch(PDO::FETCH_ASSOC)) {
            $regular = $row['regular_ticket_quantity'];
            $vip = $row['vip_ticket_quantity'];
            $total = $regular + $vip;
        }

        return $total;
    }


    public function reserveTicket($id, $email, $vip_quantity, $regular_quantity)
    {
        session_start();
        $error = null;
        $messages = null;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email address";
            $_SESSION['errors'] = $error;
            header('Location: ../views/reserve_ticket.php');
            return;
        }
        if ($this->totalInputTickets($vip_quantity, $regular_quantity) > 5) {
            $error = "You're only allowed to book a maximum of 5 tickets";
            $_SESSION['errors'] = $error;
            header('Location: ../views/reserve_ticket.php');
            return;
        } elseif ($this->totalTicketsInDbOfUser($email) >= 5) {
            $error = "Your tickets slots are already full";
            $_SESSION['errors'] = $error;
            header('Location: ../views/reserve_ticket.php');
            return;
        } elseif (($this->totalInputTickets($vip_quantity, $regular_quantity) + $this->totalTicketsInDbOfUser($email)) > 5) {

            $remaining_slots = 5 - ($this->totalTicketsInDbOfUser($email));
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
            $query =  "INSERT INTO  churchill_event_tickets.reserved_tickets(id,email,event_id,vip_ticket_quantity,regular_ticket_quantity) 
         VALUES ('$reservation_id','$email','$id','$vip_quantity','$regular_quantity') ";
            try {
                $this->connectDb()->exec($query);
                // send email

                //alert
                echo '<script> alert(\'Ticket Reserved Successfully.\')</script>';
                echo '<script> window.open(\'../index.php\',\'_self\')</script>';
                session_destroy();
            } catch (Exception $e) {
                echo "ERROR: " . $e->getMessage();
            }
        }
    }
}
