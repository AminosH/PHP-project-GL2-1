<?php
require_once '../classes/ConnexionBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $bdd = ConnexionBD::getInstance();

        $req = $bdd->prepare("INSERT INTO users (login, email, password) VALUES (:login, :email, :password)");
        $req->bindParam(':login', $login);
        $req->bindParam(':email', $email);
        $req->bindParam(':password', $hashed_password);

        $req->execute();

        header("Location: ../login/login.html");
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Signup</title>
</head>
<body>
<form action="userSignup.php" method="post">
    <label for="login">Login:</label>
    <input type="text" id="login" name="login" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <input type="submit" value="Submit">
</form>
<a href="../login/login.php">Back to login</a>
</body>
</html>
