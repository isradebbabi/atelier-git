<?php
include '../../controller/hebergementc.php';

$hebergement = new hebergementc();
$hebergement->deleteHebergement($_GET['deleteid']);
header('location: displayHebergement.php');
?>