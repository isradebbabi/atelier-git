<?php
include '../../model/reservation.php';
include '../../controller/reservationc.php';
include '../../model/hebergement.php';
include '../../controller/hebergementc.php';

$reservationc = new reservationc();
$error = "";

$hebergementc = new hebergementc();

$tab = $hebergementc->listHebergement();

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

            if ($id_heb) {
                $hebergement = $hebergementc->showHebergement($id_heb);

                if ($hebergement) {
                    $reservationc->addReservation($reservation);
                    echo "Reservation added successfully.";
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
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eforlad travel</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="#" /></div>
    </div>
    <header>
        <div class="header">
            <div class="header_white_section">
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
                                <div class="logo">
                                    <a href="index.html"><img src="images/log.png" alt="#"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                        <div class="menu-area">
                            <div class="limit-box">
                                <nav class="main-menu">
                                    <ul class="menu-area-main">
                                        <li class="active"><a href="#">Home</a></li>
                                        <li><a href="#about">About</a></li>
                                        <li><a href="#travel">Travel</a></li>
                                        <li><a href="#blog">Blog</a></li>
                                        <li><a href="#contact">Contact Us</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section>
        <div class="banner-main">
            <img src="images/bb.png" alt="#" />
            <div class="container">
                <div class="text-bg">
                    <h2>Explore. Discover. Experience.<br><strong class="white"></strong></h2>
                    <h3>We're not just another website; we're your passport to extraordinary experiences. Whether you seek the serene beauty of secluded beaches, the thrill of vibrant city life, or the tranquility of untouched landscapes, we curate journeys that awaken your spirit of adventure.</h3>  
                    <div class="button_section">
                        <a class="main_bt" href="#">Book your Trip Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
        <div class="row">
                <div class="col-lg-6">
                    <div class="hero-text">
 
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 offset-xl-2 offset-lg-1">
                    <div class="booking-form">

<form method="post" enctype="multipart/form-data" action="addReservation.php">
    <h3>Ajouter une réservation</h3>
    <form action="#">

    <div class="form-group">
        <label for="id_user">ID user:</label>
        <input type="text" class="form-control" id="id_user" name="id_user" placeholder="Entrez l'ID de l'utilisateur" required>
    </div>

    <div class="form-group">
        <label for="id_heb">ID hébergement:</label>
        <input type="text" class="form-control" id="id_heb" name="id_heb" placeholder="Entrez l'ID de l'hébergement" required>
    </div>

    <div class="form-group">
        <label for="id_voy">ID voyage    :   </label>
        <input type="text" class="form-control" id="id_voy" name="id_voy" placeholder="Entrez l'ID du voyage" required>
    </div>

    <div class="check-date">
        <label for="date_res">Date :</label>
        <input type="date" class="form-control" id="date_res" name="date_res" required>
        <i class="icon_calendar"></i>
    </div>

    <div class="form-group">
        <label for="participation">Participation:</label>
        <input type="text" class="form-control" id="participation" name="participation" placeholder="Entrez la participation" required>
    </div>

    <div class="form-group">
        <label for="prix">Prix:</label>
        <input type="text" class="form-control" id="prix" name="prix" placeholder="Entrez le prix" required>
    </div>

    <div class="form-group">
        <label for="statut">Statut:</label>
        <input type="text" class="form-control" id="statut" name="statut" placeholder="Entrez le statut" required>
    </div>

    <div class="select-option">
        <label for="pay_meth">Méthode de paiement:</label>
        <select class="form-control" id="pay_meth" name="pay_meth" required>
            <option value="">Sélectionnez une méthode de paiement</option>
            <option value="Carte">Carte</option>
            <option value="Espèce">Espèce</option>
            <option value="Chèque">Chèque</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Valider</button>
</form>
</form>
                    </div>
                </div>
            </div>

</div>
</div>
</div>
</div>
<footer>
        <!-- Your footer content goes here -->
    </footer>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/owl.carousel.js"></script>
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
</body>
</html>