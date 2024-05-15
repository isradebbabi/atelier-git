<?php

require_once '../../../controller/destinationC.php';

if ( isset($_POST['updateIdDes'], $_POST['updateTown'], $_POST['updateDescriptions'], $_POST['updateGPS'], $_POST['updateCountry'], $_POST['updateLangue'], $_POST['updateCategory'], $_POST['updatePurpose'], $_POST['updateClimat'])) {
    // Extract the form data
    $id_des = $_POST['updateIdDes'];
    $nom_ville = $_POST['updateTown'];
    $description_detaillee = $_POST['updateDescriptions'];
    $coordonneesGPS = $_POST['updateGPS'];
    $pays = $_POST['updateCountry'];
    $langueParlee = $_POST['updateLangue'];
    $categorie = $_POST['updateCategory'];
    $motivations = $_POST['updatePurpose'];
    $climat = $_POST['updateClimat'];

    $destinationC = new destinationC();

    $result = $destinationC->updateDestination($id_des,$nom_ville,$description_detaillee,$coordonneesGPS,$pays,$langueParlee,$categorie,$motivations,$climat);
    if ($result) {
        header('Location: backoffice.php');
        exit(); 
    } else {
        echo "Failed to update the Destination.";
    } 
} else {
    echo "Destination ID not provided or invalid.";
}
?>
