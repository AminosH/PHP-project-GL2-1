<?php
include_once '../autoloader.php';

class Transfer {
    private $db;

    public function __construct() {
        $this->db = ConnexionBD::getInstance();
    }

    /**
     * @param $transfer_id
     * @return void
     */
    public function showTransfer($transfer_id) {
        $query = "SELECT * FROM Transfers WHERE transfer_id = :transfer_id";
        $req = $this->db->prepare($query);
        $req->bindParam(':transfer_id', $transfer_id);
        $req->execute();
        $transfer = $req->fetch(PDO::FETCH_ASSOC);

        if ($transfer) {
            echo "Transfer ID: " . $transfer['transfer_id'] . "<br>";
            echo "Player Name: " . $transfer['player_name'] . "<br>";
            echo "Former Club: " . $transfer['former_club'] . "<br>";
            echo "New Club: " . $transfer['new_club'] . "<br>";
            echo "Rumor Date: " . $transfer['rumor_date'] . "<br>";
            echo "Certainty: " . $transfer['certainty'] . "<br>";
            echo "Contract Duration: " . $transfer['contract_duration'] . "<br>";
            echo "Contract Fee: " . $transfer['contract_fee'] . "<br>";
            echo "Journalist ID: " . $transfer['journalist_id'] . "<br>";
            echo "Description: " . $transfer['description'] . "<br>";
        } else {
            echo "No transfer found with ID: " . $transfer_id;
        }
    }
    /**
     * @return string
     */
    public function showArrayTransfers(array $transfers) {
        ob_start();

        echo "<table>";
        echo "<tr><th>Transfer ID</th><th>Player Name</th><th>Former Club</th><th>New Club</th><th>Rumor Date</th><th>Certainty</th><th>Contract Duration</th><th>Contract Fee</th><th>Journalist ID</th></tr>";

        foreach ($transfers as $transfer) {
            echo "<tr title='" . htmlspecialchars($transfer['description'], ENT_QUOTES) . "'>";
            echo "<td>" . $transfer['transfer_id'] . "</td>";
            echo "<td>" . $transfer['player_name'] . "</td>";
            echo "<td>" . $transfer['former_club'] . "</td>";
            echo "<td>" . $transfer['new_club'] . "</td>";
            echo "<td>" . $transfer['rumor_date'] . "</td>";
            echo "<td>" . $transfer['certainty'] . "</td>";
            echo "<td>" . $transfer['contract_duration'] . "</td>";
            echo "<td>" . $transfer['contract_fee'] . "</td>";
            echo "<td>" . $transfer['journalist_id'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";

        return ob_get_clean();
    }
}