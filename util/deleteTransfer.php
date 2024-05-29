<?php
require_once '../autoloader.php';

session_start();

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    die('Unauthorized access');
}

if (isset($_GET['id'])) {
    $transferDAO = new TransferDAO();
    $transferDAO->deleteTransferById($_GET['id']);
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
