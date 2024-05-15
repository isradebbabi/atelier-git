<?php

require_once '../../../controller/voyageC.php';

if (isset($_POST['updateIdVoy'], $_POST['updateTitre'], $_POST['updateDes'], $_POST['updateDateDebut'], $_POST['updateDateFin'], $_POST['updatePrix'], $_POST['updateDescription'], $_POST['updateMotivation'], $_POST['updateMoyenTransport'])) {
    // Extract the form data
    $idVoy = $_POST['updateIdVoy'];
    $titre = $_POST['updateTitre'];
    $idDes = $_POST['updateDes'];
    $dateDebut = $_POST['updateDateDebut'];
    $dateFin = $_POST['updateDateFin'];
    $prix = $_POST['updatePrix'];
    $description = $_POST['updateDescription'];
    $motivation = $_POST['updateMotivation'];
    $moyenTransport = $_POST['updateMoyenTransport'];

    $voyageC = new voyageC();

    $result = $voyageC->updateVoyage($idVoy, $titre, $idDes, $dateDebut, $dateFin, $prix, $description, $motivation, $moyenTransport);
    if ($result) {
        //header('Location: backoffice.php');
        exit(); 
    } else {
        echo "Failed to update the voyage.";
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
    <title>Update Voyage</title>
</head>
<body>
    <h2>Update Voyage</h2>
    <form action="updateVoyage.php" method="POST">
        <label for="updateIdVoy">Voyage ID:</label><br>
        <input type="text" id="updateIdVoy" name="updateIdVoy" required><br><br>

        <label for="updateTitre">Title:</label><br>
        <input type="text" id="updateTitre" name="updateTitre" required><br><br>

        <label for="updateDes">Destination ID:</label><br>
        <input type="text" id="updateDes" name="updateDes" required><br><br>

        <label for="updateDateDebut">Start Date:</label><br>
        <input type="date" id="updateDateDebut" name="updateDateDebut" required><br><br>

        <label for="updateDateFin">End Date:</label><br>
        <input type="date" id="updateDateFin" name="updateDateFin" required><br><br>

        <label for="updatePrix">Price:</label><br>
        <input type="text" id="updatePrix" name="updatePrix" required><br><br>

        <label for="updateDescription">Description:</label><br>
        <textarea id="updateDescription" name="updateDescription" required></textarea><br><br>

        <label for="updateMotivation">Motivation:</label><br>
        <input type="text" id="updateMotivation" name="updateMotivation" required><br><br>

        <label for="updateMoyenTransport">Transport:</label><br>
        <input type="text" id="updateMoyenTransport" name="updateMoyenTransport" required><br><br>

        <input type="submit" value="Update Voyage">
    </form>
</body>
</html>
