<?php
require_once '../classes/ConnexionBD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $nationality = $_POST["nationality"];
    $birthdate = $_POST["birthdate"];
    $media_company = $_POST["media_company"];
    $independent = $_POST["independent"];
    $bio = $_POST["bio"];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $bdd = ConnexionBD::getInstance();

        $req = $bdd->prepare("INSERT INTO users (login, email, password, is_journalist) VALUES (:login, :email, :password, TRUE)");
        $req->bindParam(':login', $login);
        $req->bindParam(':email', $email);
        $req->bindParam(':password', $hashed_password);

        $req->execute();

        $journalist_id = $bdd->lastInsertId();

        $req = $bdd->prepare("INSERT INTO journalists (journalist_id, first_name, last_name, nationality, birthdate, media_company, independent, bio) VALUES (:journalist_id, :first_name, :last_name, :nationality, :birthdate, :media_company, :independent, :bio)");
        $req->bindParam(':journalist_id', $journalist_id);
        $req->bindParam(':first_name', $first_name);
        $req->bindParam(':last_name', $last_name);
        $req->bindParam(':nationality', $nationality);
        $req->bindParam(':birthdate', $birthdate);
        $req->bindParam(':media_company', $media_company);
        if($independent == null) {
            $independent = false;
        }
        $req->bindParam(':independent', $independent, PDO::PARAM_BOOL);
        $req->bindParam(':bio', $bio);

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
    <input type="checkbox" id="independent" name="independent">

    <label for="media_company">Media Company:</label>
    <input type="text" id="media_company" name="media_company" required>


    <label for="bio">Bio:</label>
    <textarea id="bio" name="bio"></textarea>

    <input type="submit" value="Submit">
    <script src="journalistSignupFormControl.js"></script>
</form>
<a href="../login/login.php">Back to login</a>
<p>You will not be able to connect until an admin approves your demand.</p>
</body>
</html>