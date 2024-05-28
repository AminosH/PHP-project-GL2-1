<?php
require_once '../autoloader.php';
$transferDAO = new TransferDAO();
$totalTransfers = $transferDAO->getTotalTransfers();
echo $totalTransfers;
