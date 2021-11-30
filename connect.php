<?php
$username = "system";
$password = "admin";

$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

global $db;

try
{
    $db = new PDO("oci:dbname=127.0.0.1:1521/xe", $username, $password, $opt);
    if (!$db) throw new Exception("Cannot connect into the database!");
}
catch(PDOException $e)
{
    echo($e->getMessage());
}

function pretty($arr)
{
    print("<pre>".print_r($arr,true)."</pre>");
}

?>