<?php
require_once '../autoloader.php';
session_start();
$transferDAO = new TransferDAO();
$transfer = new Transfer();
$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
$amount = isset($_GET['amount']) ? intval($_GET['amount']) : 5;
$transfers = $transferDAO->getTransfersInRange($start, $amount);

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    // This is an AJAX request
    echo $transfer->showArrayTransfers($transfers);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UserPage</title>
    <link rel="stylesheet" href="../css/userPage.css">
</head>
<body>
<div class="header">MyTransfer</div>
<div class="content">
    <?php echo $transfer->showArrayTransfers($transfers); ?>
</div>
<div class="arrows">
    <button id="prev" disabled>←</button>
    <button id="next">→</button>
</div>
<script src="userPage.js"></script>
<a href="../logout/logout.php">Logout</a>
</body>
</html>