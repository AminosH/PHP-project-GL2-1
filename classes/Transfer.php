<?php
include_once '../autoloader.php';

class Transfer {
    private $db;

    public function __construct() {
        $this->db = ConnexionBD::getInstance();
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