<?php
//This code is just to help me fill in the database with hashed passwords

$passwords = ["admin1", "user1", "user2", "journalist1", "journalist2","journalist3","journalist4",
    "journalist5","journalist6","journalist7","journalist8","journalist9","journalist10"];

foreach ($passwords as $password) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    echo "The hashed password for '{$password}' is: {$hashed_password}<br><br><br>";
}
