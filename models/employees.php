<?php

class Employees
{
    /**
     * Mengambil semua data dari table employees
     */
    public static function getAll($db)
    {
        $employees = "SELECT * FROM employees WHERE deleted_at IS NULL";
        $stmt = $db->prepare($employees);
        $stmt->execute();
        $temp = $stmt->fetchAll ();
        return $temp;
    }
    /**
     * Melakukan login
     */
    public static function login($db, $username, $password)
    {
        $sql = "SELECT * FROM employees WHERE username = :a AND password = standard_hash(:b, 'MD5')";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':a', $username);
        $stmt->bindValue(':b',$password);
        $stmt->execute();
        $temp = $stmt->fetch();
        return $temp;
    }
}
?>