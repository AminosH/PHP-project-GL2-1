<?php
require_once '../classes/JournalistDAO.php';

$journalistDAO = new JournalistDAO();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    header("Location: ../login/login.html");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Journalist Signup</title>
</head>
<body>
<form action="journalistSignup.php" method="post">
    <label for="login">Login:</label>
    <input type="text" id="login" name="login" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" required>

    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" required>

    <label for="nationality">Nationality:</label>
    <input type="text" id="nationality" name="nationality" required>

    <label for="birthdate">Birthdate:</label>
    <input type="date" id="birthdate" name="birthdate" required>

    <label for="independent">Independent:</label>
    <input type="checkbox" id="independent" name="independent" checked>

    <label for="media_company">Media Company:</label>
    <input type="text" id="media_company" name="media_company" value=" " disabled required>


    <label for="bio">Bio:</label>
    <textarea id="bio" name="bio"></textarea>

    <input type="submit" value="Submit">
    <script src="journalistSignupFormControl.js"></script>
</form>
<a href="../login/login.php">Back to login</a>
<p>You will not be able to connect until an admin approves your demand.</p>
</body>
</html>