<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/adminPage.css">
    <link rel="stylesheet" href="../css/transfers.css">
</head>
<body>
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#">MyTransfer Admin Dashboard</a>
    <a class="navbar-text ml-auto" href="../logout/logout.php">Logout</a>
</nav>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-second">
    <div class="navbar-nav">
        <a class="nav-item nav-link" href="#journalists">Manage Journalists</a>
        <a class="nav-item nav-link" href="#transfers">Manage Transfer Rumors</a>
    </div>
</nav>
<div class="content container">
    <div id="journalists">
        <div id="journalistsList"></div>
    </div>
    <div id="transfers">
        <div id="transfersList"></div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="adminPage.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>