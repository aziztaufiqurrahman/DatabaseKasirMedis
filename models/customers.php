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
        $stmt->bindParam(":id_customer", $id_customer, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT, 38);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":phone", $phone);
        $stmt->bindValue(":address", $address);
        $stmt->execute();
        return intval($id_customer);
    }
    /**
     * melakukan soft-delete untuk mengarsipkan data dari database (tidak sepenuhnya)
     * menghapus hingga data hilang
     */
    public static function softdelete($db, $id_customer)
    {
        $sql = "CALL softdelete_customer(:id_customer)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id_customer", $id_customer);
        $stmt->execute();
    }
}
?>