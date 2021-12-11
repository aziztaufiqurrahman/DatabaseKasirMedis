<?php
include "../connect.php";
class Transactions
{
    public static function getProductSuggestions($db, $name)
    {
        $sql = "SELECT pro.id_product, pro.name, pt.type, pro.stock, pro.unit, pro.created_at, pri.price, pri.created_at AS price_at FROM products pro JOIN prices pri ON pri.id_product = pro.id_product JOIN producttypes pt ON pt.id_type = pro.id_type WHERE pro.deleted_at IS NULL ORDER BY pro.created_at DESC, pri.created_at DESC FETCH FIRST 10 ROWS ONLY";
        if (strlen($name) > 0) $sql = "SELECT pro.id_product, pro.name, pt.type, pro.stock, pro.unit, pro.created_at, pri.price, pri.created_at AS price_at FROM products pro JOIN prices pri ON pri.id_product = pro.id_product JOIN producttypes pt ON pt.id_type = pro.id_type WHERE upper(pro.name) LIKE upper(:productname) AND pro.deleted_at IS NULL ORDER BY pro.name ASC, pri.created_at DESC FETCH FIRST 10 ROWS ONLY";
        $stmt = $db->prepare($sql);
        if (strlen($name) > 0) $stmt->bindValue(":productname", $name.'%');
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($rows, JSON_NUMERIC_CHECK);
    }
    public static function getCustomerSuggestions($db, $name)
    {
        $sql = "SELECT id_customer, name, phone, address FROM customers WHERE upper(name) LIKE upper(:customername) AND deleted_at IS NULL ORDER BY name ASC FETCH FIRST 5 ROWS ONLY";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":customername", $name.'%');
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($rows);
    }
}
?>