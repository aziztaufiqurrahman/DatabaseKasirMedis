<?php

class Employees
{
    public static function getAll ($db) 
    {
        $employees = "SELECT * FROM employees ";
        $stmt = $db->prepare($employees);
        $stmt->execute();
        $temp = $stmt->fetchAll ();
        return $temp;
    }
}
?>