<?php
date_default_timezone_set("Asia/Jakarta");
require "config.php";

$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_PERSISTENT => true,
    PDO::ATTR_STRINGIFY_FETCHES => false,
    PDO::ATTR_EMULATE_PREPARES => false,
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

function formatdate($date)
{
    return date("Y-m-d H:i:s",strtotime($date));
}
function formatTS($timestampString)
{
    $date = DateTime::createFromFormat("d#M#y H#i#s*A", $timestampString);
    return $date->format('d-m-Y H:i:s');
}

?>