<?php
require_once 'ConnexionBD.php';

class TransfersDAO {
    private $db;

    public function __construct() {
        $this->db = ConnexionBD::getInstance();
    }
    /**
     * @return array
     */
    public function getAllTransfers() {
        $query = "SELECT * FROM Transfers ORDER BY rumor_date DESC";
        $req = $this->db->prepare($query);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * @param $transfer_id
     * @return array
     */
    public function getTransferById($transfer_id) {
        $query = "SELECT * FROM Transfers WHERE transfer_id = :transfer_id";
        $req = $this->db->prepare($query);
        $req->bindParam(':transfer_id', $transfer_id);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }
    /**
     * @param $journalist_id
     * @return array
     */
    public function getAllTransferByJournalistId($journalist_id) {
        $query = "SELECT * FROM Transfers WHERE journalist_id = :journalist_id ORDER BY rumor_date DESC";
        $req = $this->db->prepare($query);
        $req->bindParam(':journalist_id', $journalist_id);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}