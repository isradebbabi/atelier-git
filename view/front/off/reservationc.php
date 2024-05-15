<?php 
require '../../../config.php';


class reservationc {
  public function listReservations() {
    $sql = "SELECT * FROM reservation";
    $db = config::getConnexion();
    try {
      $query = $db->prepare($sql);
      $query->execute();
      $reservations = $query->fetchAll();
      
      return $reservations;
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
  }

  public function showReservationDetails($reservation) {
    $hebergementc = new hebergementc();
    $hebergement = $hebergementc->showHebergement($reservation['id_heb']);

    $formatted_details = ''; // Initialize the variable
    
    $formatted_details .= "<div class='details'>";
    $formatted_details .= "<h3>Hebergement Details:</h3>";
    $formatted_details .= "<label>Type:</label>";
    $formatted_details .= "<p>{$hebergement['type']}</p>";
    $formatted_details .= "<label>Description:</label>";
    $formatted_details .= "<p>{$hebergement['description']}</p>";
    $formatted_details .= "<label>Localisation:</label>";
    $formatted_details .= "<p>{$hebergement['localisation']}</p>";
    $formatted_details .= "<label>Categorie:</label>";
    $formatted_details .= "<p>{$hebergement['categorie']}</p>";
    $formatted_details .= "<label>Service:</label>";
    $formatted_details .= "<p>{$hebergement['service']}</p>";
    $formatted_details .= "</div>";

    $formatted_details .= "<div class='details'>";
    $formatted_details .= "<h3>Reservation Details:</h3>";
    $formatted_details .= "<label>User ID:</label>";
    $formatted_details .= "<p>{$reservation['id_user']}</p>";
    $formatted_details .= "<label>Hebergement ID:</label>";
    $formatted_details .= "<p>{$reservation['id_heb']}</p>";
    $formatted_details .= "<label>Voyage ID:</label>";
    $formatted_details .= "<p>{$reservation['id_voy']}</p>";
    $formatted_details .= "<label>Reservation Date:</label>";
    $formatted_details .= "<p>{$reservation['date_res']}</p>";
    $formatted_details .= "<label>Participation:</label>";
    $formatted_details .= "<p>{$reservation['participation']}</p>";
    $formatted_details .= "<label>Prix Total:</label>";
    $formatted_details .= "<p>{$reservation['prix']}</p>";
    $formatted_details .= "<label>Status:</label>";
    $formatted_details .= "<p>{$reservation['statu']}</p>";
    $formatted_details .= "<label>Payment Method:</label>";
    $formatted_details .= "<p>{$reservation['pay_meth']}</p>";
    $formatted_details .= "</div>";

    return $formatted_details;
}


  public function Search($searchQuery)
{
    $sql = "SELECT * FROM reservation WHERE id_res LIKE :searchQuery";
    $db = config::getConnexion();

    try {
        $query = $db->prepare($sql);
        $query->execute(['searchQuery' => "%$searchQuery%"]); 
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (Exception $e) {
        throw new Exception('Error searching genre: ' . $e->getMessage());
    }
}

public function tri($a) {
    $sql = "SELECT reservation.id_res, reservation.id_user, reservation.id_heb, reservation.id_voy,reservation.date_res,reservation.participation,reservation.prix,reservation.statu,reservation.pay_meth
            FROM reservation
            INNER JOIN hebergement ON reservation.id_heb = hebergement.id_heb 
            ORDER BY id_res " . $a;

    $db = config::getConnexion();
    try {
        $liste = $db->query($sql);
        return $liste;
    } catch (Exception $e) {
        die('Erreur: ' . $e->getMessage());
    }
}


public function getStatistics()
{
    $sql = "SELECT hebergement.nom as hebergement_name, COUNT(reservation.id_res) as reservation_count
            FROM reservation
            INNER JOIN hebergement ON reservation.id_heb = hebergement.id_heb 
            GROUP BY hebergement.id_heb";

    $db = config::getConnexion();

    try {
        $query = $db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (Exception $e) {
        throw new Exception('Error getting statistics: ' . $e->getMessage());
    }
}



function afficherpage($page_first_result,$results_per_page)
{
    $requete = "SELECT reservation.id_res, reservation.id_user, reservation.id_heb, reservation.id_voy,reservation.date_res,reservation.participation,reservation.prix,reservation.statu,reservation.pay_meth
    FROM reservation
    INNER JOIN hebergement ON reservation.id_heb = hebergement.id_heb LIMIT ".$page_first_result.','.$results_per_page; 
    $config = config::getConnexion();
    try {
        $querry = $config->prepare($requete);
        $querry->execute();
        $result = $querry->fetchAll();
        return $result ;
    } catch (PDOException $th) {
         $th->getMessage();
    }
}

function getAllReservation()
{
    $requete = "SELECT * FROM reservation ";
    $config = config::getConnexion();
    try {
        $querry = $config->prepare($requete);
        $querry->execute();
        $result = $querry->fetchAll();
        return $result ;
    } catch (PDOException $th) {
         $th->getMessage();
    }
}


  function showReservation($id_res) {
    $sql = "SELECT * FROM reservation WHERE `id_res` = :id_res";
    $db = Config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([
          ':id_res' => $id_res,
        ]);
        
        $reservation = $query->fetch();
        return $reservation;
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
  }

  function addReservation($reservation) {
    $sql = "INSERT INTO reservation(id_res, id_user, id_heb, id_voy,date_res,participation,prix,statu,pay_meth) 
    VALUES (:id_res, :id_user, :id_heb,:id_voy,:date_res, :participation, :prix,:statu,:pay_meth)";
$db = config::getConnexion();
try {
$query = $db->prepare($sql);
$query->execute([
':id_res' => $reservation->getIdReservation(),
':id_user' => $reservation->getIdUser(),
':id_heb' => $reservation->getIdHeb(),
':id_voy' => $reservation->getIdVoy(),
':date_res' => $reservation->getDateReserv(),
':participation' => $reservation->getNbParticipation(),
':prix' => $reservation->getPrixTot(),
'statu' => $reservation->getStatus(),
'pay_meth' => $reservation->getPayMethode(),
]);
} catch (Exception $e) {
echo 'Error: ' . $e->getMessage();
};
  }
    
  public function updateReservation($reservation, $id_res)
{
    $db = Config::getConnexion();
    try {
        $query = $db->prepare(
            "UPDATE reservation
             SET
              id_user = :id_user,
              id_heb = :id_heb,
              id_voy = :id_voy,
              date_res = :date_res,
              participation = :participation,
              prix = :prix,
              statu = :statu,
              pay_meth = :pay_meth
             WHERE id_res = :id_res"
        );

        $query->execute([
            ':id_user' => $reservation->getIdUser(),
            ':id_heb' => $reservation->getIdHeb(),
            ':id_voy' => $reservation->getIdVoy(),
            ':date_res' => $reservation->getDateReserv(),
            ':participation' => $reservation->getNbParticipation(),
            ':prix' => $reservation->getPrixTot(),
            ':statu' => $reservation->getStatus(),
            ':pay_meth' => $reservation->getPayMethode(),
            ':id_res' => $id_res
        ]);

        return $query->rowCount(); // Return the number of rows affected
    } catch (PDOException $e) {
        throw $e;
    }
}

  function deleteReservation($id) {
    $sql = "DELETE FROM reservation WHERE `id_res` = :id";
    $db = config::getConnexion();

    try {
      $req = $db->prepare($sql);
      $req->bindValue(':id', $id);
      $req->execute();
    } catch (PDOException $e) {
        die('Error:' . $e->getMessage());
    }
  }
}


  

?>
