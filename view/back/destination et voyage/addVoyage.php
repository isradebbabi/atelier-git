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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Voyage</title>
</head>
<body>
    <h2>Add Voyage</h2>
    <form action="addVoyage.php" method="POST">
        <label for="idVoy">Voyage ID:</label><br>
        <input type="text" id="idVoy" name="idVoy" required><br><br>

        <label for="titre">Title:</label><br>
        <input type="text" id="titre" name="titre" required><br><br>

        <label for="idDes">Destination ID:</label><br>
        <input type="text" id="idDes" name="idDes" required><br><br>

        <label for="dateDebut">Start Date:</label><br>
        <input type="date" id="dateDebut" name="dateDebut" required><br><br>

        <label for="dateFin">End Date:</label><br>
        <input type="date" id="dateFin" name="dateFin" required><br><br>

        <label for="prix">Price:</label><br>
        <input type="text" id="prix" name="prix" required><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="Motivation">Motivation:</label><br>
        <input type="text" id="Motivation" name="Motivation" required><br><br>

        <label for="moyenTransport">Transport:</label><br>
        <input type="text" id="moyenTransport" name="moyenTransport" required><br><br>

        <input type="submit" value="Add Voyage">
    </form>
</body>
</html>
