<?php
include_once "../connect.php";
class Customers
{
    /**
     * perbarui data customer berdasarkan id customer, kalau id_customer-nya 0
     * lakukan penambahan data customer tadi (bukan pembaruan data)
     */
    public static function upsert($db, $id_customer, $name, $phone, $address)
    {
        $sql = "CALL upsert_customer(:id_customer, :name, :phone, :address)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id_customer", $id_customer);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":phone", $phone);
        $stmt->bindValue(":address", $address);
        $stmt->execute();
    }
}
?>