<?php
require_once '../autoloader.php';
session_start();
$transferDAO = new TransferDAO();
$transfer = new Transfer();
$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
$amount = isset($_GET['amount']) ? intval($_GET['amount']) : 5;
$transfers = $transferDAO->getTransfersInRange($start, $amount);

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    echo $transfer->showArrayTransfers($transfers);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UserPage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/userPage.css">
    <link rel="stylesheet" href="../css/transfers.css">
</head>
<body>
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#">MyTransfer</a>
    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=MyTransfer@gmail.com" target="_blank">
        <button class="btn btn-light">Contact Us</button>
    </a>
    <a class="navbar-text ml-auto" href="../logout/logout.php">Logout</a>
</nav>
<div class="content">
    <?php echo $transfer->showArrayTransfers($transfers); ?>
</div>
<div class="arrows">
    <button id="prev" disabled>←</button>
    <button id="next">→</button>
</div>
<script src="userPage.js"></script>
</body>
</html>