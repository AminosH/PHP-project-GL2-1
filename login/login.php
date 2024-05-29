<?php
include_once '../autoloader.php';

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
            $_SESSION["remember_me"] = $_POST["remember"];
            $userDAO = new UserDAO();
            $_SESSION["id"] = $userDAO->getUserByLogin($login)['user_id'];
            $_SESSION["is_admin"] = $row['is_admin'];
            $journalistDAO = new JournalistDAO();
            if ($row['is_admin'] == 1) {
                header("location: ../admin/adminPage.php");
            } elseif ($row['is_journalist'] == 1){
                if($journalistDAO->getIsValidByJournalistId($_SESSION["id"])){
                    header("location: ../journalist/journalistPage.php");
                }else{
                    echo "<script>alert('Either wait for validation or you got banned');</script>";
                }
            } else {
                header("location: ../user/userPage.php");
            }
        } else {
            echo "<script>alert('The password you entered was not valid.');</script>";
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyTransfer - Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
<nav class="navbar navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="#">MyTransfer</a>
</nav>
<form action="login.php" method="post" style="margin-top: 60px;">
    <label for="login">Login:</label><br>
    <input type="text" id="login" name="login"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br>
    <div class="remember-me">
        <input type="checkbox" id="remember" name="remember">
        <label for="remember">Remember me</label>
    </div>
    <input type="submit" value="Submit">
</form>
<p>Don't have an account? <a href="../signup/signup.php">Sign up</a></p>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>