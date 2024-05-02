<?php

class reservation {
  private ?int $id_res = null;
  private ?int $id_user = null;
  private ?int $id_heb = null;
  private ?int $id_voy = null;
  private ?string $date_res = null;
  private ?int $participation	 = null;
  private ?int $prix = null;
  private ?string $statu = null;
  private ?string $pay_meth = null;

  public function __construct(
    $id_res,
    $id_user,
    $id_heb,
    $id_voy,
    $date_res,
    $participation,
    $prix,
    $statu,
    $pay_meth
  ) {
    $this->id_res = $id_res;
    $this->id_user = $id_user;
    $this->id_heb = $id_heb;
    $this->id_voy = $id_voy;
    $this->date_res = $date_res;
    $this->participation = $participation;
    $this->prix = $prix;
    $this->statu = $statu;
    $this->pay_meth = $pay_meth;
  }

  public function getIdReservation() {
    return $this->id_res;
  }

  public function getIdUser() {
    return $this->id_user;
  }

  public function getIdHeb() {
    return $this->id_heb;
  }

  public function getIdVoy() {
    return $this->id_voy;
  }

  public function getDateReserv() {
    return $this->date_res;
  }

  public function getNbParticipation() {
    return $this->participation;
  }

  public function getPrixTot() {
    return $this->prix;
  }

  public function getStatus() {
    return $this->statu;
  }

  public function getPayMethode() {
    return $this->pay_meth;
  }

  public function setIdReservation($id_res) {
    $this->id_res = $id_res;
  }

  public function setIdUser($id_user) {
    $this->id_user = $id_user;
  }

  public function setIdHeb($id_heb) {
    $this->id_heb = $id_heb;
  }

  public function setIdVoy($id_voy) {
    $this->id_voy = $id_voy;
  }

  public function setDateReserv($date_res) {
    $this->date_res = $date_res;
  }

  public function setNbParticipation($participation) {
    $this->participation = $participation;
  }

  public function setPrixTot($prix) {
    $this->prix = $prix;
  }

  public function setStatus($statu) {
    $this->statu = $statu;
  }

  public function setPayMethode($pay_meth) {
    $this->pay_meth = $pay_meth;
  }
}