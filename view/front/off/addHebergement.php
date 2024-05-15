<?php
include 'hebergementc.php';
$c = new hebergementc();
$hebergementc = new hebergementc();
$tab = $c->listHebergement();

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $nom = $_POST['nom'];
        $type = $_POST['type'];
        $description = $_POST['description'];
        $localisation = $_POST['localisation'];
        $categorie = $_POST['categorie'];
        $service = $_POST['service'];

        // Proceed with insertion into the database
        $sql = "INSERT INTO `hebergement` (nom, type, description, localisation, categorie, service) VALUES ('$nom', '$type', '$description', '$localisation', '$categorie', '$service')";
        $pdo = Config::getConnexion();
        $stmt = $pdo->query($sql);
        $stmt->execute();

        // Get the ID of the newly added hebergement
        $id_heb = $pdo->lastInsertId();

        // Set the session variables
        $_SESSION["id_heb"] = $id_heb;
        $_SESSION["notification_message"] = "Hebergement added successfully.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TraVisa - Travel Agency HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <script>
        function fetchNotificationMessage() {
            // Make an AJAX request to notification.php
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // When the request is successful, parse the response as JSON
                    var response = JSON.parse(this.responseText);
                    // Get the notification message from the response
                    var notificationMessage = response.notification_message;
                    // Call the showNotification function with the retrieved message
                    showNotification(notificationMessage);
                }
            };
            xhttp.open("GET", "notification.php", true);
            xhttp.send();
        }
    
        function showNotification(message) {
            var notification = document.getElementById("notification");
            var notificationMessage = document.querySelector(".notification-message");
            var notificationText = document.querySelector(".notification-text");
            notificationMessage.innerHTML = message;
            notification.style.display = "block";
            setTimeout(function() {
                notification.style.display = "none";
            }, 6000);
        }
    
        document.addEventListener("DOMContentLoaded", function() {
            // Fetch the notification message when the page is loaded
            fetchNotificationMessage();
        });
    </script>
    

</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-dark px-5 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <small class="me-3 text-light"><i class="fa fa-map-marker-alt me-2"></i>123 Street, New York, USA</small>
                    <small class="me-3 text-light"><i class="fa fa-phone-alt me-2"></i>+012 345 6789</small>
                    <small class="text-light"><i class="fa fa-envelope-open me-2"></i>info@example.com</small>
                </div>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-twitter fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-facebook-f fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-linkedin-in fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-instagram fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle" href=""><i class="fab fa-youtube fw-normal"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <h1 class="text-primary m-0"><i class="fa fa-map-marker-alt me-3"></i>TraVisa</h1>
                <!-- <img src="img/logo.png" alt="Logo"> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="index.html" class="nav-item nav-link">Home</a>
                    <a href="about.html" class="nav-item nav-link">About</a>
                    <a href="service.html" class="nav-item nav-link">Services</a>
                    <a href="package.html" class="nav-item nav-link">Packages</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0">
                            <a href="destination.html" class="dropdown-item">Destination</a>
                            <a href="booking.html" class="dropdown-item active">Accommodation</a>
                            <a href="team.html" class="dropdown-item">Travel Guides</a>
                            <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                            <a href="reservation.html" class="dropdown-item">Reservation</a>
                        </div>
                    </div>
                    <a href="contact.html" class="nav-item nav-link">Contact</a>
                </div>
                <a href="" class="btn btn-primary rounded-pill py-2 px-4">Register</a>
            </div>
        </nav>

        <div class="container-fluid bg-primary py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white animated slideInDown">Accommodation</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page">Accommodation</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->


    <!-- Process Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center pb-4 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Process</h6>
                <h1 class="mb-5">3 Easy Steps</h1>
            </div>
            <div class="row gy-5 gx-4 justify-content-center">
                <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative border border-primary pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                            <i class="fa fa-globe fa-3x text-white"></i>
                        </div>
                        <h5 class="mt-4">Choose A Destination</h5>
                        <hr class="w-25 mx-auto bg-primary mb-1">
                        <hr class="w-50 mx-auto bg-primary mt-0">
                        <p class="mb-0">Tempor erat elitr rebum clita dolor diam ipsum sit diam amet diam eos erat ipsum et lorem et sit sed stet lorem sit</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="position-relative border border-primary pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                            <i class="fa fa-dollar-sign fa-3x text-white"></i>
                        </div>
                        <h5 class="mt-4">Pay Online</h5>
                        <hr class="w-25 mx-auto bg-primary mb-1">
                        <hr class="w-50 mx-auto bg-primary mt-0">
                        <p class="mb-0">Tempor erat elitr rebum clita dolor diam ipsum sit diam amet diam eos erat ipsum et lorem et sit sed stet lorem sit</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="position-relative border border-primary pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                            <i class="fa fa-plane fa-3x text-white"></i>
                        </div>
                        <h5 class="mt-4">Fly Today</h5>
                        <hr class="w-25 mx-auto bg-primary mb-1">
                        <hr class="w-50 mx-auto bg-primary mt-0">
                        <p class="mb-0">Tempor erat elitr rebum clita dolor diam ipsum sit diam amet diam eos erat ipsum et lorem et sit sed stet lorem sit</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Process Start -->


    <!-- Booking Start -->
   <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="booking p-5">
            <div class="row g-5 align-items-center">
                <div class="col-md-6 text-white">
                    <h6 class="text-white text-uppercase">Accommodation</h6>
                    <h1 class="text-white mb-4">Online Accommodation</h1>
                    <p class="mb-4">Accommodation Management:</p>
                    <p class="mb-4">"Welcome to our accommodation management service! Whether you're a seasoned traveler or embarking on your first adventure, we're here to ensure your stay is nothing short of exceptional. Our diverse range of accommodations caters to every traveler's needs, from cozy bed and breakfasts to luxurious resorts with breathtaking views. With our intuitive booking system, finding the perfect accommodation for your trip is effortless. Explore our selection today and make your travel experience truly unforgettable!"</p>
                    <a class="btn btn-outline-light py-3 px-5 mt-2" href="reservation.html">Add Your Reservation</a>
                </div>
                <div class="col-md-6">
                    
                    <h1 class="text-white mb-4">Book Your Accommodation</h1>
                    <form class="main-form" method="post" enctype="multipart/form-data" action="addHebergement.php" onsubmit="return validateForm()">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control form-control-lg rounded-pill" "   placeholder="Entrez le nom de l'hébergement" type="text" name="nom" id="nom" required>
                                    <label for="nom" >Nom :</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                <label for="type" >Type:</label>
                <select class="form-control form-control-lg rounded-pill""  name="type" id="type" required>
                    <option value=""></option>
                    <option value="type A">type A</option>
                    <option value="type B">type B</option>
                    <option value="type C">type C</option>
                </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating date" id="date3" data-target-input="nearest">
                                <input class="form-control form-control-lg rounded-pill"  placeholder="Entrez la description de l'hébergement" type="text" name="description" id="description" required>
                                    <label for="description" >Description:</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                <label for="localisation" >Localisation:</label>
                <select name="localisation" id="localisation" class="form-control form-control-lg rounded-pill" required>
                    <option value=""> </option>
                    <option value="Location A">Location A</option>
                    <option value="Location B">Location B</option>
                    <option value="Location C">Location C</option>
                </select>
         </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                <label for="categorie" >Catégorie:</label>
                <select name="categorie" id="categorie" class="form-control form-control-lg rounded-pill" required>
                    <option value=""></option>
                    <option value="Catégorie A">Catégorie A</option>
                    <option value="Catégorie B">Catégorie B</option>
                    <option value="Catégorie C">Catégorie C</option>
                </select>
    </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                <label for="service" >Service:</label>
                <select name="service" id="service" class="form-control form-control-lg rounded-pill" required>
                    <option value=""></option>
                    <option value="Service A">Service A</option>
                    <option value="Service B">Service B</option>
                    <option value="Service C">Service C</option>
                </select>

    </div>
                            </div>

                    
</div>
                            
                            
<div class="col-12">
    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 py-3 mx-auto d-block" name="submit" onclick="handleFormSubmission()">Soumettre</button>
</div>

<script>
    function showNotification(message) {
        var notification = document.getElementById("notification");
        var notificationMessage = document.querySelector(".notification-message");
        var notificationText = document.querySelector(".notification-text");

        // Check if notification is already visible
        if (notification.style.display === "block") {
            return; // If already visible, do nothing
        }

        notificationMessage.innerHTML = message;
        notification.style.display = "block";
        setTimeout(function() {
            notification.style.display = "none";
        }, 3000);
    }

    function fetchNotificationMessage() {
        // Make an AJAX request to notification.php
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // When the request is successful, parse the response as JSON
                var response = JSON.parse(this.responseText);
                // Get the notification message from the response
                var notificationMessage = response.notification_message;
                // Call the showNotification function with the retrieved message
                showNotification(notificationMessage);
            }
        };
        xhttp.open("GET", "notification.php", true);
        xhttp.send();
    }

    function handleFormSubmission(event) {
        event.preventDefault(); // Prevent the default form submission behavior

        // You can perform any form submission logic here
        // For demonstration purposes, let's assume the form is submitted successfully
        // and then display the notification
        var message = "Form submitted successfully!";
        showNotification(message);
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Fetch the notification message when the page is loaded
        fetchNotificationMessage();

        // Add event listener to the form submission event
        var form = document.querySelector(".main-form");
        form.addEventListener("submit", handleFormSubmission);
    });
</script>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Booking Start -->


        

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Company</h4>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Privacy Policy</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">FAQs & Help</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Gallery</h4>
                    <div class="row g-2 pt-2">
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/package-1.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/package-2.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/package-3.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/package-2.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/package-3.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/package-1.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Newsletter</h4>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-primary w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.

                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="">Home</a>
                            <a href="">Cookies</a>
                            <a href="">Help</a>
                            <a href="">FQAs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

   
</body>

</html>