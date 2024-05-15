<?php
class destination {
    private int $id_des;
    private string $nom_ville;
    private string $description_detaille;
    private string $GPS;
    private string $pays;
    private string $langue;
    private string $motivation_destination;
    private string $categorie_destination;
    private string $climat;


    public function  __construct($id_des,$nom_ville,$description_detaille,$GPS,$pays,$motivation_destination,$categorie_destination,$climat){
        $this->$id_des = $id_des;
        $this->$nom_ville = $nom_ville;
        $this->$GPS = $GPS;
        $this->$description_detaille = $description_detaille;
        $this->$pays = $pays;
        $this->$langue = $langue;
        $this->$motivation_destination = $motivation_destination;
        $this->$categorie_destination = $categorie_destination;
        $this->$climat = $climat;
    }

    public function getIdDes(): int {
        return $this->id_des;
    }
    
    public function setIdDes(int $id_des): void {
        $this->id_des = $id_des;
    }
    
    public function getNomVille(): string {
        return $this->nom_ville;
    }
    
    public function setNomVille(string $nom_ville): void {
        $this->nom_ville = $nom_ville;
    }
    
    public function getDescriptionDetaille(): string {
        return $this->description_detaille;
    }
    
    public function setDescriptionDetaille(string $description_detaille): void {
        $this->description_detaille = $description_detaille;
    }
    
    public function getGPS(): string {
        return $this->GPS;
    }
    
    public function setGPS(string $GPS): void {
        $this->GPS = $GPS;
    }
    
    public function getPays(): string {
        return $this->pays;
    }
    
    public function setPays(string $pays): void {
        $this->pays = $pays;
    }
    
    public function getLangue(): string {
        return $this->langue;
    }
    
    public function setLangue(string $langue): void {
        $this->langue = $langue;
    }
    
    public function getMotivationDestination(): string {
        return $this->motivation_destination;
    }
    
    public function setMotivationDestination(string $motivatio_destination): void {
        $this->motivation_destination = $motivation_destination;
    }
    
    public function getCategorieDestination(): string {
        return $this->categorie_destination;
    }
    
    public function setCategorieDestination(string $categorie_destination): void {
        $this->categorie_destination = $categorie_destination;
    }
    
    
    public function getClimat(): string {
        return $this->climat;
    }
    
    public function setClimat(string $climat): void {
        $this->climat = $climat;
    }
    
}
?>
