<?php

require '../Classes/DBProduct.php';
require '../Classes/DatabaseOperationsClass.php';

$dbdisplay = new DatabaseOperations();
$products = $dbdisplay->dbDisplay();
