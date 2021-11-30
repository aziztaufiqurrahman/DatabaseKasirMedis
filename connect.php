<?php
$username = "system";
$password = "";
$ip = "127.0.0.1";
$port = "1521";
$sid = "xe";

$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

global $db;

try
{
    $db = new PDO("oci:dbname={$ip}:{$port}/{$sid}", $username, $password, $opt);
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