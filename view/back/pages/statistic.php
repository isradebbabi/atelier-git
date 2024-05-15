<?php
include '../../model/reservation.php';
include '../../controller/reservationc.php';
include '../../model/hebergement.php';
include '../../controller/hebergementc.php';

$c = new reservationc();
$hebergementc = new hebergementc();
$statistics = $c->getStatistics();

// Calculate total reservations
$totalReservations = 0;
foreach ($statistics as $stat) {
    $totalReservations += $stat['reservation_count'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reservation Statistics</title>
    <style>
        .statistics-container {
            display: flex;
            align-items: flex-start;
        }

        .statistics-table {
            flex: 1;
            margin-right: 20px;
        }

        .chart-container {
            width: 100px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }

        .chart {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 4px solid #f3f3f3;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 12px;
            margin-top: 20px;
        }

        .chart span {
            position: absolute;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <h1>Reservation Statistics</h1>
    <div class="statistics-container">
        <div class="statistics-table">
            <?php
            echo "<p>Total Reservations: $totalReservations</p>";

            echo "<h2>Accommodation Statistics</h2>";
            echo "<table>";
            echo "<tr>
                  <th>Accommodation Name</th>
                  <th>Reservations</th>
                  </tr>";
            foreach ($statistics as $stat) {
                echo "<tr>
                      <td>{$stat['hebergement_name']}</td>
                      <td>{$stat['reservation_count']}</td>
                      </tr>";
            }
            echo "</table>";
            ?>
        </div>

        <div class="chart-container">
            <div class="chart">
                <?php
                $percentage = ($totalReservations > 0) ? round(($statistics[0]['reservation_count'] / $totalReservations) * 100) : 0;
                $circleColor = "#ff0000";
                $circleText = $percentage . "%";
                ?>
                <span><?php echo $circleText; ?></span>
                <svg width="100" height="100">
                    <circle cx="50" cy="50" r="40" fill="none" stroke="#f3f3f3" stroke-width="4"></circle>
                    <circle cx="50" cy="50" r="40" fill="none" stroke="<?php echo $circleColor; ?>"
                            stroke-width="4" stroke-dasharray="<?php echo $percentage * 2.5; ?> 250"></circle>
                </svg>
            </div>
        </div>
    </div>
</body>

</html>