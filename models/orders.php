<?php

class orders
{
    /**
     * ambil saran 10 produk, kalau ada parameter nama, ambil berdasarkan parameter
     */
    public static function getProductSuggestions($db, $name)
    {
        $sql = "SELECT pro.id_product, pro.name, pt.type, pro.stock, pro.unit, pro.created_at, pri.price, pri.created_at AS price_at FROM products pro JOIN prices pri ON pri.id_product = pro.id_product JOIN producttypes pt ON pt.id_type = pro.id_type WHERE" .(strlen($name) > 0? " upper(pro.name) LIKE upper(:productname) AND" : ""). " pro.deleted_at IS NULL ORDER BY ".(strlen($name) > 0? "pro.name ASC" : "pro.updated_at DESC").", pri.created_at DESC FETCH FIRST 10 ROWS ONLY";
        $stmt = $db->prepare($sql);
        if (strlen($name) > 0) $stmt->bindValue(":productname", $name.'%');
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($rows, JSON_NUMERIC_CHECK);
    }
    /**
     * ambil saran 10 pembeli, kalau ada parameter nama, ambil berdasarkan nama
     */
    public static function getCustomerSuggestions($db, $name)
    {
        $sql = "SELECT id_customer, name, phone, address FROM customers WHERE upper(name) LIKE upper(:customername) AND deleted_at IS NULL ORDER BY name ASC FETCH FIRST 5 ROWS ONLY";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":customername", $name.'%');
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($rows);
    }
    /**
     * melakukan transaksi baru (mencatat data kasir dan pembeli)
     */
    public static function create($db, $id_customer, $id_employee)
    {
        $id_order = 0;
        $code = "";
        $sql = "CALL new_order(:id_customer, :id_employee, :id_order, :code)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id_customer", $id_customer);
        $stmt->bindValue(":id_employee", $id_employee);
        $stmt->bindParam(":id_order", $id_order, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT, 38);
        $stmt->bindParam(":code", $code, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 11);
        $stmt->execute();
        
        $key = ["ID_order", "CODE"];
        $val = [$id_order, $code];
        $retVal = array_combine($key, $val);
        return $retVal;
    }
    /**
     * melakukan transaksi baru (mencatat produk yang ditransaksikan)
     */
    public static function detail($db, $id_order, $id_product, $amount)
    {
        $sql = "CALL detail_order(:id_order, :id_product, :amount)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id_order", $id_order);
        $stmt->bindValue(":id_product", $id_product);
        $stmt->bindValue(":amount", $amount);
        $stmt->execute();
    }
    public static function getAll ($db)
    {
        $riwayat = "SELECT * FROM orders  WHERE archived_at IS NULL";
        $stmt = $db->prepare($riwayat);
        $stmt->execute();
        $temp = $stmt->fetchAll ();
        return $temp;
    }
}
?>