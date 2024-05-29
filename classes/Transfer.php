<?php
include_once '../autoloader.php';

class Transfer {
    private $db;

    public function __construct() {
        $this->db = ConnexionBD::getInstance();
    }
    public function showArrayTransfers(array $transfers, $deleteMode = false) {
        ob_start();

        echo "<table class='table table-striped'>";
        echo "<thead class='thead-dark'>";
        echo "<tr><th>Transfer ID</th><th>Player Name</th><th>Former Club</th><th>New Club</th><th>Rumor Date</th><th>Contract Duration (Y)</th><th>Contract Fee (M£)</th><th>Journalist</th>";
        if ($deleteMode) {
            echo "<th>Delete</th>";
        }
        echo "</tr></thead><tbody>";

        foreach ($transfers as $transfer) {
            $certainty = $transfer['certainty'];
            $hue = $certainty * 1.2;
            echo "<tr style='background-color: hsl({$hue}, 100%, 90%);' title='" . htmlspecialchars($transfer['description'], ENT_QUOTES) . "'>";
            echo "<td>" . $transfer['transfer_id'] . "</td>";
            echo "<td>" . $transfer['player_name'] . "</td>";
            echo "<td>" . $transfer['former_club'] . "</td>";
            echo "<td>" . $transfer['new_club'] . "</td>";
            echo "<td>" . $transfer['rumor_date'] . "</td>";
            echo "<td>" . $transfer['contract_duration'] . "</td>";
            echo "<td>" . $transfer['contract_fee'] . "</td>";
            $journalistDAO = new JournalistDAO();
            $journalistInfo = $journalistDAO->getJournalistInfoAsString($transfer['journalist_id']);
            echo "<td title='" . htmlspecialchars($journalistInfo, ENT_QUOTES) . "'>" . $journalistDAO->getJournalistNameById($transfer['journalist_id']) . "</td>";
            if ($deleteMode) {
                echo "<td><a href='../util/deleteTransfer.php?id=" . $transfer['transfer_id'] . "'>Delete</a></td>";
            }
            echo "</tr>";
        }

        echo "</tbody></table>";

        return ob_get_clean();
    }
}