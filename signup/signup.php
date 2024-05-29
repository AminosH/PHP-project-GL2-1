<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userType = $_POST["userType"];
    if ($userType == "user") {
        header("Location: userSignup.php");
    } else if ($userType == "journalist") {
        header("Location: journalistSignup.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/signup.css">
</head>
<body>
<nav class="navbar fixed-top">
    <a class="navbar-brand" href="#">MyTransfer</a>
</nav>
<div class="container mt-5 pt-5">
    <form action="signup.php" method="post">
        <label for="userType">Sign up as:</label>
        <select id="userType" name="userType" class="form-control">
            <option value="user">Regular User</option>
            <option value="journalist">Journalist</option>
        </select>
        <input type="submit" value="Submit" class="btn btn-primary mt-3">
    </form>
    <a href="../login/login.php" class="mt-3 d-block">Back to login</a>
</div>
</body>
</html>