<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userType = $_POST["userType"];
    if ($userType == "user") {
        header("Location: userSignup.php");
    } else if ($userType == "journalist") {
        header("Location: journalistSignup.php");
    }
}