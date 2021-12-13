<?php
include_once "connect.php";
class Employees
{
    public static function getAll($db)
    {
        $sql = "SELECT * FROM employees";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
}

?>