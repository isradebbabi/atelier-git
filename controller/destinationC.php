<?php
require '../../../config.php';

class destinationC {
    public function listDestination() {
        $sql = "SELECT * FROM destination";
        $db = Config::getConnexion();
        
        try {
            $destinations = $db->query($sql);
            return $destinations;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    
    public function list_Destination1() {
        $conn = Config::getConnexion();
        try {
            $query = $conn->prepare("SELECT * FROM destination");
            $query->execute();
            $destinations = $query->fetchAll();

            $destinationHTML = '<table class="table">';
            $destinationHTML .= '<thead>';
            $destinationHTML .= '<tr>';
            $destinationHTML .= '<th>ID_Des</th>';
            $destinationHTML .= '<th>Destination Name</th>';
            $destinationHTML .= '<th>Description Details</th>';
            $destinationHTML .= '<th>coordonneesGPS</th>';
            $destinationHTML .= '<th>Country</th>';
            $destinationHTML .= '<th>langueParlee</th>';
            $destinationHTML .= '<th>Category</th>';
            $destinationHTML .= '<th>Purpose</th>';
            $destinationHTML .= '<th>Climate</th>';
            $destinationHTML .= '</tr>';
            $destinationHTML .= '</thead>';
            $destinationHTML .= '<tbody>';

            foreach ($destinations as $destination) {
                $destinationHTML .= '<tr>';
                $destinationHTML .= '<td>' . $destination['id_des'] . '</td>';
                $destinationHTML .= '<td>' . $destination['nom_ville'] . '</td>';
                $destinationHTML .= '<td>' . $destination['description_detaillee'] . '</td>';
                $destinationHTML .= '<td>' . $destination['coordonneesGPS'] . '</td>';
                $destinationHTML .= '<td>' . $destination['pays'] . '</td>';
                $destinationHTML .= '<td>' . $destination['langueParlee'] . '</td>';
                $destinationHTML .= '<td>' . $destination['motivations'] . '</td>';
                $destinationHTML .= '<td>' . $destination['categorie'] . '</td>';
                $destinationHTML .= '<td>' . $destination['climat'] . '</td>';
                $destinationHTML .= '</tr>';
            }

            $destinationHTML .= '</tbody>';
            $destinationHTML .= '</table>';

            return $destinationHTML;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function deleteDestination($id_des) {
        $conn = config::getConnexion();
        try {
            $query = $conn->prepare("DELETE FROM destination WHERE id_des = :id_des");
            $query->bindParam(':id_des', $id_des);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            error_log('Error deleting Destination: ' . $e->getMessage());
            return false;
        }
    }

    public function updateDestination($id_des,$nom_ville,$description_detaillee,$coordonneesGPS,$pays,$langueParlee,$categorie,$motivations,$climat) {
        $conn = config::getConnexion();
        try {
            // Prepare SQL statement to update Destination data
            $query = $conn->prepare("UPDATE destination SET nom_ville = :nom_ville, description_detaillee = :description_detaillee, coordonneesGPS = :coordonneesGPS, pays = :pays, langueParlee = :langueParlee, categorie = :categorie, motivations = :motivations, climat = :climat WHERE id_des = :id_des");

            // Bind parameters
            $query->bindParam(':id_des', $id_des);
            $query->bindParam(':nom_ville', $nom_ville);
            $query->bindParam(':description_detaillee', $description_detaillee);
            $query->bindParam(':coordonneesGPS', $coordonneesGPS);
            $query->bindParam(':pays', $pays);
            $query->bindParam(':langueParlee', $langueParlee);
            $query->bindParam(':categorie', $categorie);
            $query->bindParam(':motivations', $motivations);
            $query->bindParam(':climat', $climat);

            // Execute the query
            $query->execute();

            // Return true if update was successful
            return true;
        } catch (PDOException $e) {
            // Log and return false if update fails
            error_log('Error updating Destination: ' . $e->getMessage());
            return false;
        }
    }
    public function addDestination($idDes_Des, $nom_ville, $description_detaillee, $coordonneesGPS, $pays, $langueParlee, $categorie, $motivations, $climat) {
        $conn = config::getConnexion();
        try {
            $query = $conn->prepare("INSERT INTO destination (id_des, nom_ville, description_detaillee, coordonneesGPS, pays, langueParlee, categorie, motivations, climat) VALUES (:id_des, :nom_ville, :description_detaillee, :coordonneesGPS, :pays, :langueParlee, :categorie, :motivations, :climat)");
            
            // Bind parameters
            $query->bindParam(':id_des', $idDes_Des);
            $query->bindParam(':nom_ville', $nom_ville);
            $query->bindParam(':description_detaillee', $description_detaillee);
            $query->bindParam(':coordonneesGPS', $coordonneesGPS);
            $query->bindParam(':pays', $pays);
            $query->bindParam(':langueParlee', $langueParlee);
            $query->bindParam(':categorie', $categorie);
            $query->bindParam(':motivations', $motivations);
            $query->bindParam(':climat', $climat);
    
            // Execute the query
            $query->execute();
            
            // Check if insertion was successful
            if ($query->rowCount() > 0) {
                return true; // Destination added successfully
            } else {
                return false; // Failed to add destination
            }
        } catch (PDOException $e) {
            // Log the error or display a meaningful message
            error_log('Error adding destination: ' . $e->getMessage());
            return false; // Failed to add destination
        }
        
    }
    
}

?>

