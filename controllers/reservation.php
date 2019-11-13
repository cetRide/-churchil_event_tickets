<?php
require_once('../models/ticket_reservation.php');

if (isset($_POST['reserve_ticket'])) {
    $event_id = $_POST['id'];
    $regular_tickets = $_POST['regular_quantity'];
    $vip_tickets = $_POST['vip_quantity'];
    $email = $_POST['email'];
    $ticketRes = new TicketReservation();
    setcookie("Email", "", time() - 60, "/", "", 0);
    setcookie("Email", $email, time() + (60), "/");
    $ticketRes->reserveTicket($event_id, $email, $vip_tickets, $regular_tickets);
}

if (isset($_POST['reserve'])) {
    $event_id = $_POST['event_id'];
    $regular_price = $_POST['regular_price'];
    $vip_price = $_POST['vip_price'];
    $event_name = $_POST['event_name'];
    $location = $_POST['location'];
    $date = $_POST['date'];

    setcookie("Event", $event_id, time() + (3600), "/");
    setcookie("Regular_price", $regular_price, time() + (3600), "/");
    setcookie("Vip_price", $vip_price, time() + (3600), "/");
    setcookie("Event_name", $event_name, time() + (3600), "/");
    setcookie("Location", $location, time() + (3600), "/");
    setcookie("Date", $date, time() + (3600), "/");
    echo '<script> window.open(\'../views/reserve_ticket.php\',\'_self\')</script>';
}
