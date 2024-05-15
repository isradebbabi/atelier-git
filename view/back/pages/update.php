<?php
include '../../controller/hebergementc.php';
include '../../model/hebergement.php';

// Initialize variables
$error = "";
$valid = 0;

// Check if update ID is provided
if (isset($_GET['updateid'])) {
    $id_heb = $_GET['updateid'];
    // Create an instance of the controller
    $hebergementc = new hebergementc();
    $hebergement = $hebergementc->showHebergement($id_heb);

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if all required fields are set and not empty
        if (
            isset($_POST["nom"]) &&
            isset($_POST["type"]) &&
            isset($_POST["description"]) &&
            isset($_POST["localisation"]) &&
            isset($_POST["categorie"]) &&
            isset($_POST["service"])
        ) {
            // Validate form data
            if (
                !empty($_POST["nom"]) &&
                !empty($_POST["type"]) &&
                !empty($_POST["description"]) &&
                !empty($_POST["localisation"]) &&
                !empty($_POST["categorie"]) &&
                !empty($_POST["service"])
            ) {
                // Form validation passed
                $valid = 1;
            } else {
                $error = "Missing information";
            }
        }
    }
}

// If form is valid, proceed with updating
if ($valid == 1) {
    $hebergement = new hebergement(
        $_POST["nom"],
        $_POST["type"],
        $_POST["description"],
        $_POST["localisation"],
        $_POST["categorie"],
        $_POST["service"]
    );
    $hebergementc->updateHebergement($hebergement, $id_heb);
    // Redirect to confirmation page
    header('location: HbergReserv.php');
    header("Location: {$_SERVER['REQUEST_URI']}");
exit();

}
?>
