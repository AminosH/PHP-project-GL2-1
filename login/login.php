<?php
require_once '../classes/ConnexionBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $bdd = ConnexionBD::getInstance();
        $req = $bdd->prepare("SELECT password, is_admin, is_journalist FROM users WHERE login = :login");
        $req->bindParam(':login', $login);
        $login = $_POST["login"];
        $req->execute();
        $row = $req->fetch(PDO::FETCH_ASSOC);

        if (password_verify($_POST["password"], $row['password'])) {
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION["login"] = $login;
            if ($row['is_admin'] == 1) {
                header("location: ../admin/adminPage.php");
            } elseif ($row['is_journalist'] == 1) {
                header("location: ../journalist/journalistPage.php");
            } else {
                header("location: ../user/userPage.php");
            }
        } else {
            $password_err = "The password you entered was not valid.";
            echo $password_err;
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}