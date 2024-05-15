<?php
include '../../controller/reservationc.php';

$reservation = new reservationc();
$reservation->deleteReservation($_GET['deleteid']);
header('location: HbergReserv.php');
?>