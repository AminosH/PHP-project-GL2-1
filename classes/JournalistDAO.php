<?php
include_once '../autoloader.php';

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
     * @param $journalist_id
     * @return string
     */
    public function getJournalistNameById($journalist_id) {
        $journalist = $this->getJournalistById($journalist_id);
        return $journalist['first_name'] . ' ' . $journalist['last_name'];
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
        $isValid = false;
        $req->bindParam(':isValid', $isValid, PDO::PARAM_BOOL);
        $req->execute();
    }
    /**
     * @param $journalist_id
     * @return bool
     */
    public function getIsValidByJournalistId($journalist_id) {
        $query = "SELECT isValid FROM Journalists WHERE journalist_id = :journalist_id";
        $req = $this->db->prepare($query);
        $req->bindParam(':journalist_id', $journalist_id);
        $req->execute();
        $result = $req->fetch(PDO::FETCH_ASSOC);
        return isset($result['isValid']) && (bool)$result['isValid'];
    }
    public function showArrayJournalists(array $journalists) {
        ob_start();

        echo "<table class='table table-hover table-striped'>";
        echo "<thead class='thead-dark'>";
        echo "<tr><th>Journalist ID</th><th>First Name</th><th>Last Name</th><th>Nationality</th><th>Birthdate</th><th>Media Company</th><th>Independent</th><th>Bio</th><th>isValid</th></tr>";
        echo "</thead>";
        echo "<tbody>";

        foreach ($journalists as $journalist) {
            echo "<tr>";
            echo "<td>" . $journalist['journalist_id'] . "</td>";
            echo "<td>" . htmlspecialchars($journalist['first_name'], ENT_QUOTES) . "</td>";
            echo "<td>" . htmlspecialchars($journalist['last_name'], ENT_QUOTES) . "</td>";
            echo "<td>" . htmlspecialchars($journalist['nationality'], ENT_QUOTES) . "</td>";
            echo "<td>" . $journalist['birthdate'] . "</td>";
            echo "<td>" . htmlspecialchars($journalist['media_company'], ENT_QUOTES) . "</td>";
            echo "<td>" . ($journalist['independent'] ? 'Yes' : 'No') . "</td>";
            echo "<td>" . htmlspecialchars($journalist['bio'], ENT_QUOTES) . "</td>";
            echo "<td>" . ($journalist['isValid'] ? 'Yes' : 'No') . "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";

        return ob_get_clean();
    }
    public function getJournalistInfoAsString($journalist_id) {
        $journalist = $this->getJournalistById($journalist_id);
        if ($journalist) {
            $info = "First Name: " . $journalist['first_name'] . "\n";
            $info .= "Last Name: " . $journalist['last_name'] . "\n\n";
            $info .= "Nationality: " . $journalist['nationality'] . "\n";
            $info .= "Birthdate: " . $journalist['birthdate'] . "\n\n";
            $info .= "Media Company: " . $journalist['media_company'] . "\n";
            $info .= "Independent: " . ($journalist['independent'] ? 'Yes' : 'No') . "\n\n";
            $info .= "Bio: " . $journalist['bio'] . "\n";
            return $info;
        } else {
            return "No journalist found with ID: " . $journalist_id;
        }
    }
}