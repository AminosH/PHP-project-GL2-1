<?php
include_once '../autoloader.php';

class UserDAO {
    private $db;

    public function __construct() {
        $this->db = ConnexionBD::getInstance();
    }
    /**
     * @return array
     */
    public function getAllUsers() {
        $query = "SELECT * FROM Users";
        $req = $this->db->prepare($query);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * @param $user_id
     * @return array
     */
    public function getUserById($user_id) {
        $query = "SELECT * FROM Users WHERE user_id = :user_id";
        $req = $this->db->prepare($query);
        $req->bindParam(':user_id', $user_id);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }
    /**
     * @param $userData
     * @return void
     */
    public function addUser($userData) {
        $query = "INSERT INTO Users (login, password, email, is_admin, is_journalist) VALUES (:login, :password, :email, :is_admin, :is_journalist)";
        $req = $this->db->prepare($query);
        $req->bindParam(':login', $userData['login']);
        $req->bindParam(':password', $userData['password']);
        $req->bindParam(':email', $userData['email']);
        $req->bindParam(':is_admin', $userData['is_admin'], PDO::PARAM_BOOL);
        $req->bindParam(':is_journalist', $userData['is_journalist'], PDO::PARAM_BOOL);
        $req->execute();
    }
    /**
     * @param $login
     * @return array
     */
    public function getUserByLogin($login)
    {
        $query = "SELECT * FROM Users WHERE login = :login";
        $req = $this->db->prepare($query);
        $req->bindParam(':login', $login);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }
    /**
     * @param $login
     * @return bool
     */
    public function loginExists($login) {
        $query = "SELECT COUNT(*) FROM Users WHERE login = :login";
        $req = $this->db->prepare($query);
        $req->bindParam(':login', $login);
        $req->execute();
        return $req->fetchColumn() > 0;
    }
}