<?php
include '../../controller/reservationc.php';
include '../../model/reservation.php';
include '../../controller/hebergementc.php';
include '../../model/hebergement.php';

$error = "";

// Check if the "updateid" parameter is set in the URL
if (isset($_GET['updateid'])) {
    $id_res = $_GET['updateid'];
    // create an instance of the controller
    $reservationc = new reservationc();
    $hebergementc = new hebergementc();
    $reservation = $reservationc->showReservation($id_res);

    // Check if the reservation is found
    if ($reservation) {
        $id_heb = $reservation['id_heb'];
        $tab = $hebergementc->showHebergement($id_heb);

        $valid = 0;
        // Check if the form is submitted
        if (isset($_POST["submit"])) {
            $id_user = $_POST["id_user"];
            $id_heb = $_POST["id_heb"];
            $id_voy = $_POST["id_voy"];
            $date_res = $_POST["date_res"];
            $participation = $_POST["participation"];
            $prix = $_POST["prix"];
            $statu = $_POST["statu"];
            $pay_meth = $_POST["pay_meth"];

            // Check if all the required fields are filled
            if (!empty($id_user) && !empty($id_heb) && !empty($id_voy) && !empty($date_res) && !empty($participation) && !empty($prix) && !empty($statu) && !empty($pay_meth)) {
                $valid = 1; // Form validation passed
            } else {
                $error = "Missing information";
            }
        }

        if ($valid == 1) {
            // Check if the IDs are not modified
            if ($_POST['id_res'] == $reservation['id_res'] && $_POST['id_heb'] == $reservation['id_heb']) {
                $type = isset($tab['type']) ? $tab['type'] : '';
                $description = isset($tab['description']) ? $tab['description'] : '';
                $localisation = isset($tab['localisation']) ? $tab['localisation'] : '';
                $categorie = isset($tab['categorie']) ? $tab['categorie'] : '';
                $service = isset($tab['service']) ? $tab['service'] : '';

                $hebergement = new hebergement($id_heb, $type, $description, $localisation, $categorie, $service);
                $reservation = new reservation(
                    $id_res,
                    $id_user,
                    $id_heb,
                    $id_voy,
                    $date_res,
                    $participation,
                    $prix,
                    $statu,
                    $pay_meth
                );
                try {
                    $reservationc->updateReservation($reservation, $id_res);
                    header('location: HbergReserv.php');
                    exit; // Exit after redirection
                } catch (PDOException $e) {
                    $error = "Error updating reservation: " . $e->getMessage();
                }
            } else {
                $error = "Modification of IDs is not allowed";
            }
        }
    } else {
        $error = "Reservation not found";
    }
} else {
    $error = "Missing updateid parameter";
}

// Display the error message if any
if (!empty($error)) {
    echo "<div class='error'>" . $error . "</div>";
}
?>
