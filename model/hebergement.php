<?php

class hebergement {
  private ?int $id_heb = null;
  private ?string $nom ;
  private ?string $type;
  private ?string $description ;
  private ?string $localisation ;
  private ?string $categorie ;
  private ?string $service ;

  public function __construct(
    
    string $nom,
    string $type,
    string $description,
    string $localisation,
    string $categorie,
    string $service
  ) {
    $this->id_heb = null;
    $this->nom = $nom;
    $this->type = $type;
    $this->description = $description;
    $this->localisation = $localisation;
    $this->categorie = $categorie;
    $this->service = $service;
  }

  public function getIdHebergement() {
    return $this->id_heb;
  }

  public function getNom() {
    return $this->nom;
  }

  public function getType() {
    return $this->type;
  }

  public function getDescription() {
    return $this->description;
  }

  public function getLocalisation() {
    return $this->localisation;
  }

  public function getCategorie() {
    return $this->categorie;
  }

  public function getServiceDispo() {
    return $this->service;
  }

  public function setIdHebergement($id) {
    $this->id_heb = $id;
  }

  public function setNom($nom) {
    $this->nom = $nom;
  }

  public function setType($type) {
    $this->type = $type;
  }

  public function setDescription($description) {
    $this->description = $description;
  }

  public function setLocalisation($localisation) {
    $this->localisation = $localisation;
  }

  public function setCategorie($categorie) {
    $this->categorie = $categorie;
  }

  public function setServiceDispo($service) {
    $this->service = $service;
  }
}