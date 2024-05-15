<?php
class voyage{
private int  $id_voy;
    private string $titre;
    private int $id_des;
    private date $date_debut;
    private date $date_fin;
    private float $prix;
    private string $description;
    private string $motivation;
    private string $moyen_transport;

        public function  __construct($id_voy,$titre,$id_des,$date_debut,$date_fin,$prix,$description,$motivation,$moyen_transport){
            $this->$id_voy = $id_voy;
            $this->$titre = $titre;
            $this->$id_des = $id_des;
            $this->$date_debut = $date_debut;
            $this->$date_fin = $date_fin;
            $this->$prix = $prix;
            $this->$description = $description;
            $this->$motivation = $motivation;
            $this->$moyen_transport = $moyen_transport;
        }

/**
 * Get the value of id_voy
 */ 
public function getId_voy()
{
return $this->id_voy;
}

/**
 * Set the value of id_voy
 *
 * @return  self
 */ 
public function setId_voy($id_voy)
{
$this->id_voy = $id_voy;

return $this;
}

    /**
     * Get the value of titre
     */ 
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */ 
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get the value of id_des
     */ 
    public function getId_des()
    {
        return $this->id_des;
    }

    /**
     * Set the value of id_des
     *
     * @return  self
     */ 
    public function setId_des($id_des)
    {
        $this->id_des = $id_des;

        return $this;
    }

    /**
     * Get the value of date_debut
     */ 
    public function getDate_debut()
    {
        return $this->date_debut;
    }

    /**
     * Set the value of date_debut
     *
     * @return  self
     */ 
    public function setDate_debut($date_debut)
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    /**
     * Get the value of date_fin
     */ 
    public function getDate_fin()
    {
        return $this->date_fin;
    }

    /**
     * Set the value of date_fin
     *
     * @return  self
     */ 
    public function setDate_fin($date_fin)
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    /**
     * Get the value of prix
     */ 
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set the value of prix
     *
     * @return  self
     */ 
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of motivation
     */ 
    public function getMotivation()
    {
        return $this->motivation;
    }

    /**
     * Set the value of motivation
     *
     * @return  self
     */ 
    public function setMotivation($motivation)
    {
        $this->motivation = $motivation;

        return $this;
    }

    /**
     * Get the value of moyen_transport
     */ 
    public function getMoyen_transport()
    {
        return $this->moyen_transport;
    }

    /**
     * Set the value of moyen_transport
     *
     * @return  self
     */ 
    public function setMoyen_transport($moyen_transport)
    {
        $this->moyen_transport = $moyen_transport;

        return $this;
    }
}
?>