<?php
include_once '../autoloader.php';

class TransferDAO {
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
    /**
     * @param int $start
     * @param int $amount
     * @return array
     */
    public function getTransfersInRange($start, $amount) {
        $query = "SELECT * FROM Transfers ORDER BY rumor_date DESC LIMIT :start, :amount";
        $req = $this->db->prepare($query);
        $req->bindParam(':start', $start, PDO::PARAM_INT);
        $req->bindParam(':amount', $amount, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * @param int $journalist_id
     * @param int $start
     * @param int $amount
     * @return array
     */
    public function getTransfersInRangeByJournalist($journalist_id, $start, $amount) {
        $query = "SELECT * FROM Transfers WHERE journalist_id = :journalist_id ORDER BY rumor_date DESC LIMIT :start, :amount";
        $req = $this->db->prepare($query);
        $req->bindParam(':journalist_id', $journalist_id, PDO::PARAM_INT);
        $req->bindParam(':start', $start, PDO::PARAM_INT);
        $req->bindParam(':amount', $amount, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * @return int
     */
    public function getTotalTransfers() {
        $query = "SELECT COUNT(*) FROM Transfers";
        $req = $this->db->prepare($query);
        $req->execute();
        return $req->fetchColumn();
    }
    /**
     * @param $journalist_id
     * @return int
     */
    public function getTotalTransfersByJournalist($journalist_id) {
        $query = "SELECT COUNT(*) FROM Transfers WHERE journalist_id = :journalist_id";
        $req = $this->db->prepare($query);
        $req->bindParam(':journalist_id', $journalist_id);
        $req->execute();
        return $req->fetchColumn();
    }
}