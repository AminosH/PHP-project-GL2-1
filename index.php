<?php
require_once 'autoloader.php';

session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    if (!isset($_SESSION['remember_me']) || !$_SESSION['remember_me']) {
        session_destroy();
        header("Location: login/login.php");
        exit;
    }

    $login = $_SESSION['login'];

    try {
        $userDAO = new UserDAO();
        $user = $userDAO->getUserByLogin($login);

        if ($user['is_admin'] == 1) {
            header("Location: admin/adminPage.php");
        } elseif ($user['is_journalist'] == 1) {
            header("Location: journalist/journalistPage.php");
        } else {
            header("Location: user/userPage.php");
        }
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
} else {
    header("Location: login/login.php");
}
