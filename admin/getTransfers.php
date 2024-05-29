<?php
include_once '../autoloader.php';

$transfer = new Transfer();
$transferDAO = new TransferDAO();
echo $transfer->showArrayTransfers($transferDAO->getAllTransfers());
