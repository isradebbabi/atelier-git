<?php
include '../../../controller/voyageC.php';
include '../../../controller/destinationC.php';
//include '../tables.php';
$voy1= new voyageC();
$ListVoyages = $voy1->getDestinationWithVoyage();
$des1= new destinationC();
$ListDestination = $des1->list_Destination1();
$ListDestination2  = $des1->listDestination();

// Generate travel statistics
$travelStatistics = $voy1->generateTravelStatistics();

// Convert travel statistics data to JSON format for JavaScript charting
$travelCountByDestinationJSON = json_encode($travelStatistics['travel_count_by_destination']);
$avgTravelPriceByDestinationJSON = json_encode($travelStatistics['avg_travel_price_by_destination']);
$travelCountByTransportJSON = json_encode($travelStatistics['travel_count_by_transport']);
$mostFrequentDurationByTransportJSON = json_encode($travelStatistics['most_frequent_duration_by_transport']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/LogoTravisa.png">
  <title>
    TraVisa by innovation
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.11.4/i18n/French.json"></script>
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="./assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
  <title>Mini-carte de localisation</title>
    <!-- Inclure la bibliothèque Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5GF7-lMCCPrMtNWpc1x6LJQvyxh6IPOk&callback=initMap" async defer></script>
    <style>
        /* Définir une taille pour la carte */
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
    <script>
        // Fonction d'initialisation de la carte
        function initMap() {
            // Création d'une nouvelle carte Google Maps
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15, // Zoom par défaut
                mapTypeControl: true,
                streetViewControl: true,
                fullscreenControl: true
            });

            // Essayer d'obtenir la position actuelle de l'utilisateur
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var userCoords = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    map.setCenter(userCoords);
                }, function() {
                    // Gérer les erreurs de géolocalisation
                    handleLocationError(true, map.getCenter());
                });
            } else {
                // Le navigateur ne prend pas en charge la géolocalisation
                handleLocationError(false, map.getCenter());
            }

            // Création d'un marqueur pour marquer l'ESPRIT Tunisia sur la carte
            var espirtMarker = new google.maps.Marker({
                position: { lat: 36.899345262092005, lng: 10.189394119430952 },
                map: map,
                title: 'ESPRIT Tunisia',
                icon: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png' // Utilisation d'un marqueur personnalisé
            });

            // Ajouter une info-bulle à l'ESPRIT Tunisia
            var infowindow = new google.maps.InfoWindow({
                content: '<strong>ESPRIT Tunisia</strong><br>ESPRIT Tunisia'
            });
            espirtMarker.addListener('click', function() {
                infowindow.open(map, espirtMarker);
            });
        }

        // Fonction pour gérer les erreurs de géolocalisation
        function handleLocationError(browserHasGeolocation, coords) {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: coords,
                zoom: 15
            });
            var infoWindow = new google.maps.InfoWindow({
                content: browserHasGeolocation ?
                    "Erreur: Le service de géolocalisation a échoué." :
                    "Erreur: Votre navigateur ne prend pas en charge la géolocalisation."
            });
            var userMarker = new google.maps.Marker({ position: coords, map: map });
            infoWindow.open(map);
        }
    </script>
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
        <img src="./assets/img/Travisa/LogoTravisa.png" class="navbar-brand-img h-100" alt="main_logo" width="50" height="50">
        <span class="ms-1 font-weight-bold">TraVisa</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="./pages/dashboard.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./tabels.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Tables</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./pages/billing.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Billing</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./pages/virtual-reality.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Virtual Reality</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./pages/rtl.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">RTL</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./pages/profile.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./pages/sign-in.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Sign In</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./pages/sign-up.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-collection text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Sign Up</span>
          </a>
        </li>
      </ul>
    </div>

  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
      data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Dashboard</h6>
        </nav>
                                      <!-- START SERACH -->
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
  <div class="ms-md-auto pe-md-3 d-flex align-items-center">
    <div class="input-group">
      <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
      <input type="text" class="form-control" name="search" id="search" placeholder="Type here...">
      <button id="searchButton" class="btn btn-primary">Search</button>
    </div>
  </div>
</div>
                                           <!-- END SERACH -->
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Sign In</span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="./assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New message</span> from Laur
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          13 minutes ago
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="./assets/img/small-logos/logo-spotify.svg"
                          class="avatar avatar-sm bg-gradient-dark  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New album</span> by Travis Scott
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          1 day
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1"
                          xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>credit-card</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(453.000000, 454.000000)">
                                  <path class="color-background"
                                    d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                                    opacity="0.593633743"></path>
                                  <path class="color-background"
                                    d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                  </path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          Payment successfully completed
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          2 days
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">number of Trips</p>
                    <h5 class="font-weight-bolder">
                      
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder"></span>
                      
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold"></p>
                    <h5 class="font-weight-bolder">
                      
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder"></span>
                     
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold"></p>
                    <h5 class="font-weight-bolder">
                      
                    </h5>
                    <p class="mb-0">
                      <span class="text-danger text-sm font-weight-bolder"></span>
                      
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold"></p>
                    <h5 class="font-weight-bolder">
                     
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder"></span> 
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
                          <!-- Trip -->
      <!-- a partir mena -->
      <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4"> <!-- col-lg-7 should take up 7 columns out of 12 available in a large screen (lg) viewport -->
          <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
              <h6 class="text-capitalize">Trips</h6>
              <p class="text-sm mb-0">
                <i class="fa fa-arrow-up text-success"></i>
                <span class="font-weight-bold"></span>
              </p>
              <button class="btn btn-primary" id="addVoyageBtn">Add Trip</button>
              <button class="btn btn-primary" onclick="exportToPDF()">Export to PDF</button>
            </div>
            <div class="card-body p-3">
              <div class="table-responsive">
              
                <table class="table align-items-center ">
                  <tbody>
                    <?php echo $ListVoyages; ?>
                    <div id="deleteConfirmation" class="popup">
                        <div class="popup-content">
                            <p>Are you sure you want to delete this Trip ?</p>
                            <button id="confirmDelete">Yes</button><button id="cancelDelete">Cancel</button>
                        </div>
                    </div>
                    <!-- Pop-up for update VOYAGE -->
                    <div id="updatePopup" class="popup">
                        <div class="popup-content">
                       

                        <span class="close" onclick="closeUpdatePopup()">&times;</span>
                        <h2>Update Trip</h2>
                            <!-- Form for updating voyage data -->
                            <form id="updateForm" action="updateVoyage.php" method="POST">
                                <input type="hidden" id="updateIdVoy" name="updateIdVoy" value="">
                               <!-- Title -->
                              <label for="updateTitre">Titre:</label>
                              <input type="text" id="updateTitre" name="updateTitre" required>
                              <div id="updateTitreError" class="error-msg"></div>

                              <!-- Destination ID -->
                              <label for="updateDes">Destination:</label>
                              <select name="updateDes" id="updateDes" required>
                                  <?php foreach ($ListDestination as $destination) : ?>
                                      <option value="<?php echo $destination['id_des']; ?>">
                                          <?php echo $destination['nom_ville'] . ', ' . $destination['pays']; ?>
                                      </option>
                                  <?php endforeach; ?>
                              </select>
                              <div id="updateDesError" class="error-msg"></div>

                              <!-- Start Date -->
                              <label for="updateDateDebut">Date Début:</label>
                              <input type="date" id="updateDateDebut" name="updateDateDebut" required>
                              <div id="updateDateDebutError" class="error-msg"></div>

                              <!-- End Date -->
                              <label for="updateDateFin">Date Fin:</label>
                              <input type="date" id="updateDateFin" name="updateDateFin" required>
                              <div id="updateDateFinError" class="error-msg"></div>

                              <!-- Price -->
                              <label for="updatePrix">Prix:</label>
                              <input type="number" id="updatePrix" name="updatePrix" step="0.01" required>
                              <div id="updatePrixError" class="error-msg"></div>

                              <!-- Description -->
                              <label for="updateDescription">Description:</label>
                              <input type="text" id="updateDescription" name="updateDescription" required>
                              <div id="updateDescriptionError" class="error-msg"></div>

                              <!-- Motivation -->
                              <label for="updateMotivation">Motivation:</label>
                              <select id="updateMotivation" name="updateMotivation" required>
                                  <option value="Leisure and Recreation">Leisure and Recreation</option>
                                  <option value="Adventure and Exploration">Adventure and Exploration</option>
                                  <option value="Education and Learning">Education and Learning</option>
                                  <option value="Volunteer and Humanitarian Work">Volunteer and Humanitarian Work</option>
                                  <option value="Events">Events</option>
                              </select>
                              <div id="updateMotivationError" class="error-msg"></div>

                              <!-- Means of Transport -->
                              <label for="updateMoyenTransport">Moyen de Transport:</label>
                              <select id="updateMoyenTransport" name="updateMoyenTransport" required>
                                  <option value="Airplanes">Airplanes</option>
                                  <option value="Cruis">Cruis</option>
                                  <option value="Train">Train</option>
                                  <option value="Bus">Bus</option>
                              </select>
                              <div id="updateMoyenTransportError" class="error-msg"></div>
                              <button type="submit">Confirm Update</button>
                            </form>
                        </div>
                    </div>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- lena -->
                        <!-- Destination -->
        <div class="row mt-4">
          <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
             <div class="card-header pb-0 pt-3 bg-transparent">
             <h6 class="text-capitalize">Destinations</h6>
             <p class="text-sg mb-0">
                <i class="fa fa-arrow-up text-success"></i>
                <span class="font-weight-bold"></span>
              </p>
              <button class="btn btn-primary" id="addDestinationBtn">Add Destination</button>
              <div class="card-body p-3">
              <div class="table-responsive">
              
                <table class="table align-items-center ">
                  <tbody>
                  <?php echo $ListDestination; ?>
                    <div id="deleteConfirmation_Des" class="popup">
                        <div class="popup-content">
                            <p>Are you sure you want to delete this Destination?</p>
                            <button id="confirmDelete_Des">Yes</button><button id="cancelDelete_Des">Cancel</button>
                        </div>
                    </div>
                   <!-- Pop-up for update DESTINATION-->
                   <div id="updatePopup_Des" class="popup">
                        <div class="popup-content">
                        <span class="close" onclick="closeUpdatePopup_Des()">&times;</span>
                        <h2>Update Destination</h2>
                            <!-- Form for updating Destination data -->
                            <form id="updateForm_Des" action="updateDestionation.php" method="post">
                                <input type="hidden" id="updateIdDes" name=updateIdDes value="">
                              <!-- Town -->
                              <label for="updateTown">Town :</label>
                              <input type="text" id="updateTown" name="updateTown" required>
                              <div id="updateTownError" class="error-msg"></div>

                              <!-- Detailed_Description  -->
                              <label for="updateDescriptions">Detailed Description:</label>
                              <input type="text" id="updateDescriptions" name="updateDescriptions" required>
                              <div id="updateDescriptionsError" class="error-msg"></div>

                              <!-- GPS -->
                              <label for="updateGPS">GPS:</label>
                              <input type="text" id="updateGPS" name="updateGPS" required>
                              <div id="updateGPSError" class="error-msg"></div>

                             <!-- Country -->
                              <label for="updateCountry">Country:</label>
                              <input type="text" id="updateCountry" name="updateCountry" required>
                              <div id="updateCountryError" class="error-msg"></div>


                              <!-- Language -->
                              <label for="updateLangue">Language:</label>
                              <select id="updateLangue" name="updateLangue" required>
                                    <option value="Mandarin Chinese">Mandarin Chinese</option>
                                    <option value="Spanish">Spanish</option>
                                    <option value="English">English</option>
                                    <option value="Hindi">Hindi</option>
                                    <option value="Arabic">Arabic</option>
                                    <option value="French">French</option>
                                    <option value="Russian">Russian</option>
                                    <option value="Japanese">Japanese</option>
                                    <option value="Portuguese">Portuguese</option>
                                </select>
                              <div id="updateLangueError" class="error-msg"></div>

                              <!-- Category -->
                              <label for="updateCategory">Category:</label>
                              
                              <select id="updateCategory" name="updateCategory" required>
                                <option value="Adventure">Adventure</option>
                                <option value="Nature">Nature</option>
                                <option value="Culturel">Culturel</option>
                              </select>
                              <div id="updateCategoryError" class="error-msg"></div>

                              <!-- Purpose -->
                              <label for="updatePurpose">Purpose:</label>
                              <select id="updatePurpose" name="updatePurpose" required>
                                  <option value="Leisure and Recreation">Leisure and Recreation</option>
                                  <option value="Adventure and Exploration">Adventure and Exploration</option>
                                  <option value="Education and Learning">Education and Learning</option>
                                  <option value="Volunteer and Humanitarian Work">Volunteer and Humanitarian Work</option>
                                  <option value="Events">Events</option>
                              </select>
                              <div id="updatePurposeError" class="error-msg"></div>

                              <!-- Climat -->
                            <label for="updateClimat">Climat:</label>
                            <select id="updateClimat" name="updateClimat" required>
                              <option value="Tropical"> Tropical </option>
                              <option value="Arid/Desert">Arid/Desert</option>
                              <option value="Polar"> Polar </option>
                              <option value="Subtropical"> Subtropical </option>
                              <option value="Mediterranean"> Mediterranean </option>
                              <option value="Mountainous/Alpine"> Mountainous/Alpine </option>
                              <option value="Continental"> Continental </option>
                              <option value="Oceanic"> Oceanic </option>
                            </select>
                            <div id="updateClimatError" class="error-msg"></div>
                             <button type="submit">Confirm Update </button>
                             </form>
                        </div>
                    </div>

                  </tbody>
                </table>
             </div>
            </div>
          </div>
        </div>
     
        
        <div class="col-lg-5">
          <div class="card card-carousel overflow-hidden h-100 p-0">
            <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
              <div class="carousel-inner border-radius-lg h-100">
                <div class="carousel-item h-100 active" style="background-image: url('./assets/img/Travisa/jezael-melgoza-NiyRORf8d8I-unsplash\ 1.png');
      background-size: cover;">
                  <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                      <i class="ni ni-camera-compact text-dark opacity-10"></i>
                    </div>
                    <h5 class="text-white mb-1">Get started with Argon</h5>
                    <p>There’s nothing I really wanted to do in life that I wasn’t able to get good at.</p>
                  </div>
                </div>
                <div class="carousel-item h-100" style="background-image: url('./assets/img/Travisa/Group\ 339.png');
      background-size: cover;">
                  <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                      <i class="ni ni-bulb-61 text-dark opacity-10"></i>
                    </div>
                    <h5 class="text-white mb-1">Faster way to create web pages</h5>
                    <p>That’s my skill. I’m not really specifically talented at anything except for the ability to
                      learn.</p>
                  </div>
                </div>
                <div class="carousel-item h-100" style="background-image: url('./assets/img/Travisa/juan-di-nella-ulhxvMjzI_4-unsplash\ 1.png');
      background-size: cover;">
                  <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                      <i class="ni ni-trophy text-dark opacity-10"></i>
                    </div>
                    <h5 class="text-white mb-1">Share with us your design tips!</h5>
                    <p>Don’t be afraid to be wrong because you can’t learn anything from a compliment.</p>
                  </div>
                </div>
              </div>
              <button class="carousel-control-prev w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
        </div>
      </div>
        <!-- Add button for adding a new voyage -->
        

<!-- Pop-up for adding a new voyage -->
<!-- Pop-up for adding a new voyage -->
<div id="addVoyagePopup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closeAddPopup()">&times;</span>
        <h2>Add Trip</h2>
        <form id="addVoyageForm" method="post" action="addVoyage.php">
            <!-- ID Voyage -->
            <label for="idVoy">Voyage ID:</label>
            <input type="number" id="idVoy" name="idVoy" required>
            <div id="idVoyError" class="error-msg"></div>

            <!-- Title -->
            <label for="titre">Title:</label>
            <input type="text" id="titre" name="titre" required>
            <div id="titreError" class="error-msg"></div>

            <!-- Destination ID -->
            <label for="idDes">Destination:</label>
            <select name="idDes" id="idDes" required>
                <?php foreach ($ListDestination as $destination) : ?>
                    <option value="<?php echo $destination['id_des']; ?>">
                        <?php echo $destination['nom_ville'] . ', ' . $destination['pays']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <div id="idDesError" class="error-msg"></div>


            <!--<input type="number" id="idDes" name="idDes" required>-->
            <div id="idDesError" class="error-msg"></div>

            <!-- Start Date -->
            <label for="dateDebut">Start Date:</label>
            <input type="date" id="dateDebut" name="dateDebut" required>
            <div id="dateDebutError" class="error-msg"></div>

            <!-- End Date -->
            <label for="dateFin">End Date:</label>
            <input type="date" id="dateFin" name="dateFin" required>
            <div id="dateFinError" class="error-msg"></div>

            <!-- Price -->
            <label for="prix">Price:</label>
            <input type="number" id="prix" name="prix" step="0.01" required>
            <div id="prixError" class="error-msg"></div>

            <!-- Description -->
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" required>
            <div id="descriptionError" class="error-msg"></div>

            <!-- Motivation -->
            <label for="Motivation">Motivation:</label>
            <select id="Motivation" name="Motivation" required>
                <option value="Leisure and Recreation">Leisure and Recreation</option>
                <option value="Adventure and Exploration">Adventure and Exploration</option>
                <option value="Education and Learning">Education and Learning</option>
                <option value="Volunteer and Humanitarian Work">Volunteer and Humanitarian Work</option>
                <option value="Events">Events</option>
            </select>
            <div id="MotivationError" class="error-msg"></div>

            <!-- Means of Transport -->
            <label for="moyenTransport">Means of Transport:</label>
            <select id="moyenTransport" name="moyenTransport" required>
                <option value="Airplanes">Airplanes</option>
                <option value="Cruis">Cruis</option>
                <option value="Train">Train</option>
                <option value="option_means_4">Bus</option>
            </select>
            <div id="moyenTransportError" class="error-msg"></div>

            <button type="submit">Add</button>
        </form>
    </div>
</div>

 <!-- Add button for adding a new Destination  -->
    <!-- Pop-up for adding a new Destination -->
    <!-- Pop-up for adding a new Destination -->
    <div id="addDestinationPopup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closeAddDestinationPopup()">&times;</span>
        <h2>Add Destination</h2>
        <form id="addDestinationForm" method="post" action="addDestination.php">
            <!-- ID Destination -->
            <label for="idDes_Des">Destination ID:</label>
            <input type="number" id = "idDes_Des" name="idDes_Des" required>
            <div id="idDes_DesError" class="error-msg"></div>

            <!-- Town -->
            <label for="Town">Town:</label>
            <input type="text" id="Town" name="Town" required>
            <div id="TownError" class="error-msg"></div>

            <!-- Detailed Description -->
            <label for=“Det_Description”>Detailed Description :</label>
            <input type=“text” id="Det_Description" name="Det_Description" required>
            <div id="Det_DescriptionError" class="error-msg"></div>

            <!-- GPS -->
            <label for="GPS">GPS:</label>
            <input type="text" id="GPS" name="GPS" required>
            <div id="GPSError" class="error-msg"></div>

            <!-- Country -->
            <label for="Country">Country:</label>
            <input type=“text” id="Country" name="Country" required>
            <div id="CountryError" class="error-msg"></div>

            <!-- Language -->
            <label for="Language">Language:</label>
            <select id="Language" name="Language" required>
                <option value="Mandarin Chinese">Mandarin Chinese</option>
                <option value="Spanish">Spanish</option>
                <option value="English">English</option>
                <option value="Hindi">Hindi</option>
                <option value="Arabic">Arabic</option>
                <option value="French">French</option>
                <option value="Russian">Russian</option>
                <option value="Japanese">Japanese</option>
                <option value="Portuguese">Portuguese</option>
            </select>
            <div id="LanguageError" class="error-msg"></div>

            <!-- Category -->
            <label for="Category">Category:</label>
            <select id="Category" name="Category" required>
              <option value="Adventure">Adventure</option>
              <option value="Nature">Nature</option>
              <option value="Culturel">Culturel</option>
             </select>
            <div id="CategoryError" class="error-msg"></div>

            <!-- Purpose -->
            <label for="Purpose">Purpose:</label>
            <select id="Purpose" name="Purpose" required>
                <option value="Leisure and Recreation">Leisure and Recreation</option>
                <option value="Adventure and Exploration">Adventure and Exploration</option>
                <option value="Education and Learning">Education and Learning</option>
                <option value="Volunteer and Humanitarian Work">Volunteer and Humanitarian Work</option>
                <option value="Events">Events</option>
            </select>
            <div id="PurposeError" class="error-msg"></div>

            <!-- Climat -->
            <label for="Climat">Climat:</label>
            <select id="Climat" name="Climat" required>
       <option value="Tropical"> Tropical </option>
                              <option value="Arid/Desert">Arid/Desert</option>
                              <option value="Polar"> Polar </option>
                              <option value="Subtropical"> Subtropical </option>
                              <option value="Mediterranean"> Mediterranean </option>
                              <option value="Mountainous/Alpine"> Mountainous/Alpine </option>
                              <option value="Continental"> Continental </option>
                              <option value="Oceanic"> Oceanic </option>
            </select>
            <div id="ClimatError" class="error-msg"></div>

            <button type="submit">Add Destination</button>
        </form>
    </div>
</div>
                                    <!-- MENAAA -->
      <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
          <div class="card ">
            <div class="card-header pb-0 p-3">
              <div class="d-flex justify-content-between">
                <h6 class="mb-2">Statistics By Date</h6>
                <div style="width: 50%; margin: auto;">
        <!-- Display count of users by role as a bar chart -->
        
        <canvas id="travelCountChart"></canvas>
        <canvas id="avgTravelPriceChart"></canvas>
        <canvas id="travelCountByTransportChart"></canvas>
        <canvas id="mostFrequentDurationByTransport"></canvas>
       
    </div>
              </div>
            </div>
            
          </div>
        </div>
        <!-- LENAAA -->
        <div class="col-lg-5">
          <div class="card">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Categories</h6>
            </div>
            <div class="card-body p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                      <i class="ni ni-mobile-button text-white opacity-10"></i>
                    </div>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Devices</h6>
                      <span class="text-xs">250 in stock, <span class="font-weight-bold">346+ sold</span></span>
                    </div>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                        class="ni ni-bold-right" aria-hidden="true"></i></button>
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                      <i class="ni ni-tag text-white opacity-10"></i>
                    </div>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Tickets</h6>
                      <span class="text-xs">123 closed, <span class="font-weight-bold">15 open</span></span>
                    </div>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                        class="ni ni-bold-right" aria-hidden="true"></i></button>
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                      <i class="ni ni-box-2 text-white opacity-10"></i>
                    </div>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Error logs</h6>
                      <span class="text-xs">1 is active, <span class="font-weight-bold">40 closed</span></span>
                    </div>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                        class="ni ni-bold-right" aria-hidden="true"></i></button>
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                      <i class="ni ni-satisfied text-white opacity-10"></i>
                    </div>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm">Happy users</h6>
                      <span class="text-xs font-weight-bold">+ 430</span>
                    </div>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                        class="ni ni-bold-right" aria-hidden="true"></i></button>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                ©
                <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                for a better web.
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About
                    Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                    target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Argon Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0 overflow-auto">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary"
              onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white"
            onclick="sidebarType(this)">White</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default"
            onclick="sidebarType(this)">Dark</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="d-flex my-3">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <div class="mt-2 mb-5 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/argon-dashboard">Free
          Download</a>
        <a class="btn btn-outline-dark w-100"
          href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard"
            data-icon="octicon-star" data-size="large" data-show-count="true"
            aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard"
            class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard"
            class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>
  <style>
                    .popup {
                        display: none;
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background-color: rgba(0, 0, 0, 0.5);
                        z-index: 9999;
                    }

                    .popup-content {
                        position: absolute;
                        top: 50%; left: 50%;
                        transform: translate(-50%, -50%);
                        background-color: white;
                        padding: 30px;
                        border-radius: 20px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
                    }
                    .close {
                        font-size: 24px; /* Adjust the font size to make the "x" larger */
                         line-height: 0; /* Ensure the line height is normal */
                   }
                    /* Style for form container */
                    .form-container {
                        width: 30px; /* Adjust width as needed */
                        margin: 0 auto;
                      }

                      /* Style for form labels */
                      label {
                        display: inline-block;
                        width: 40%; /* Adjust width as needed */
                        margin-bottom: 10px;
                      }

                      /* Style for form inputs and selects */
                      input[type="text"],
                      input[type="date"],
                      input[type="number"],
                      select {
                        width: 55%; /* Adjust width as needed */
                        padding: 2px;
                        margin-bottom: 2px;
                        box-sizing: border-box;
                        display: inline-block;
                      }
                    
        
                    .popup button {
                      width: 50%;
                      padding: 3px;
                      background-color: #4CAF50;
                      color: white;
                      border: none;
                      margin-bottom: 2px;
                      border-radius: 8px;
                      cursor: pointer;

                    }

                    .popup button:hover {
                        background-color: #45a049;
                    }

                      </style>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/chartjs.min.js"></script>
  <script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Mobile apps",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#5e72e4",
          backgroundColor: gradientStroke1,
          borderWidth: 3,
          fill: true,
          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#fbfbfb',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#ccc',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/argon-dashboard.min.js?v=2.0.4"></script>
  <!-- Add this JavaScript code to your HTML file -->
  
                    <!--------------------------------------------------------------------------------->
                                         <!-- Delete Voyage  -->
                    <!--------------------------------------------------------------------------------->
<script> 
    // Function to handle delete confirmation
    function confirmDeleteVoyage(voyageId) {
        // Show the confirmation pop-up
        document.getElementById('deleteConfirmation').style.display = 'block';

        // Set event listeners for confirmation buttons
        document.getElementById('confirmDelete').addEventListener('click', function() {
            // Redirect to deleteVoyage.php with voyageId as a query parameter
            window.location.href = 'deleteVoyage.php?id_voy=' + voyageId;
        });

        document.getElementById('cancelDelete').addEventListener('click', function() {
            // Hide the confirmation pop-up
            document.getElementById('deleteConfirmation').style.display = 'none';
        });
    }

    // Event listener for delete buttons
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const voyageId = this.getAttribute('data-id');
                // Call function to confirm deletion
                confirmDeleteVoyage(voyageId);
            });
        });
    });
</script>
                  <!--------------------------------------------------------------------------------->
                                            <!-- Update Voyage  -->
                  <!--------------------------------------------------------------------------------->    
  <script>
  // Function to open the update pop-up with current voyage information
function openUpdatePopup(voyageId, titre, idDes, dateDebut, dateFin, prix, description, motivation, moyenTransport) {
    document.getElementById('updateIdVoy').value = voyageId;
    document.getElementById('updateTitre').value = titre;
    document.getElementById('updateDes').value = idDes;
    document.getElementById('updateDateDebut').value = dateDebut;
    document.getElementById('updateDateFin').value = dateFin;
    document.getElementById('updatePrix').value = prix;
    document.getElementById('updateDescription').value = description;
    document.getElementById('updateMotivation').value = motivation;
    document.getElementById('updateMoyenTransport').value = moyenTransport;
    document.getElementById('updatePopup').style.display = 'block';
}
function closeUpdatePopup() {
    document.getElementById('updatePopup').style.display = 'none';
}

// Event listener for update buttons
document.addEventListener('DOMContentLoaded', function() {
    const updateButtons = document.querySelectorAll('.btn-update');
    updateButtons.forEach(button => {
        button.addEventListener('click', function() {
            const voyageId = this.getAttribute('data-id');
            const titre = this.getAttribute('data-titre');
            const idDes = this.getAttribute('data-id_des');
            const dateDebut = this.getAttribute('data-date_debut');
            const dateFin = this.getAttribute('data-date_fin');
            const prix = this.getAttribute('data-prix');
            const description = this.getAttribute('data-description');
            const motivation = this.getAttribute('data-motivation');
            const moyenTransport = this.getAttribute('data-moyen_transport');

            openUpdatePopup(voyageId, titre, idDes, dateDebut, dateFin, prix, description, motivation, moyenTransport);
        });
    });

});
const updateForm = document.getElementById('updateForm');
updateForm.addEventListener('submit', function(event) {
    // Reset error messages
    document.getElementById('updateTitreError').textContent = '';
    document.getElementById('updateDesError').textContent = '';
    document.getElementById('updateDateDebutError').textContent = '';
    document.getElementById('updateDateFinError').textContent = '';
    document.getElementById('updatePrixError').textContent = '';
    document.getElementById('updateDescriptionError').textContent = '';
    document.getElementById('updateMotivationError').textContent = '';
    document.getElementById('updateMoyenTransportError').textContent = '';

    // Validate form inputs
    const titre = document.getElementById('updateTitre').value;
    const idDes = document.getElementById('updateDes').value;
    const dateDebut = document.getElementById('updateDateDebut').value;
    const dateFin = document.getElementById('updateDateFin').value;
    const prix = document.getElementById('updatePrix').value;
    const description = document.getElementById('updateDescription').value;
    const motivation = document.getElementById('updateMotivation').value;
    const moyenTransport = document.getElementById('updateMoyenTransport').value;

    // Validation for titre (not empty and doesn't contain numbers)
    if (titre.trim() === '') {
        event.preventDefault();
        document.getElementById('updateTitreError').textContent = 'Title is required';
    } else if (/^\d+$/.test(titre)) {
        event.preventDefault();
        document.getElementById('updateTitreError').textContent = 'Title cannot contain numbers';
    }

    // Validation for idDes (not empty, maximum 4 numbers, no letters)
    if (idDes.trim() === '') {
        event.preventDefault();
        document.getElementById('updateDesError').textContent = 'Destination ID is required';
    } else if (!/^\d{1,4}$/.test(idDes)) {
        event.preventDefault();
        document.getElementById('updateDesError').textContent = 'Destination ID must be maximum 4 digits';
    }

    // Validation for dateDebut (must be superior to today's date)
    const today = new Date();
    const selectedDateDebut = new Date(dateDebut);
    if (selectedDateDebut <= today) {
        event.preventDefault();
        document.getElementById('updateDateDebutError').textContent = 'Start date must be superior to today';
    }

    // Validation for dateFin (must be superior to dateDebut)
    const selectedDateFin = new Date(dateFin);
    if (selectedDateFin <= selectedDateDebut) {
        event.preventDefault();
        document.getElementById('updateDateFinError').textContent = 'End date must be superior to start date';
    }

    // Validation for prix (not empty, only numbers, maximum 5 digits)
    if (prix.trim() === '') {
        event.preventDefault();
        document.getElementById('updatePrixError').textContent = 'Price is required';
    } else if (!/^\d{1,5}(\.\d{1,2})?$/.test(prix)) {
        event.preventDefault();
        document.getElementById('updatePrixError').textContent = 'Invalid price format';
    }

    // Validation for description (not empty)
    if (description.trim() === '') {
        event.preventDefault();
        document.getElementById('updateDescriptionError').textContent = 'Description is required';
    }

    // No need for validation on motivation and moyenTransport since they are dropdowns
});


</script>
                  <!--------------------------------------------------------------------------------->
                                            <!-- ADD Voyage  -->
                  <!--------------------------------------------------------------------------------->    
<script>
  function closeAddPopup() {
    document.getElementById('addVoyagePopup').style.display = 'none';
}
    document.addEventListener('DOMContentLoaded', function() {
        const addVoyageBtn = document.getElementById('addVoyageBtn');
        const addVoyagePopup = document.getElementById('addVoyagePopup');
        const addVoyageForm = document.getElementById('addVoyageForm');

        addVoyageBtn.addEventListener('click', function() {
            addVoyagePopup.style.display = 'block';
        });

        addVoyageForm.addEventListener('submit', function(event) {
            // Validate form inputs
            const idVoy = document.getElementById('idVoy').value;
            const titre = document.getElementById('titre').value;
            const idDes = document.getElementById('idDes').value;
            const dateDebut = new Date(document.getElementById('dateDebut').value);
            const dateFin = new Date(document.getElementById('dateFin').value);
            const prix = document.getElementById('prix').value;
            const description = document.getElementById('description').value;
            const motivation = document.getElementById('Motivation').value;
            const moyenTransport = document.getElementById('moyenTransport').value;

            // Reset error messages
            document.getElementById('idVoyError').textContent = '';
            document.getElementById('titreError').textContent = '';
            document.getElementById('idDesError').textContent = '';
            document.getElementById('dateDebutError').textContent = '';
            document.getElementById('dateFinError').textContent = '';
            document.getElementById('prixError').textContent = '';
            document.getElementById('descriptionError').textContent = '';
            document.getElementById('MotivationError').textContent = '';
            document.getElementById('moyenTransportError').textContent = '';

            // Check each input for validity
            const today = new Date();
            if (idVoy.trim() === '' || isNaN(idVoy) || idVoy.length > 4) {
                event.preventDefault();
                document.getElementById('idVoyError').textContent = 'ID Voyage must be a number with at most 4 digits';
            }

            if (titre.trim() === '' || /\d/.test(titre)) {
                event.preventDefault();
                document.getElementById('titreError').textContent = 'Title must not be empty and should not contain numbers';
            }

            if (idDes.trim() === '' || isNaN(idDes) || idDes.length > 4) {
                event.preventDefault();
                document.getElementById('idDesError').textContent = 'Destination ID must be a number with at most 4 digits';
            }

            if (dateDebut <= today) {
                event.preventDefault();
                document.getElementById('dateDebutError').textContent = 'Start date must be after today';
            }

            if (dateFin <= today) {
                event.preventDefault();
                document.getElementById('dateFinError').textContent = 'End date must be after today';
            }

            if (dateDebut >= dateFin) {
                event.preventDefault();
                document.getElementById('dateFinError').textContent = 'End date must be after start date';
            }

            if (isNaN(prix) || prix.trim() === '' || prix.length > 5) {
                event.preventDefault();
                document.getElementById('prixError').textContent = 'Price must be a number with at most 5 digits';
            }

            if (description.trim() === '') {
                event.preventDefault();
                document.getElementById('descriptionError').textContent = 'Description is required';
            }

            if (motivation.trim() === '') {
                event.preventDefault();
                document.getElementById('MotivationError').textContent = 'Motivation is required';
            }

            if (moyenTransport.trim() === '') {
                event.preventDefault();
                document.getElementById('moyenTransportError').textContent = 'Means of Transport is required';
            }
        });
    });
</script>
                    <!--------------------------------------------------------------------------------->
                    <!-- --------------------------Delete Destination-------------------------- -->
                    <!-------------------------------------------------------------------------------->
 <script>
    // Function to handle delete confirmation
    function confirmDeleteDestination(DestinationId) {
        // Show the confirmation pop-up
        document.getElementById('deleteConfirmation_Des').style.display = 'block';

        // Set event listeners for confirmation buttons
        document.getElementById('confirmDelete_Des').addEventListener('click', function() {
            // Redirect to deleteVoyage.php with DestinationId as a query parameter
            window.location.href = 'deleteDestination.php?id_des=' + DestinationId;
        });

        document.getElementById('cancelDelete_Des').addEventListener('click', function() {
            // Hide the confirmation pop-up
            document.getElementById('deleteConfirmation_Des').style.display = 'none';
        });
    }

    // Event listener for delete buttons
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons_des = document.querySelectorAll('.btn-delete-des');
        deleteButtons_des.forEach(button => {
            button.addEventListener('click', function() {
                const DestinationId = this.getAttribute('data-id-Des');
                // Call function to confirm deletion
                confirmDeleteDestination(DestinationId);
            });
        });
    });
</script>

                  <!--------------------------------------------------------------------------------->
                    <!-- --------------------------Update Destination-------------------------- -->
                    <!-------------------------------------------------------------------------------->
<script>
       // <!--start working on fonctionalities -->  
        // Function to open the update pop-up with current Destination information
function openUpdatePopup_DES(DestinationId, Town, Descriptions, GPS, Country, Langue, Category, Purpose, Climat) {
    document.getElementById('updateIdDes').value = DestinationId;
    document.getElementById('updateTown').value = Town;
    document.getElementById('updateDescriptions').value = Descriptions;
    document.getElementById('updateGPS').value = GPS;
    document.getElementById('updateCountry').value = Country;
    document.getElementById('updateLangue').value = Langue;
    document.getElementById('updateCategory').value = Category;
    document.getElementById('updatePurpose').value = Purpose;
    document.getElementById('updateClimat').value = Climat;
    document.getElementById('updatePopup_Des').style.display = 'block';
}
function closeUpdatePopup_Des() {
    document.getElementById('updatePopup_Des').style.display = 'none';
}
// Event listener for update buttons destination
document.addEventListener('DOMContentLoaded', function() {
    const updateButtons_Des = document.querySelectorAll('.btn-update-Des');
    updateButtons_Des.forEach(button => {
        button.addEventListener('click', function() {
            const DestinationId = this.getAttribute('data-id-Des');
            const Town = this.getAttribute('data-nom-ville');
            const Descriptions = this.getAttribute('data-description-detaillee');
            const GPS = this.getAttribute('data-coordonneesGPS');
            const Country = this.getAttribute('data-pays');
            const Langue = this.getAttribute('data-langueParlee');
            const Category = this.getAttribute('data-categorie');
            const Purpose = this.getAttribute('data-motivations');
            const Climat = this.getAttribute('data-climat');

            openUpdatePopup_DES(DestinationId, Town, Descriptions, GPS, Country, Langue, Category, Purpose, Climat);
        });
    });

});
const updateForm_Des = document.getElementById('updateForm_Des');
updateForm_DES.addEventListener('submit', function(event) {
    // Reset error messages
    document.getElementById('updateTownError').textContent = '';
    document.getElementById('updateDescriptionsError').textContent = '';
    document.getElementById('updateGPSError').textContent = '';
    document.getElementById('updateCountryError').textContent = '';
    document.getElementById('updateCategoryError').textContent = '';
    document.getElementById('updateLangueError').textContent = '';
    document.getElementById('updatePurposeError').textContent = '';
    document.getElementById('updateClimatError').textContent = ''; 
});

</script>   
         <!--------------------------------------------------------------------------------->
                                            <!-- ADD Destination-->
                  <!---------------------------------------------------------------------------------> 
 <script>
 function closeAddDestinationPopup() {
    document.getElementById('addDestinationPopup').style.display = 'none';
 }
 document.addEventListener('DOMContentLoaded', function() {
        const addDestinationBtn = document.getElementById('addDestinationBtn');
        const addDestinationPopup = document.getElementById('addDestinationPopup');
        const addDestinationForm = document.getElementById('addDestinationForm');

        addDestinationBtn.addEventListener('click', function() {
          addDestinationPopup.style.display = 'block';
        });

        addDestinationPopup.addEventListener('submit', function(event) {
            // Validate form inputs
            const idDes_Des = document.getElementById('idDes_Des').value;
            const Town = document.getElementById('Town').value;
            const Det_Description = document.getElementById('Det_Description').value;
            const GPS = new Date(document.getElementById('GPS').value);
            const Country = new Date(document.getElementById('Country').value);
            const Language = document.getElementById('Language').value;
            const Category = document.getElementById('Category').value;
            const Purpose = document.getElementById('Purpose').value;
            const Climat = document.getElementById('Climat').value;

            // Reset error messages
            document.getElementById('idDes_DesError').textContent = '';
            document.getElementById('TownError').textContent = '';
            document.getElementById('Det_DescriptionError').textContent = '';
            document.getElementById('GPSError').textContent = '';
            document.getElementById('CountryError').textContent = '';
            document.getElementById('LanguageError').textContent = '';
            document.getElementById('CategoryError').textContent = '';
            document.getElementById('PurposeError').textContent = '';
            document.getElementById('ClimatError').textContent = '';
            
        });
    });
</script>    

<!-- Div pour afficher la carte -->
    <div id="map"></div>
    <!-- ------------Search------------- -->
    <script>
      const searchInput = document.getElementById("search");
      const rows = document.querySelectorAll("tbody tr");
      console.log(rows);
      searchInput.addEventListener("keyup", function (event) {
        const q = event.target.value.toLowerCase();
        rows.forEach((row) => {
          row.querySelector("td").textContent.toLowerCase().startsWith(q)
            ? (row.style.display = "table-row")
            : (row.style.display = "none");
        });
      });
    </script>
<!-- ------------TRI------------- -->
<script>
  th = document.getElementsByTagName('th');

for(let c=0; c < th.length; c++){

    th[c].addEventListener('click',item(c))
}


function item(c){

    return function(){
      console.log(c)
      sortTable(c)
    }
}


function sortTable(c) {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("tableVoyage");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[c];
      y = rows[i + 1].getElementsByTagName("TD")[c];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}
</script>
<script>
        function exportToPDF() {
            // Create new jsPDF instance
            const doc = new jsPDF();

            // Extract data from the HTML table
            const table = document.getElementById('tableVoyage');
            const rows = table.querySelectorAll('tr');
            const columns = ['ID_Voy', 'Titre', 'ID_Des', 'Date_Debut', 'Date_fin', 'Prix', 'Description','Motivation','Moyen_transport'];

            // Prepare data for PDF
            const data = [];
            rows.forEach((row) => {
                const rowData = [];
                row.querySelectorAll('td').forEach((cell) => {
                    rowData.push(cell.textContent.trim());
                });
                data.push(rowData);
            });

            // Add the table to the PDF
            doc.autoTable({
                head: [columns],
                body: data,
            });

            // Save the PDF
            doc.save('C:/Applications/XAMPP/xamppfiles/htdocs/TravisaWeam11/voyage_table.pdf');
        }
    </script>
    <script>
  // Parse travel statistics data from PHP to JavaScript
  var travelCountByDestination = <?php echo $travelCountByDestinationJSON; ?>;
  var avgTravelPriceByDestination = <?php echo $avgTravelPriceByDestinationJSON; ?>;
  var travelCountByTransport = <?php echo $travelCountByTransportJSON; ?>;
  var mostFrequentDurationByTransport = <?php echo $mostFrequentDurationByTransportJSON; ?>;

  // Function to create a bar chart
  function createBarChart(elementId, data) {
    var ctx = document.getElementById(elementId).getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: data
    });
  }

  // Function to create a pie chart
  function createPieChart(elementId, data) {
    var ctx = document.getElementById(elementId).getContext('2d');
    new Chart(ctx, {
      type: 'pie',
      data: data
    });
  }

  // Create charts
  createBarChart('travelCountChart', {
    labels: travelCountByDestination.map(row => row.id_des), // Assuming id_des is the identifier for destinations
    datasets: [{
      label: 'Travel Count by Destination',
      data: travelCountByDestination.map(row => row.travel_count),
      backgroundColor: 'rgba(54, 162, 235, 0.2)',
      borderColor: 'rgba(54, 162, 235, 1)',
      borderWidth: 1
    }]
  });

  createBarChart('avgTravelPriceChart', {
    labels: avgTravelPriceByDestination.map(row => row.id_des), // Assuming id_des is used for destinations again
    datasets: [{
      label: 'Average Travel Price by Destination',
      data: avgTravelPriceByDestination.map(row => row.avg_price),
      backgroundColor: 'rgba(255, 99, 132, 0.2)',
      borderColor: 'rgba(255, 99, 132, 1)',
      borderWidth: 1
    }]
  });

  createBarChart('travelCountByTransportChart', {
    labels: travelCountByTransport.map(row => row.moyen_transport),
    datasets: [{
      label: 'Travel Count by Transport Type',
      data: travelCountByTransport.map(row => row.travel_count),
      backgroundColor: 'rgba(255, 206, 86, 0.2)',
      borderColor: 'rgba(255, 206, 86, 1)',
      borderWidth: 1
    }]
  });
  createPieChart('mostFrequentDurationByTransport', {
  labels: travelCountByTransport.map(row => row.moyen_transport),
  datasets: [{
    label: 'Travel Count by Transport Type',
    data: travelCountByTransport.map(row => row.travel_count),
    backgroundColor: [
      'rgba(255, 99, 132, 0.5)', // Orange
      'rgba(54, 162, 235, 0.5)', // Blue
      'rgba(255, 206, 86, 0.5)', // Yellow
      'rgba(75, 192, 192, 0.5)', // Light blue
      'rgba(153, 102, 255, 0.5)', // Purple
      'rgba(255, 159, 64, 0.5)', // Orange red
      // Add more colors if you have more transport types
    ],
    borderColor: 'rgba(221, 221, 221, 1)', // Light gray border
    borderWidth: 1
  }]
});


  // Assuming mostFrequentDurationByTransport is an object, extract data
  var mostFrequentTransport = mostFrequentDurationByTransport.moyen_transport;
  var avgDuration = mostFrequentDurationByTransport.avg_duration;

  // Create a separate chart element (assuming you have one)
  var frequentTransportChart = document.getElementById('frequentTransportChart'); // Update with your element ID
  if (frequentTransportChart) {
    frequentTransportChart.innerHTML = `Most Frequent Transport: ${mostFrequentTransport} (Average Duration: ${avgDuration.toFixed(2)} days)`; // Display data as text
  } else {
    console.warn('Element with ID "frequentTransportChart" not found for displaying most frequent transport data.');
  }
</script>


</body>

</html>