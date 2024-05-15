<?php
if (isset($_GET['id_voy']) && !empty($_GET['id_voy'])) {

    require_once '../Controller/voyageC.php';

    $voyageController = new voyageC();
    $voyageId = $_GET['id_voy'];

    $result = $voyageController->deleteVoyage($voyageId);

    if ($result) {
        header('Location: backoffice.php');
        exit(); 
    } else {
        echo "Failed to delete the voyage.";
    }
} else {
    echo "Voyage ID not provided or invalid.";
}
?>
