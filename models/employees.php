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
     * mengambil data berdasarkan id
     */
    public static function getById($db, $id_employee)
    {
        $sql = "SELECT * FROM employees WHERE id_employee = :id_employee";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_employee', $id_employee);
        $stmt->execute();
        $temp = $stmt->fetch();
        return json_encode($temp, JSON_NUMERIC_CHECK);
    }
    /**
     * melakukan login
     */
    public static function login($db, $username, $password)
    {
        $sql = "SELECT * FROM employees WHERE username = :a AND password = standard_hash(:b, 'MD5')";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':a', $username);
        $stmt->bindValue(':b',$password);
        $stmt->execute();
        $temp = $stmt->fetch();
        return json_encode($temp, JSON_NUMERIC_CHECK);
    }
    /**
     * tambah employees
     */
    public static function add($db, $username, $password, $name, $role, $phone, $address)
    {
        $sql = "CALL insert_employee(:username, standard_hash(:password, 'MD5'), :name, :role, :phone, :address)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":username", $username);
        $stmt->bindValue(":password", $password);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":role", $role);
        $stmt->bindValue(":phone", $phone);
        $stmt->bindValue(":address", $address);
        $stmt->execute();
    }
    public static function update($db, $id_employee, $password, $name, $address)
    {
        $sql = "CALL update_employee(:id_employee, :password, :name, :address)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id_employee", $id_employee);
        $stmt->bindValue(":password", $password);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":address", $address);
        $stmt->execute();
    }
    public function delete($db, $id_employee)
    {
        $sql = "CALL softdelete_employee(:id_employee)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id_employee", $id_employee);
        $stmt->execute();
    }
}
?>