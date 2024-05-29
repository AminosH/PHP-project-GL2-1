<?php
include_once '../autoloader.php';

$journalistDAO = new JournalistDAO();
echo $journalistDAO->showArrayJournalists($journalistDAO->getAllJournalists(),true);

