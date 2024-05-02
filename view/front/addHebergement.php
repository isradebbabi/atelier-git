<?php
include '../../model/hebergement.php';
include '../../controller/hebergementc.php';

if(isset($_POST['submit'])){
    $nom=$_POST['nom'];
    $type=$_POST['type'];
    $description=$_POST['description'];
    $localisation=$_POST['localisation'];
    $categorie=$_POST['categorie'];
    $service=$_POST['service'];

    // Ajout des contrôles de saisie
    if (!preg_match('/^[A-Za-z]+$/', $type)) {
       
        echo "Le champ Type doit contenir uniquement des lettres alphabétiques";
    }

    if(!preg_match('/^[A-Za-z]+$/', $nom)){

        echo "Le champ nom doit contenir uniquement des lettres alphabétiques";

    }

    $categoriesValides = ["Catégorie A", "Catégorie B", "Catégorie C"]; // Liste des valeurs valides
    if (!in_array($categorie, $categoriesValides)) {

        echo "Veuillez sélectionner une catégorie valide Catégorie A ,Catégorie B ,Catégorie C";    }

    $localisationRegex = '/^[A-Za-z\s]+$/'; // Lettres et espaces uniquement
    if (!preg_match($localisationRegex, $localisation)) {
        
        echo "Le champ Localisation doit contenir uniquement des lettres et des espaces";
    }

    // Autres validations selon vos besoins

    // Si tous les contrôles sont passés, procéder à l'insertion dans la base de données
    $sql="insert into  `hebergement` (nom,type,description,localisation,categorie,service) values ('$nom','$type','$description','$localisation','$categorie','$service')";
    $pdo = Config::getConnexion();
    $stmt = $pdo->query($sql);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
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
<body class="main-layout">
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
        <form class="main-form" method="post" enctype="multipart/form-data" action="addHebergement.php">
    <h3>Find Your Tour</h3>
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                    <label for="nom">Nom Hebergement:</label>
                    <input class="form-control" placeholder="" type="text" name="nom" id="nom" required>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                    <label for="type">Type:</label>
                    <input class="form-control" placeholder="Enter votre type" type="text" name="type" id="type" required>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                    <label for="description">Description:</label>
                    <input class="form-control" placeholder="Enter votre description" type="text" name="description" id="description" required>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                    <label for="localisation">Localisation:</label>
                    <input class="form-control" placeholder="Enter votre localisation" type="text" name="localisation" id="localisation" required>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                    <label for="categorie">Categorie:</label>
                    <input class="form-control" placeholder="Enter votre categorie" type="text" name="categorie" id="categorie" required>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                    <label for="service">Service:</label>
                    <input class="form-control" placeholder="Enter votre service" type="text" name="service" id="service" required>
                </div>
                 </div>
                 </div>
         </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
        </div>

    </section>
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
