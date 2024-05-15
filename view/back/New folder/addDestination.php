<?php

require_once '../../../controller/destinationC.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idDes_Des'])) {
    // Get form data
    $id_des = $_POST['idDes_Des'];
    $nom_ville = $_POST['Town'];
    $description_detaillee = $_POST['Det_Description'];
    $coordonneesGPS = $_POST['GPS'];
    $pays = $_POST['Country'];
    $langueParlee = $_POST['Language'];
    $categorie = $_POST['Category'];
    $motivations = $_POST['Purpose'];
    $climat = $_POST['Climat'];
    $destinationC = new destinationC();
    $result = $destinationC->addDestination($id_des,$nom_ville,$description_detaillee,$coordonneesGPS,$pays,$langueParlee,$categorie,$motivations,$climat);
    if ($result) {
        header("Location: backoffice.php");
        exit();
    } else {
        echo "Failed to Add the destination.";
    }
} else {
    echo "Destination ID not provided or invalid.";
}
?>
