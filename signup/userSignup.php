<?php
include_once '../autoloader.php';

$userDAO = new UserDAO();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    if ($userDAO->loginExists($login)) {
        echo "<script>alert('This login already exists. Please choose another one.');</script>";
    } else {
        $password = $_POST["password"];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $userData = [
            'login' => $login,
            'password' => $hashed_password,
            'email' => $_POST['email'],
            'is_admin' => false,
            'is_journalist' => false
        ];

        $userDAO->addUser($userData);

        header("Location: ../login/login.php");
    }
}
// rest of your code...
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Signup</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/signup.css">
</head>
<body>
<nav class="navbar fixed-top">
    <a class="navbar-brand" href="#">MyTransfer</a>
</nav>
<div class="container mt-5">
    <form action="userSignup.php" method="post">
        <div class="form-group">
            <label for="login">Login:</label>
            <input type="text" id="login" name="login" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <a href="../login/login.php" class="mt-3 d-block">Back to login</a>
</div>
</body>
</html>
