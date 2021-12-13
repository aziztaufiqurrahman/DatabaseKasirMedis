<?php
include_once "connect.php";
class Transactions2
{
public static function getAll ($db) 
    {
        $riwayat = "SELECT * FROM transactions WHERE archived_at = null";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $temp = $stmt->fetchAll ();
        return $temp;
    }
}
?>