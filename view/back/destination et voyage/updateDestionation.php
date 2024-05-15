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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Destination</title>
</head>
<body>
    <h2>Update Destination</h2>
    <form action="updateDestination.php" method="POST">
        <label for="updateIdDes">Destination ID:</label><br>
        <input type="text" id="updateIdDes" name="updateIdDes" required><br><br>

        <label for="updateTown">Town:</label><br>
        <input type="text" id="updateTown" name="updateTown" required><br><br>

        <label for="updateDescriptions">Descriptions:</label><br>
        <textarea id="updateDescriptions" name="updateDescriptions" required></textarea><br><br>

        <label for="updateGPS">GPS:</label><br>
        <input type="text" id="updateGPS" name="updateGPS" required><br><br>

        <label for="updateCountry">Country:</label><br>
        <input type="text" id="updateCountry" name="updateCountry" required><br><br>

        <label for="updateLangue">Language:</label><br>
        <input type="text" id="updateLangue" name="updateLangue" required><br><br>

        <label for="updateCategory">Category:</label><br>
        <input type="text" id="updateCategory" name="updateCategory" required><br><br>

        <label for="updatePurpose">Purpose:</label><br>
        <input type="text" id="updatePurpose" name="updatePurpose" required><br><br>

        <label for="updateClimat">Climate:</label><br>
        <input type="text" id="updateClimat" name="updateClimat" required><br><br>

        <input type="submit" value="Update Destination">
    </form>
</body>
</html>
