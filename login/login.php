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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyTransfer - Login</title>
</head>
<body>
<form action="login.php" method="post">
    <label for="login">Login:</label><br>
    <input type="text" id="login" name="login"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br>
    <input type="checkbox" id="remember" name="remember">
    <label for="remember">Remember me</label><br>
    <input type="submit" value="Submit">
</form>
<p>Don't have an account? <a href="../signup/signup.html">Sign up</a></p>
</body>
</html>