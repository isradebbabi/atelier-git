<?php
require_once '../config.php';

class voyageC{

        public function list_voyage(){
            $conn = config::getConnexion();
            try {
                $query = $conn->prepare("SELECT * FROM voyage");
                $query->execute();
                $result = $query->fetchAll();
                $tableHTML = '<table class="table" id="tableVoyage">';
        $tableHTML .= '<thead>';
        $tableHTML .= '<tr>';
        $tableHTML .= '<th>ID_Voy</th>';
        $tableHTML .= '<th>titre</th>';
        $tableHTML .= '<th>ID_Des</th>';
        $tableHTML .= '<th>Date_Debut</th>';
        $tableHTML .= '<th>Date_Fin</th>';
        $tableHTML .= '<th>Prix</th>';
        $tableHTML .= '<th>Description</th>';
        $tableHTML .= '<th>Motivation</th>';
        $tableHTML .= '<th>Moyen_trasport</th>';
        $tableHTML .= '</tr>';
        $tableHTML .= '</thead>';
        $tableHTML .= '<tbody>';
        
        
    foreach ($result as $row) {
    $tableHTML .= '<tr>';

        $tableHTML .= '<td>' . $row['id_voy'] . '</td>';
        $tableHTML .= '<td>' . $row['titre'] . '</td>';
        $tableHTML .= '<td>' . $row['id_des'] . '</td>';
        $tableHTML .= '<td>' . $row['date_debut'] . '</td>';
        $tableHTML .= '<td>' . $row['date_fin'] . '</td>';
        $tableHTML .= '<td>' . $row['prix'] . '</td>';
        $tableHTML .= '<td>' . $row['description'] . '</td>';
        $tableHTML .= '<td>' . $row['motivation'] . '</td>';
        $tableHTML .= '<td>' . $row['moyen_transport'] . '</td>';
        $tableHTML .= '<td><button class="btn btn-danger btn-delete" data-id="' . $row['id_voy'] . '">Delete</button></td>';
        $tableHTML .= '<td><button class="btn btn-primary btn-update" data-id="' . $row['id_voy'] .'" data-titre="' . htmlspecialchars($row['titre']) .'" data-id_des="' . $row['id_des'] . '" data-prix="' . $row['prix'] .'" data-moyen_transport="' . htmlspecialchars($row['moyen_transport']) . '" data-description="' . htmlspecialchars($row['description']) .'" data-motivation="' . htmlspecialchars($row['motivation']) .  '" data-date_debut="' . $row['date_debut'] . '" data-date_fin="' . $row['date_fin'] . '">Update</button></td>';


        $tableHTML .= '</tr>';
                      }
        
        $tableHTML .= '</tbody>';
        $tableHTML .= '</table>';
        
        return $tableHTML;
            } catch (Exeption $e) {
                die('Error : ' . $e->getMessage());
                return "";
            }
            
        }


        public function deleteVoyage($id_voy) {
            $conn = config::getConnexion();
            try {
                $query = $conn->prepare("DELETE FROM voyage WHERE id_voy = :id_voy");
                $query->bindParam(':id_voy', $id_voy);
                $query->execute();
                return true;
            } catch (PDOException $e) {
                error_log('Error deleting voyage: ' . $e->getMessage());
                return false;
            }
        }


    
    public function addVoyage($id_voy, $titre, $id_des, $date_debut, $date_fin, $prix, $description, $motivation, $moyen_transport) {
        $conn = config::getConnexion();
        
        try {
            $query = $conn->prepare("INSERT INTO voyage (id_voy, titre, id_des, date_debut, date_fin, prix, description, motivation, moyen_transport) VALUES (:id_voy, :titre, :id_des, :date_debut, :date_fin, :prix, :description, :motivation, :moyen_transport)");
            // Bind parameters
            $query->bindParam(':id_voy', $id_voy);
            $query->bindParam(':titre', $titre);
            $query->bindParam(':id_des', $id_des);
            $query->bindParam(':date_debut', $date_debut);
            $query->bindParam(':date_fin', $date_fin);
            $query->bindParam(':prix', $prix);
            $query->bindParam(':description', $description);
            $query->bindParam(':motivation', $motivation);
            $query->bindParam(':moyen_transport', $moyen_transport);

            // Execute the query
            $query->execute();
            
            // Check if insertion was successful
            if ($query->rowCount() > 0) {
                return true; // Voyage added successfully
            } else {
                return false; // Failed to add voyage
            }
        } catch (PDOException $e) {
            // Handle any exceptions
            echo "Error: " . $e->getMessage();
            return false; // Failed to add voyage
        }
    }


        public function updateVoyage($id_voy,$titre,$id_des,$date_debut,$date_fin,$prix,$description,$motivation,$moyen_transport) {
            $conn = config::getConnexion();
            try {
                // Prepare SQL statement to update voyage data
                $query = $conn->prepare("UPDATE voyage SET titre = :titre, id_des = :id_des, date_debut = :date_debut, date_fin = :date_fin, prix = :prix, description = :description, motivation = :motivation, moyen_transport = :moyen_transport WHERE id_voy = :id_voy");
    
                // Bind parameters
                $query->bindParam(':id_voy', $id_voy);
                $query->bindParam(':titre', $titre);
                $query->bindParam(':id_des', $id_des);
                $query->bindParam(':date_debut', $date_debut);
                $query->bindParam(':date_fin', $date_fin);
                $query->bindParam(':prix', $prix);
                $query->bindParam(':description', $description);
                $query->bindParam(':motivation', $motivation);
                $query->bindParam(':moyen_transport', $moyen_transport);
    
                // Execute the query
                $query->execute();
    
                // Return true if update was successful
                return true;
            } catch (PDOException $e) {
                // Log and return false if update fails
                error_log('Error updating voyage: ' . $e->getMessage());
                return false;
            }
        }
        // INNER JOIN 
public function getDestinationWithVoyage() {
    $sql = "SELECT v.id_voy, v.id_des, v.titre, v.date_debut, v.date_fin, v.prix, v.description, v.motivation, v.moyen_transport,
            d.id_des AS destination_id, d.nom_ville, d.description_detaillee, d.coordonneesGPS, d.pays, d.langueParlee, d.categorie, d.motivations, d.climat
            FROM voyage v
            INNER JOIN destination d ON v.id_des = d.id_des";

    $conn = config::getConnexion();
    try {
        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        $tableHTML = '<table class="table">';
        $tableHTML .= '<thead>';
        $tableHTML .= '<tr>';
        $tableHTML .= '<th>ID_Voy</th>';
        $tableHTML .= '<th>Titre</th>';
        $tableHTML .= '<th>ID_Des</th>';
        $tableHTML .= '<th>Date_Debut</th>';
        $tableHTML .= '<th>Date_Fin</th>';
        $tableHTML .= '<th>Prix</th>';
        $tableHTML .= '<th>Description</th>';
        $tableHTML .= '<th>Motivation</th>';
        $tableHTML .= '<th>Moyen_transport</th>';
       /* $tableHTML .= '<th>ID_Des</th>';
        $tableHTML .= '<th>Destination Name</th>';
        $tableHTML .= '<th>Description Details</th>';
        $tableHTML .= '<th>GPS</th>';
        $tableHTML .= '<th>Country</th>';
        $tableHTML .= '<th>Language</th>';
        $tableHTML .= '<th>Category</th>';
        $tableHTML .= '<th>Motivations</th>';
        $tableHTML .= '<th>Climate</th>';*/
        $tableHTML .= '</tr>';
        $tableHTML .= '</thead>';
        $tableHTML .= '<tbody>';

        foreach ($result as $row) {
            $tableHTML .= '<tr>';
            $tableHTML .= '<td>' . $row['id_voy'] . '</td>';
            $tableHTML .= '<td>' . $row['titre'] . '</td>';
            $tableHTML .= '<td>' . $row['id_des'] . '</td>';
            $tableHTML .= '<td>' . $row['date_debut'] . '</td>';
            $tableHTML .= '<td>' . $row['date_fin'] . '</td>';
            $tableHTML .= '<td>' . $row['prix'] . '</td>';
            $tableHTML .= '<td>' . $row['description'] . '</td>';
            $tableHTML .= '<td>' . $row['motivation'] . '</td>';
            $tableHTML .= '<td>' . $row['moyen_transport'] . '</td>';
           /* $tableHTML .= '<td>' . $row['destination_id'] . '</td>';
            $tableHTML .= '<td>' . $row['nom_ville'] . '</td>';
            $tableHTML .= '<td>' . $row['description_detaillee'] . '</td>';
            $tableHTML .= '<td>' . $row['coordonneesGPS'] . '</td>';
            $tableHTML .= '<td>' . $row['pays'] . '</td>';
            $tableHTML .= '<td>' . $row['langueParlee'] . '</td>';
            $tableHTML .= '<td>' . $row['categorie'] . '</td>';
            $tableHTML .= '<td>' . $row['motivations'] . '</td>';
            $tableHTML .= '<td>' . $row['climat'] . '</td>';*/
            $tableHTML .= '<td><button class="btn btn-danger btn-delete1" data-id="' . $row['id_voy'] . '">Delete</button></td>';
            $tableHTML .= '<td><button class="btn btn-primary btn-update" data-id="' . $row['id_voy'] .'" data-titre="' . htmlspecialchars($row['titre']) .'" data-id_des="' . $row['id_des'] . '" data-prix="' . $row['prix'] .'" data-moyen_transport="' . htmlspecialchars($row['moyen_transport']) . '" data-description="' . htmlspecialchars($row['description']) .'" data-motivation="' . htmlspecialchars($row['motivation']) .  '" data-date_debut="' . $row['date_debut'] . '" data-date_fin="' . $row['date_fin'] .  '" data-id_cour="' . htmlspecialchars($row['id_des']) .'">Update</button></td>';
            $tableHTML .= '</tr>';
        }

        $tableHTML .= '</tbody>';
        $tableHTML .= '</table>';

        return $tableHTML;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
        return '';
    }
}

public function existsDestination($id_des) {
    $sql = "SELECT COUNT(*) AS count FROM destination WHERE id_des = :id_des";
    $conn = config::getConnexion();
    try {
        $query = $conn->prepare($sql);
        $query->bindParam(':id_des', $id_des);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
        return false; // Return false in case of an error
    }
}
public function SearchVoyageByTitre($titre) {
    $conn = config::getConnexion();
    try {
        // Prepare SQL statement to search for voyage by titre
        $query = $conn->prepare("SELECT * FROM voyage WHERE titre LIKE :titre");
        
        // Bind parameter
        $titreParam = '%' . $titre . '%'; // Add wildcard '%' to search for partial matches
        $query->bindParam(':titre', $titreParam);
        $query->execute();
        
        // Fetch all matching voyages
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    } catch (PDOException $e) {
        error_log('Error searching voyage by titre: ' . $e->getMessage());
        return false;
    }
}
public function generateTravelStatistics() {
    $conn = config::getConnexion();
    try {
      // Travel Count by Destination
      $query = $conn->prepare("SELECT id_des, COUNT(*) as travel_count FROM voyage GROUP BY id_des");
      $query->execute();
      $travelCountByDestination = $query->fetchAll();
  
      // Average Travel Price by Destination
      $query = $conn->prepare("SELECT id_des, AVG(prix) as avg_price FROM voyage GROUP BY id_des");
      $query->execute();
      $avgTravelPriceByDestination = $query->fetchAll();
  
      // Travel Count by Transport Type
     $query = $conn->prepare("SELECT moyen_transport, COUNT(*) as travel_count FROM voyage GROUP BY moyen_transport");
      $query->execute();
      $travelCountByTransport = $query->fetchAll();
  
      // Most Frequent Travel Duration (assuming date_debut and date_fin are valid date columns)
      $query = $conn->prepare("SELECT 
          moyen_transport,
          AVG(DATEDIFF(date_fin, date_debut)) AS avg_duration
        FROM voyage
        GROUP BY moyen_transport
        ORDER BY avg_duration DESC
        LIMIT 1");
      $query->execute();
      $mostFrequentDurationByTransport = $query->fetch();
  
      // Return the statistics
      return array(
        'travel_count_by_destination' => $travelCountByDestination,
       'avg_travel_price_by_destination' => $avgTravelPriceByDestination,
        'travel_count_by_transport' => $travelCountByTransport,
        'most_frequent_duration_by_transport' => $mostFrequentDurationByTransport
      );
    } catch (PDOException $e) {
      echo 'Error: ' . $e->getMessage();
      return null;
    }
  }


}


?>