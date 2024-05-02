<?php
require '../../config.php';

class hebergementc {
  public function listHebergement() {
    $sql = "SELECT * FROM hebergement";
    $db = Config::getConnexion();
    try {
      
      $hebergement = $db->query($sql);
      
      return $hebergement;
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
  }

  public function showHebergement($id_heb) {
    $sql = "SELECT * FROM hebergement WHERE `id_heb` = :id_heb";
    $db = Config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([
          ':id_heb' => $id_heb,
        ]);

        $hebergement = $query->fetch();
        return $hebergement;
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}


  function addHebergement($hebergement) {
    $sql = "INSERT INTO hebergement(id_heb, nom, type, description,localisation,categorie,service) 
            VALUES (:id_heb, :nom, :type, :description, :localisation, :categorie, :service)";
    $db = config::getConnexion();
    try {
      $query = $db->prepare($sql);
      $query->execute([
        ':id' => $hebergement->getId(),
        ':nom' => $hebergement->getNom(),
        ':type' => $hebergement->getType(),
        ':description' => $hebergement->getDescription(),
        ':localisation' => $hebergement->getLocalisation(),
        ':categorie' => $hebergement->getCategorie(),
        ':service' => $hebergement->getServiceDispo(),
      ]);
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }
    
  function updateHebergement($hebergement, $id_heb) {
    
    try {
      $db = Config::getConnexion();
      $query = $db->prepare(
        'UPDATE hebergement SET
            nom = :nom, 
            type = :type,
            description = :description,
            localisation = :localisation,
            categorie = :categorie,
            service = :service
        WHERE id_heb = :id_heb'
      );

      $query->execute([
        'id_heb' => $id_heb,
        'nom' => $hebergement->getNom(),
        'type' => $hebergement->getType(),
        'description' => $hebergement->getDescription(),
        'localisation' => $hebergement->getLocalisation(),
        'categorie' => $hebergement->getCategorie(),
        'service' => $hebergement->getServiceDispo(),
      ]);
      
      echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  function deleteHebergement($id) {
    $sql = "DELETE FROM hebergement WHERE `id_heb` = :id";
    $db = config::getConnexion();

    try {
      $req = $db->prepare($sql);
      $req->bindValue(':id', $id);
      $req->execute();
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
  }
}


?>