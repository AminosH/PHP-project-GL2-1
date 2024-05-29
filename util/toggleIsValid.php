<?php
require_once '../autoloader.php';

session_start();

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    die('Unauthorized access');
}

if (isset($_GET['id'])) {
    $journalistDAO = new JournalistDAO();
    $journalistDAO->toggleIsValid($_GET['id']);
}

header('Location: ../admin/adminPage.php#journalists');
