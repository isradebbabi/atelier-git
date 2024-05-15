<?php

require_once '../../../controller/voyageC.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id_voy = $_POST['idVoy'];
    $titre = $_POST['titre'];
    $id_des = $_POST['idDes'];
    $date_debut = $_POST['dateDebut'];
    $date_fin = $_POST['dateFin'];
    $prix = $_POST['prix'];
    $description = $_POST['description'];
    $motivation = $_POST['Motivation'];
    $moyen_transport = $_POST['moyenTransport'];
    $voyageC = new voyageC();
    $result = $voyageC->addVoyage($id_voy, $titre, $id_des, $date_debut, $date_fin, $prix, $description, $motivation, $moyen_transport);
    if ($result) {
        header("Location: backoffice.php");
        exit();
    } else {
        echo "Failed to Add the voyage.";
    }
} else {
    echo "Voyage ID not provided or invalid.";
}
?>
