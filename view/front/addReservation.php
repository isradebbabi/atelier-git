<?php
// Include necessary files
include '../../model/reservation.php';
include '../../controller/reservationc.php';
include '../../model/hebergement.php';
include '../../controller/hebergementc.php';

// Create instances of necessary classes
$reservationc = new reservationc();
$error = "";

$hebergementc = new hebergementc();

$tab = $hebergementc->listHebergement();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $id_user = $_POST['id_user'];
        $id_heb = $_POST['id_heb'];
        $id_voy = $_POST['id_voy'];
        $date_res = $_POST['date_res'];
        $participation = $_POST['participation'];
        $prix = $_POST['prix'];
        $statu = $_POST['statu'];
        $pay_meth = $_POST['pay_meth'];


    // Validate input data (you can add more validation as needed)
    if (!checkdate(1, 1, 2024) || strtotime($date_res) < strtotime(date('Y-m-d'))) {
            $error = "Invalid reservation date. Please select a date in 2024 or later.";
        } elseif (!is_numeric($participation) || $participation <= 7) {
            $error = "Invalid participation value. Please enter a numeric value greater than 7.";
        } else {
            // Create the reservation object
            $reservation = new reservation(
                null,
                $id_user,
                $id_heb,
                $id_voy,
                $date_res,
                $participation,
                $prix,
                $statu,
                $pay_meth
            );
        // Add reservation to database
        $success = $reservationc->addReservation($reservation);

        if ($id_heb) {
            $hebergement = $hebergementc->showHebergement($id_heb);

            if ($hebergement) {
                $reservationc->addReservation($reservation);
                $success = "Reservation added successfully.";
                header('Location: confirmation_page.php');

            } else {
                $error = "Invalid hebergement ID.";
            }
        } else {
            $error = "Invalid reservation data.";
        }
    }
}
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
		
 <!-- Bootstrap CSS -->
 <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<style>/* Add custom styles for the price slider */
.price-slider {
    margin-top: 10px; /* Adjust the margin-top value to move the slider down */
    margin-bottom: 10px;
    width: 100%;
    height: 10px;
    background-color: #e0e0e0;
    border-radius: 5px;
}

/* Style the price input field */
.price-input {
    text-align: center;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 8px 12px;
    font-size: 16px;
    color: #333;
}

</style>
</head>
<body class="main-layout">
   
    <header>
        <div class="header">
            <div class="header_white">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">    
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                        <div class="full">
                            <div class="center-desk">
                               
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>


<script>
    $(document).ready(function() {
        $('.dropdown-item').click(function() {
            var selectedType = $(this).text();
            $('#selectedType').val(selectedType);
            $('#typeDropdown').text(selectedType);
        });
    });
</script>
       

    </header>
    <section>
<!--travel-box start-->
<section  class="travel-box">
        	<div class="container">
        		<div class="row">
        			<div class="col-md-12">
        				<div class="single-travel-boxes">
        					<div id="desc-tabs" class="desc-tabs">

								<ul class="nav nav-tabs" role="tablist">

									<li role="presentation" class="active">
                                    <a href="#tours" aria-controls="tours" role="tab" data-toggle="tab" onclick="navigateToAddHebergement()">
									 		<i class="fa fa-tree"></i>
									 		Hebergement
									 	</a>
									</li>

									<li role="presentation">
                                    <a href="#hotels" aria-controls="hotels" role="tab" data-toggle="tab" href="addHebergement.php">
											<i class="fa fa-building"></i>
											Reservation
										</a>
									</li>

                                   
								</ul>

								<!-- Tab panes -->
								<div class="tab-content">

									<div role="tabpanel" class="tab-pane active fade in" id="tours">
                                    <div class="tab-para">
                                    <div class="row" style="padding: 10px;"">
                                        <div class="col-md-10 col-md-offset-1">
                                            <div class="single-tab-select-box">
    
	</div><!--/.about-btn-->
	</div><!--/.col-->
	</div><!--/.row-->
	</div><!--/.tab-para-->
	</div><!--/.tabpannel-->
    <div role="tabpanel" class="tab-pane fade in" id="hotels">
    <div class="tab-para">
        <div class="container">
            <h2 class="text-center mb-4">Add Reservation</h2>
            <form class="main-form" method="post" enctype="multipart/form-data" action="addReservation.php" onchange="showReservationForm()" >
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label for="id_user" class="mb-2">User ID:</label>
                            <input class="form-control form-control-lg rounded-pill" type="text" name="id_user" id="id_user" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label for="id_heb" class="mb-2">Hebergement ID:</label>
                            <input class="form-control form-control-lg rounded-pill" type="text" name="id_heb" id="id_heb" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label for="id_voy" class="mb-2">Voyage ID:</label>
                            <input class="form-control form-control-lg rounded-pill" type="text" name="id_voy" id="id_voy" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label for="date_res" class="mb-2">Reservation Date:</label>
                            <input class="form-control form-control-lg rounded-pill datepicker" type="date" name="date_res" id="date_res" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label for="participation" class="mb-2">Participation:</label>
                            <div class="input-group">
                                <input class="form-control form-control-lg rounded-pill" type="number" name="participation" id="participation" min="8" required>
                                <div class="input-group-append">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                        <label for="prix" class="mb-2">Price Range:</label>
        <!-- Display the price range selected by the user -->
        <input class="form-control form-control-lg rounded-pill price-input" type="text" name="prix" id="prix" readonly required>
        <!-- Slider input for selecting the price range -->
        <div id="slider-range" class="price-slider"></div>
                        </div>
</div>

                    </div>
                </div>
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label for="statu" class="mb-2">Status:</label>
                            <input class="form-control form-control-lg rounded-pill" type="text" name="statu" id="statu" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label for="pay_meth" class="mb-2">Payment Method:</label>
                            <select class="form-control form-control-lg rounded-pill" name="pay_meth" id="pay_meth" required>
                                <option value="">Select Payment Method</option>
                                <option value="card">By Card</option>
                                <option value="cheque">By Cheque</option>
                                <option value="cash">By Cash</option>
                                <option value="Virement">Virement</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 py-3 mx-auto d-block" name="submit">Soumettre</button>
                    </div>
                </div>
            </form>
        </form>
        </div>
    </div>
</div>

<?php
        if (!empty($success)) {
            echo "<div class='success'>" . $success . "</div>";
        }

        if (!empty($error)) {
            echo "<div class='error'>" . $error . "</div>";
        }
        ?>
    </div>
    <div class="notification" id="notification">
    <span id="notification-message"></span>
</div>

<script>
    function showNotification(message) {
        var notification = document.getElementById("notification");
        var notificationMessage = document.getElementById("notification-message");
        notificationMessage.textContent = message;
        notification.style.display = "block";
        setTimeout(function() {
            notification.style.display = "none";
        }, 3000);
    }
</script>
													</div><!--/.about-btn-->
												</div><!--/.col-->

											</div><!--/.row-->

										</div><!--/.tab-para-->

									</div><!--/.tabpannel-->
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    // JavaScript function to toggle the visibility of the travel box
    function toggleTravelBox() {
        var travelBox = document.getElementById("travelBox");
        if (travelBox.style.display === "none") {
            travelBox.style.display = "block";
        } else {
            travelBox.style.display = "none";
        }
    }
</script>
<script>
    $(function() {
    $("#slider-range").slider({
        range: true,
        min: 500,
        max: 6000,
        values: [500, 6000], // Default values
        slide: function(event, ui) {
            // Update the input field with the selected price range
            $("#prix").val("$" + ui.values[0] + " - $" + ui.values[1]);
        }
    });
});
</script>

    
    <script src="js/jquery.min.js"></script>
    <script src="js/plugin.js"></script>
    <script>
        $(document).ready(function() {
            var owl = $('.owl-carousel');
            owl.owlCarousel({
                margin: 10,
                nav: true,
                loop: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            })
        })
    </script>
    <script>
    function navigateToAddHebergement() {
        window.location.href = 'addHebergement.php';
    }
</script>
</body>
</html>