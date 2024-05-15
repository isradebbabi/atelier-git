<?php
if (isset($_GET['id_des']) && !empty($_GET['id_des'])) {

    require_once '../Controller/destinationC.php';

    $destinationController = new destinationC;
    $DestinationId = $_GET['id_des'];

    $result = $destinationController->deleteDestination($DestinationId);

    if ($result) {
        header('Location: backoffice.php');
        exit(); 
    } else {
        echo "Failed to delete the Destination.";
    }
} else {
    echo "Destination ID not provided or invalid.";
}
?>