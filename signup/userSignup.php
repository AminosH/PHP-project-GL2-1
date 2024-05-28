<?php
include_once '../autoloader.php';


$userDAO = new UserDAO();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["password"];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $userData = [
        'login' => $_POST['login'],
        'password' => $hashed_password,
        'email' => $_POST['email'],
        'is_admin' => false,
        'is_journalist' => false
    ];

    $userDAO->addUser($userData);

    header("Location: ../login/login.php");
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
