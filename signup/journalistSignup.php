<?php
include_once '../autoloader.php';

$journalistDAO = new JournalistDAO();
$userDAO = new UserDAO();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    if ($userDAO->loginExists($login)) {
        echo "<script>alert('This login already exists. Please choose another one.');</script>";
    } else {
        $password = $_POST["password"];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $journalistData = [
            'login' => $_POST['login'],
            'password' => $hashed_password,
            'email' => $_POST['email'],
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'nationality' => $_POST['nationality'],
            'birthdate' => $_POST['birthdate'],
            'media_company' => $_POST["media_company"],
            'independent' => $_POST['independent'],
            'bio' => $_POST['bio']
        ];

        $journalistDAO->addJournalist($journalistData);

        header("Location: ../login/login.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Journalist Signup</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/signup.css">
    <link rel="stylesheet" href="../css/journalistSignup.css">
</head>
<body>
<nav class="navbar fixed-top">
    <a class="navbar-brand" href="#">MyTransfer</a>
</nav>
<div class="container mt-5 pt-5">
    <form action="journalistSignup.php" method="post">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="login">Login:</label>
                    <input type="text" id="login" name="login" class="form-control" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" class="form-control" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="nationality">Nationality:</label>
                    <input type="text" id="nationality" name="nationality" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="media_company">Media Company:</label>
                    <input type="text" id="media_company" name="media_company" class="form-control">
                </div>
            </div>
            <div class="col">
                <div class="form-group form-check">
                    <input type="checkbox" id="independent" name="independent" class="form-check-input">
                    <label class="form-check-label" for="independent">Independent</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="birthdate">Birthdate:</label>
            <input type="date" id="birthdate" name="birthdate" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="bio">Bio:</label>
            <textarea id="bio" name="bio" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <a href="../login/login.php" class="mt-3 d-block">Back to login</a>
</div>
<script src="journalistSignupFormControl.js"></script>
</body>
</html>
