<?php
include '../../controller/reservationc.php';
include '../../controller/hebergementc.php';
include '../../model/reservation.php';
include '../../model/hebergement.php';
$c = new reservationc();
$hebergementc = new hebergementc();
$a = new hebergementc();
$tab = $a->listHebergement();
$statistics = $c->getStatistics();

// Calculate total reservations
$totalReservations = 0;
foreach ($statistics as $stat) {
    $totalReservations += $stat['reservation_count'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['search'])) {
        $searchQuery = $_POST['searchQuery'];
        $searchResult = $c->Search($searchQuery);
    } else if (isset($_POST['applySort'])) {
        $sortOrder = $_POST['sort'];
        $tab = $c->tri($sortOrder);
    }
} else {
    $tab = $c->listReservations();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.10.0/main.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.10.0/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.10.0/main.js"></script>

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
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="./assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside
    class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html "
        target="_blank">
        <img src="./assets/img/Travisa/LogoTravisa.png" class="navbar-brand-img h-100" alt="main_logo" width="50" height="50">
        <span class="ms-1 font-weight-bold">TraVisa</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="./pages/dashboard.html">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./pages/tables.html">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Tables</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./pages/billing.html">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Billing</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./pages/virtual-reality.html">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Virtual Reality</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./pages/rtl.html">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
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
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./pages/sign-in.html">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Sign In</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./pages/sign-up.html">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
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
<!-- Accommodation -->

<div class="row mt-4">
    <div class="table-responsive">
        <div class="container ">
            <h1>Accommodation Management</h1>
            <table class="table">
                <thead>
                    <tr class="w-30">
                        <div class="d-flex px-2 py-1 align-items-center">
                            <div class="ms-4">
                                <h6>
                                    <th class="text-xs font-weight-bold mb-0" scope="col">ID</th>
                                    <th class="text-xs font-weight-bold mb-0" scope="col">NAME</th>
                                    <th class="text-xs font-weight-bold mb-0" scope="col">TYPE ID</th>
                                    <th class="text-xs font-weight-bold mb-0" scope="col">description</th>
                                    <th class="text-xs font-weight-bold mb-0" scope="col">localisation</th>
                                    <th class="text-xs font-weight-bold mb-0" scope="col">categorie</th>
                                    <th class="text-xs font-weight-bold mb-0" scope="col">service</th>
                                    <th class="text-xs font-weight-bold mb-0" scope="col">Actions</th>
                                </h6>
                            </div>
                        </div>
                    </tr>
                </thead>
                <tbody>
                    <div class="d-flex px-2 py-1 align-items-center">
                        <div class="ms-4">
                            <?php
                            $limit = 5;
                            $query = "SELECT count(*) FROM hebergement";
                            $db = Config::getConnexion();
                            $s = $db->query($query);
                            $total_results = $s->fetchColumn();
                            $total_pages = ceil($total_results / $limit);

                            if (!isset($_GET['page'])) {
                                $page = 1;
                            } else {
                                $page = $_GET['page'];
                            }

                            $starting_limit = ($page - 1) * $limit;

                            $sort_field = isset($_GET['sort_field']) ? $_GET['sort_field'] : 'nom';
                            $sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'asc';

                            $search_service = isset($_GET['search_service']) ? $_GET['search_service'] : '';

                            if (!empty($search_service)) {
                                $show = "SELECT * FROM hebergement WHERE service LIKE :search_service ORDER BY $sort_field $sort_order LIMIT :limit OFFSET :offset";
                                $r = $db->prepare($show);
                                $r->bindValue(':search_service', '%' . $search_service . '%', PDO::PARAM_STR);
                            } else {
                                $show = "SELECT * FROM hebergement ORDER BY $sort_field $sort_order LIMIT :limit OFFSET :offset";
                                $r = $db->prepare($show);
                            }

                            $r->bindParam(':limit', $limit, PDO::PARAM_INT);
                            $r->bindParam(':offset', $starting_limit, PDO::PARAM_INT);
                            $r->execute();
                            ?>
                        </div>
                    </div>
                    <form method="GET">
                        <div class="form-group">
                            <input type="text" class="form-control" name="search_service" placeholder="Rechercher par service" value="<?php echo $search_service; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Rechercher</button>
                        <select name="sort_field" class="form-control d-inline-block w-auto">
                            <option value="nom" <?php echo ($sort_field == 'nom') ? 'selected' : ''; ?>>Trier par nom</option>
                            <option value="id_heb" <?php echo ($sort_field == 'id_heb') ? 'selected' : ''; ?>>Trier par ID</option>
                        </select>
                        <select name="sort_order" class="form-control d-inline-block w-auto">
                            <option value="asc" <?php echo ($sort_order == 'asc') ? 'selected' : ''; ?>>Ascendant</option>
                            <option value="desc" <?php echo ($sort_order == 'desc') ? 'selected' : ''; ?>>Descendant</option>
                        </select>
                        <button type="submit" class="btn btn-secondary">Appliquer le tri</button>
                    </form>

                    <?php
                    while ($res = $r->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>
                            <td>' . $res['id_heb'] . '</td>
                            <td>' . $res['nom'] . '</td>
                            <td>' . $res['type'] . '</td>
                            <td>' . $res['description'] . '</td>
                            <td>' . $res['localisation'] . '</td>
                            <td>' . $res['categorie'] . '</td>
                            <td>' . $res['service'] . '</td>
                            <td>
                                <button class="btn btn-primary" onclick="openUpdatePopup(' . $res['id_heb'] . ')">Update</button>
                                <button class="btn btn-danger"><a href="delete.php?deleteid=' . $res['id_heb'] . '" class="text-light">Delete</a></button>
                            </td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>

<!-- Pop-up for update HEBERGEMNT -->
<div id="updatePopup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closeUpdatePopup()">&times;</span>
        <h2>Update Accommodation</h2>
        <!-- Form for updating accommodation data -->
        <form id="updateForm" action="updateHebergement.php" method="POST">
            <!-- Nom -->
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom">

            <div id="nom" class="error-msg"></div>
            <!-- Type -->
            <label for="type">Type:</label>
            <input type="text" id="type" name="type">

            <div id="type" class="error-msg"></div>
            <!-- Description -->
            <label for="description">Description:</label>
            <input type="text" id="description" name="description">

            <div id="description" class="error-msg"></div>
            <!-- Localisation -->
            <label for="localisation">Localisation:</label>
            <input type="text" id="localisation" name="localisation">

            <div id="localisation" class="error-msg"></div>
            <!-- Categorie -->
            <label for="categorie">Catégorie:</label>
            <input type="text" id="categorie" name="categorie">

            <div id="categorie" class="error-msg"></div>
            <!-- Service -->
            <label for="service">Service:</label>
            <input type="text" id="service" name="service">
            
            <div id="service" class="error-msg"></div>
<button type="submit">Confirm Update</button>
</form>
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
<script>
    function openUpdatePopup(id) {
        // Fetch data for the accommodation with the given id and populate the form fields
        // You can use AJAX to fetch data from the server and populate the form fields dynamically
        // For now, let's assume the data is available in a JavaScript object
        var hebergement = {
            nom: "Sample Name",
            type: "Sample Type",
            description: "Sample Description",
            localisation: "Sample Localisation",
            categorie: "Sample Categorie",
            service: "Sample Service"
        };

        document.getElementById('nom').value = hebergement.nom;
        document.getElementById('type').value = hebergement.type;
        document.getElementById('description').value = hebergement.description;
        document.getElementById('localisation').value = hebergement.localisation;
        document.getElementById('categorie').value = hebergement.categorie;
        document.getElementById('service').value = hebergement.service;

        // Display the pop-up in the center of the screen
        var popup = document.getElementById('updatePopup');
        popup.style.display = 'block';
        popup.style.top = '50%';
        popup.style.left = '50%';
        popup.style.transform = 'translate(-50%, -50%)';
    }

    function closeUpdatePopup() {
    // Close the pop-up with a fade-out effect and scaling down
    var popup = document.getElementById('updatePopup');
    popup.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
    popup.style.opacity = '0';
    popup.style.transform = 'scale(0.8)';

    // Hide the pop-up after the transition completes
    setTimeout(function() {
        popup.style.display = 'none';
    }, 300); // 300 milliseconds is the duration of the transition

    // Refresh the page after the pop-up is closed
    setTimeout(function() {
        location.reload();
    }, 500); // Wait for 500 milliseconds before refreshing the page
}


</script>



<div class="d-flex justify-content-center mt-4">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>&sort_field=<?php echo $sort_field; ?>&sort_order=<?php echo $sort_order; ?>&search_service=<?php echo $search_service; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </nav>
</div>

</div>
</div>
</div>

<div class="row mt-4">
        <div class="table-responsive">
<div class="container ">
    <h1>Reservation Management</h1>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<div class="form-group">
    <input type="text" class="form-control" name="searchQuery" placeholder="Search">
</div>
<button type="submit" name="search" class="btn btn-primary">Search</button>
<select name="sort" class="form-control d-inline-block w-auto">
    <option value="asc">Sort by ID (Ascending)</option>
    <option value="desc">Sort by ID (Descending)</option>
</select>
<button type="submit" name="applySort" class="btn btn-secondary">Apply Sort</button>
<button type="button" name="calender" class="btn btn-primary" onclick="window.location.href='calender.php'">Calendar</button>
</form>

<script>
// Add your JavaScript code here
document.querySelector('button[name="calender"]').addEventListener('click', function() {
    window.location.href = 'calender.php';
});
</script>


    <table class="table">
        <thead>
            <tr class="w-30">
            <div class="d-flex px-2 py-1 align-items-center">
            <div class="ms-4">
<h6>
                <th class="text-xs font-weight-bold mb-0" scope="col">ID</th>
                <th class="text-xs font-weight-bold mb-0" scope="col">User ID</th>
                <th class="text-xs font-weight-bold mb-0" scope="col">Accommodation ID</th>
                <th class="text-xs font-weight-bold mb-0" scope="col">Trip ID</th>
                <th class="text-xs font-weight-bold mb-0" scope="col">Date</th>
                <th class="text-xs font-weight-bold mb-0" scope="col">Participation</th>
                <th class="text-xs font-weight-bold mb-0" scope="col">Price</th>
                <th class="text-xs font-weight-bold mb-0" scope="col">Status</th>
                <th class="text-xs font-weight-bold mb-0" scope="col">Payment Method</th>
                <th class="text-xs font-weight-bold mb-0" scope="col">Actions</th>
                </h6>
                </div>
                    </div>

            </tr>
        </thead>
        <tbody>
            <?php
            $limit = 5;
            $query = "SELECT count(*) FROM reservation";
            $db = Config::getConnexion();
            $s = $db->query($query);
            $total_results = $s->fetchColumn();
            $total_pages = ceil($total_results / $limit);

            if (!isset($_GET['page'])) {
                $page = 1;
            } else {
                $page = $_GET['page'];
            }

            $starting_limit = ($page - 1) * $limit;
            $show = "SELECT * FROM reservation ORDER BY id_res ASC LIMIT :limit OFFSET :offset";

            $r = $db->prepare($show);
            $r->bindParam(':limit', $limit, PDO::PARAM_INT);
            $r->bindParam(':offset', $starting_limit, PDO::PARAM_INT);
            $r->execute();

            while ($res = $r->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>
                <h6> <td>' . $res['id_res'] . '</td>
                    <td>' . $res['id_user'] . '</td>
                    <td>' . $res['id_heb'] . '</td>
                    <td>' . $res['id_voy'] . '</td>
                    <td>' . $res['date_res'] . '</td>
                    <td>' . $res['participation'] . '</td>
                    <td>' . $res['prix'] . '</td>
                    <td>' . $res['statu'] . '</td>
                    <td>' . $res['pay_meth'] . '</td>
                    <td>
                    <button type="button" class="btn btn-primary" onclick="openUpdatePopup(' . $res['id_res'] . ')">Update</button>
                        <a href="deletereservation.php?deleteid=' . $res['id_res'] . '" class="btn btn-danger">Delete</a>
                    </td> </h6>
                </tr>';
            }
            ?>
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>&sort_field=<?php echo $sort_field; ?>&sort_order=<?php echo $sort_order; ?>&search_service=<?php echo $search_service; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </nav>
</div>
</div>
</div>

                    <!-- Pop-up for update RESERVATION -->
<div id="updatePopup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closeUpdatePopup()">&times;</span>
        <h2>Update Reservation</h2>
        <!-- Form for updating reservation data -->
        <form id="updateForm" action="updateReservation.php" method="POST">
            <!-- ID -->
            <input type="hidden" id="id_res" name="id_res">
            <!-- User ID -->
            <input type="hidden" id="id_user" name="id_user">
            <!-- Accommodation ID -->
            <input type="hidden" id="id_heb" name="id_heb">
            <!-- Voyage ID -->
            <input type="hidden" id="id_voy" name="id_voy">
            <!-- Date -->
            <label for="date_res">Date:</label>
            <input type="date" id="date_res" name="date_res">

            <div id="date_res" class="error-msg"></div>
            <!-- Participation -->
            <label for="participation">Participation:</label>
            <input type="number" id="participation" name="participation">

            <div id="participation" class="error-msg"></div>
            <!-- Prix -->
            <label for="prix">Prix:</label>
            <input type="number" id="prix" name="prix">

            <div id="prix" class="error-msg"></div>
            <!-- Status -->
            <label for="status">Status:</label>
            <input type="text" id="status" name="status">

            <div id="status" class="error-msg"></div>
            <!-- Payment Method -->
            <label for="pay_meth">Payment Method:</label>
            <input type="text" id="pay_meth" name="pay_meth">
            
            <div id="pay_meth" class="error-msg"></div>
            <button type="submit">Confirm Update</button>
        </form>
    </div>
</div>

<script>
    function openUpdatePopup(id) {
        // Fetch data for the reservation with the given id and populate the form fields
        // You can use AJAX to fetch data from the server and populate the form fields dynamically
        // For now, let's assume the data is available in a JavaScript object
        var reservation = {
            id_res: "Sample ID",
            id_user: "Sample User ID",
            id_heb: "Sample Accommodation ID",
            id_voy: "Sample Voyage ID",
            date_res: "2024-05-12", // Sample date
            participation: 2, // Sample participation
            prix: 100, // Sample price
            status: "Sample Status",
            pay_meth: "Sample Payment Method"
        };

        document.getElementById('id_res').value = reservation.id_res;
        document.getElementById('id_user').value = reservation.id_user;
        document.getElementById('id_heb').value = reservation.id_heb;
        document.getElementById('id_voy').value = reservation.id_voy;
        document.getElementById('date_res').value = reservation.date_res;
        document.getElementById('participation').value = reservation.participation;
        document.getElementById('prix').value = reservation.prix;
        document.getElementById('status').value = reservation.status;
        document.getElementById('pay_meth').value = reservation.pay_meth;

        // Display the pop-up in the center of the screen
        var popup = document.getElementById('updatePopup');
        popup.style.display = 'block';
        popup.style.top = '50%';
        popup.style.left = '50%';
        popup.style.transform = 'translate(-50%, -50%)';
    }

    function closeUpdatePopup() {
        // Close the pop-up with a fade-out effect and scaling down
        var popup = document.getElementById('updatePopup');
        popup.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
        popup.style.opacity = '0';
        popup.style.transform = 'scale(0.8)';

        // Hide the pop-up after the transition completes
        setTimeout(function() {
            popup.style.display = 'none';
        }, 300); // 300 milliseconds is the duration of the transition

        // Refresh the page after the pop-up is closed
        setTimeout(function() {
            location.reload();
        }, 500); // Wait for 500 milliseconds before refreshing the page
    }
</script>


<div class="d-flex px-2 py-1 align-items-center">
    <div class="col-lg-7 mb-lg-0 mb-4">
        <div class="card z-index-2">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h2>Reservation Statistics</h2>
            </div>
            <div class="card-body">
                <div class="statistics-table">
                    <p>Total Reservations: <?php echo $totalReservations; ?></p>
                    <h4>Accommodation Statistics</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Accommodation Name</th>
                                <th>Reservations</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($statistics as $stat): ?>
                                <tr>
                                    <td><?php echo $stat['hebergement_name']; ?></td>
                                    <td><?php echo $stat['reservation_count']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
    <div class="chart-visualization" style="text-align: center;">
        <svg width="80%" height="300">
            <!-- Background Circle -->
            <circle cx="250" cy="150" r="130" fill="none" stroke="#f3f3f3" stroke-width="10"></circle>

            <?php
            $startAngle = -90; // Start angle for the first segment

            // Loop through statistics data to generate segments
            foreach ($statistics as $stat) {
                $accommodationName = $stat['hebergement_name'];
                $reservationCount = $stat['reservation_count'];
                $segmentPercentage = round(($reservationCount / $totalReservations) * 100);
                $endAngle = $startAngle + (3.6 * $segmentPercentage); // Calculate the end angle of the segment

                // Determine segment color based on percentage
                $segmentColor = "#4caf50"; // Default color is green
                if ($segmentPercentage < 50) {
                    $segmentColor = "#ff9800"; // Orange for less than 50%
                }
                if ($segmentPercentage < 25) {
                    $segmentColor = "#f44336"; // Red for less than 25%
                }

                // Calculate coordinates for the arc
                $startX = 250 + 130 * cos(deg2rad($startAngle));
                $startY = 150 + 130 * sin(deg2rad($startAngle));
                $endX = 250 + 130 * cos(deg2rad($endAngle));
                $endY = 150 + 130 * sin(deg2rad($endAngle));
                $largeArcFlag = $segmentPercentage > 50 ? 1 : 0;

                // Draw the segment
                echo "<path d='M250,150 L$startX,$startY A130,130 0 $largeArcFlag,1 $endX,$endY Z' fill='$segmentColor'></path>";

                // Add text inside the segment
                $textAngle = $startAngle + ($endAngle - $startAngle) / 2; // Calculate the angle for placing text
                $textX = 250 + 100 * cos(deg2rad($textAngle));
                $textY = 150 + 100 * sin(deg2rad($textAngle));
                echo "<text x='$textX' y='$textY' text-anchor='middle' fill='#ffffff'>$accommodationName</text>";

                // Add reservation count and percentage outside the circle
                $textXOutside = 250 + 140 * cos(deg2rad($textAngle));
                $textYOutside = 150 + 140 * sin(deg2rad($textAngle));
                echo "<text x='$textXOutside' y='$textYOutside' text-anchor='middle' fill='#000000'>$reservationCount ($segmentPercentage%)</text>";

                $startAngle = $endAngle; // Update start angle for the next segment
            }
            ?>
        </svg>
    </div>
</div>




      <footer class="footer pt-3  ">
        
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
      </div>
    </div>
  </div>
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
</body>

</html>