<?php
require_once '../autoloader.php';
$transferDAO = new TransferDAO();
$transfer = new Transfer();
$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
$amount = isset($_GET['amount']) ? intval($_GET['amount']) : 5;
$transfers = $transferDAO->getTransfersInRange($start, $amount);
echo $transfer->showArrayTransfers($transfers);
