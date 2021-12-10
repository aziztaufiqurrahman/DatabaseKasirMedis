<?php
require "../models/transactions.php";
header("Content-type:application/json");
$query = '';
if (isset($_POST['name'])) $query = $_POST['name'];
$suggestion = Transactions::getProductSuggestions($db, $query);
print($suggestion);
?>