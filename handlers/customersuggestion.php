<?php
require "../connect.php";
require "../models/orders.php";
header("Content-type:application/json");
$query = '';
if (isset($_POST['name'])) $query = $_POST['name'];
$suggestion = orders::getCustomerSuggestions($db, $query);
print($suggestion);
?>