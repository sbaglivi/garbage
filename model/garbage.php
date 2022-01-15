<?php
require __DIR__ . "/../helpers/garbageDb.php";
require __DIR__ . "/../helpers/config.php";
$db = new Database($dbconfig);

// router smista le richieste a metodi del controller, il controller chiama se necessario metodi del modello che a sua volta usa la classe db per interagire con mysql
// che cazzo fa il modello? o limito volontariamente i metodi del db cosi' che il modello abbia qualcosa da fare o mi sembra davvero superfluo boh
// controllers -> riceve chiamate dal router, prende i dati da database o modello e poi fa il render della view / routes->contiene il router che viene inizializzato / migrations / views / helpers (/ models solo se ci metto le classe del singolo ritiro magari?)
class Garbage
{
  protected $db;
  public function __construct($db)
  {
    $this->db = $db;
  }
  public function getAllCollectionTimes()
  {

    $data = $this->db->getCollectionTimes();
  }
}
