<?php

require_once '../../../controller/destinationC.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Generate destination ID
    $id_des = generateDestinationID(); // Assuming you have a function to generate the ID
    
    // Get other form data
    $nom_ville = $_POST['Town'];
    $description_detaillee = $_POST['Det_Description'];
    $coordonneesGPS = $_POST['GPS'];
    $pays = $_POST['Country'];
    $langueParlee = $_POST['Language'];
    $categorie = $_POST['Category'];
    $motivations = $_POST['Purpose'];
    $climat = $_POST['Climat'];
    
    // Create destinationC instance
    $destinationC = new destinationC();
    
    // Add destination
    $result = $destinationC->addDestination($id_des, $nom_ville, $description_detaillee, $coordonneesGPS, $pays, $langueParlee, $categorie, $motivations, $climat);
    
    if ($result) {
        // Destination added successfully
        // Redirect or perform any other action
        
        // For example, redirect to backoffice.php
        header("Location: backoffice.php");
        exit();
    } else {
        // Failed to add destination
        echo "Failed to Add the destination.";
    }
} else {
    // Request method is not POST
    echo "Invalid request.";
}

// Function to generate destination ID
function generateDestinationID() {
    // Implement your logic to generate the destination ID here
    // Example: return a unique ID using timestamp or any other method
    return uniqid(); // Example using uniqid()
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Destination</title>
    <style>
        /* CSS to hide the label */
        label[for="idDes_Des"] {
            display: none;
        }
    </style>
</head>
<body>
    <h2>Add Destination</h2>
    <form action="addDestination.php" method="POST">
        <!-- Hidden label for Destination ID -->
        <label for="idDes_Des">Destination ID:</label><br>
        <input type="text" id="idDes_Des" name="idDes_Des" required><br><br>

        <label for="Town">Town:</label><br>
        <input type="text" id="Town" name="Town" required><br><br>

        <label for="Det_Description">Description:</label><br>
        <textarea id="Det_Description" name="Det_Description" required></textarea><br><br>

        <label for="GPS">GPS:</label><br>
        <input type="text" id="GPS" name="GPS" required><br><br>

        <label for="Country">Country:</label><br>
        <input type="text" id="Country" name="Country" required><br><br>

        <label for="Language">Language:</label><br>
        <input type="text" id="Language" name="Language" required><br><br>

        <label for="Category">Category:</label><br>
        <input type="text" id="Category" name="Category" required><br><br>

        <label for="Purpose">Purpose:</label><br>
        <input type="text" id="Purpose" name="Purpose" required><br><br>

        <label for="Climat">Climate:</label><br>
        <input type="text" id="Climat" name="Climat" required><br><br>

        <input type="submit" value="Add Destination">
    </form>
</body>
</html>
