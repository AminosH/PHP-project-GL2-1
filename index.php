<?php
require_once 'classes/ConnexionBD.php';

session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    $login = $_SESSION['login'];

    try {
        $bdd = ConnexionBD::getInstance();
        $req = $bdd->prepare("SELECT is_admin, is_journalist FROM users WHERE login = :login");
        $req->bindParam(':login', $login);
        $req->execute();
        $row = $req->fetch(PDO::FETCH_ASSOC);

        if ($row['is_admin'] == 1) {
            header("Location: admin/adminPage.html");
        } elseif ($row['is_journalist'] == 1) {
            header("Location: journalist/journalistPage.html");
        } else {
            header("Location: user/userPage.html");
        }
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
} else {
    header("Location: login/login.html");
}

