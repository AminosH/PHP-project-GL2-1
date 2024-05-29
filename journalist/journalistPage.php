<?php
session_start();
require_once '../autoloader.php';
$transferDAO = new TransferDAO();
$transfer = new Transfer();
$journalist_id = $_SESSION['id'];
var_dump($_SESSION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transferData = $_POST;
    $transferData['journalist_id'] = $journalist_id;
    $transferDAO->addTransfer($transferData);
}

$transfers = $transferDAO->getTransfersInRangeByJournalist($journalist_id, 0, 5);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Journalist Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/journalistPage.css">
    <link rel="stylesheet" href="../css/transfers.css">
</head>
<body>
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#">MyTransfer</a>
    <a class="navbar-text ml-auto" href="../logout/logout.php">Logout</a>
</nav>
<div class="content container">
    <h1>Add New Transfer</h1>
    <form method="POST">
        <div class="form-group">
            <label for="player_name">Player Name</label>
            <input type="text" class="form-control" id="player_name" name="player_name" required>
        </div>
        <div class="form-group">
            <label for="former_club">Former Club</label>
            <input type="text" class="form-control" id="former_club" name="former_club" required>
        </div>
        <div class="form-group">
            <label for="new_club">New Club</label>
            <input type="text" class="form-control" id="new_club" name="new_club" required>
        </div>
        <div class="form-group">
            <label for="certainty">Certainty: <span id="certaintyValue">0</span>%</label>
            <input type="range" class="form-control" id="certainty" name="certainty" min="0" max="100" step="5" value="0" oninput="updateValue(this.value)" required>
        </div>
        <script>
            function updateValue(val) {
                document.getElementById('certaintyValue').innerText = val;
            }
        </script>
        <div class="form-group">
            <label for="contract_duration">Contract Duration</label>
            <input type="number" class="form-control" id="contract_duration" name="contract_duration" required>
        </div>
        <div class="form-group">
            <label for="contract_fee">Contract Fee (M£)</label>
            <input type="number" class="form-control" id="contract_fee" name="contract_fee" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <h2>My Recent Transfers</h2>
    <?php echo $transfer->showArrayTransfers($transfers); ?>
</div>
</body>
</html>