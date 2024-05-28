<?php
require_once 'ConnexionBD.php';
require_once 'UserDAO.php';

class JournalistDAO {
    private $db;

    public function __construct() {
        $this->db = ConnexionBD::getInstance();
    }
    /**
     * @return array
     */
    public function getAllJournalists() {
        $query = "SELECT * FROM Journalists";
        $req = $this->db->prepare($query);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * @param $journalist_id
     * @return array
     */
    public function getJournalistById($journalist_id) {
        $query = "SELECT * FROM Journalists WHERE journalist_id = :journalist_id";
        $req = $this->db->prepare($query);
        $req->bindParam(':journalist_id', $journalist_id);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }
    /**
     * @param $journalistData
     * @return void
     */
    public function addJournalist($journalistData) {
        $userDAO = new UserDAO();
        $userData = [
            'login' => $journalistData['login'],
            'password' => $journalistData['password'],
            'email' => $journalistData['email'],
            'is_admin' => false,
            'is_journalist' => true
        ];
        $userDAO->addUser($userData);

        $user = $userDAO->getUserByLogin($journalistData['login']);
        $journalist_id = $user['user_id'];

        $query = "INSERT INTO Journalists (journalist_id, first_name, last_name, nationality, birthdate, media_company, independent, bio) VALUES (:journalist_id, :first_name, :last_name, :nationality, :birthdate, :media_company, :independent, :bio)";
        $req = $this->db->prepare($query);
        $req->bindParam(':journalist_id', $journalist_id);
        $req->bindParam(':first_name', $journalistData['first_name']);
        $req->bindParam(':last_name', $journalistData['last_name']);
        $req->bindParam(':nationality', $journalistData['nationality']);
        $req->bindParam(':birthdate', $journalistData['birthdate']);
        $req->bindParam(':media_company', $journalistData['media_company']);
        $req->bindParam(':independent', $journalistData['independent'], PDO::PARAM_BOOL);
        $req->bindParam(':bio', $journalistData['bio']);
        $req->execute();
    }
}