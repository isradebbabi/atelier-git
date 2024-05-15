<?php
// Fetch reservation details
// Assuming you have fetched reservation details and stored them in the $reservationDetails variable
// You should fetch $reservationDetails before including the confirmation_page.php file
include '../../model/reservation.php';
include '../../controller/reservationc.php';
include '../../model/hebergement.php';
include '../../controller/hebergementc.php';


$reservationc = new reservationc();

// Call the method to display details
$reservationDetails = $reservationc->listReservations(); // Assuming this returns an array of reservations

// Initialize PDF object




// Write reservation details
if (!empty($reservationDetails)) {
    foreach ($reservationDetails as $reservation) {
        $details = $reservationc->showReservationDetails($reservation);
        
    }

}


// Output PDF to browser

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Confirmation</title>
    <style>
        /* Your CSS styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-top: 0;
        }

        .details {
            margin-bottom: 20px;
        }

        .details label {
            font-weight: bold;
        }

        .details p {
            margin-top: 5px;
        }

        .error-message {
            color: red;
            font-weight: bold;
        }

        .export-button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }
    </style>
</head>
<body>
<div class="container">
        <h1>Reservation Confirmation</h1>
        <form method="post">
            <div class="input-group mb-3">
                <span class="input-group-text" id="id_voy_label">Voyage ID</span>
                <input type="text" class="form-control" placeholder="Enter Voyage ID" aria-label="Voyage ID" aria-describedby="id_voy_label" name="id_voy">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="id_user_label">User ID</span>
                <input type="text" class="form-control" placeholder="Enter User ID" aria-label="User ID" aria-describedby="id_user_label" name="id_user">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="id_heb_label">Hebergement ID</span>
                <input type="text" class="form-control" placeholder="Enter Hebergement ID" aria-label="Hebergement ID" aria-describedby="id_heb_label" name="id_heb">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="id_res_label">Reservation ID</span>
                <input type="text" class="form-control" placeholder="Enter Reservation ID" aria-label="Reservation ID" aria-describedby="id_res_label" name="id_res">
            </div>
            <button type="submit" class="btn btn-primary" name="search">Search</button>
        </form>
        <?php if (!empty($reservationDetails)) : ?>
            <div class="reservation-details">
                <?php foreach ($reservationDetails as $reservation) : ?>
                    <?php echo $reservationc->showReservationDetails($reservation); ?>
                <?php endforeach; ?>
            </div>
            <form method="post" action="export_as_text.php">
                <button class="export-button" type="submit" name="export_text">Export as Text</button>
            </form>
            <a href="addHebergement.php" class="btn btn-primary">Add Hebergement</a>
        <?php elseif (isset($_POST['search'])) : ?>
            <div class="error-message">
                <p>No reservations found.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>