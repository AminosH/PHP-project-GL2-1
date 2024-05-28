<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UserPage</title>
</head>
<body>
    <p>userPage</p>
    <?php
    require_once '../classes/ConnexionBD.php';
    require_once '../classes/Transfer.php';
    $db = ConnexionBD::getInstance();

    $transfer = new Transfer($db);
    $transfer->showTransfer(1);
        $transfer->showAllTransfers();
    ?>
    <a href="../logout/logout.php">Logout</a>
</body>
</html>