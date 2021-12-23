<?php

class Products
{
    /**
     * mendapatkan data semua product
     */
    public static function getAll ($db) 
    {
        $products = "SELECT pr.id_product, pr.name, pr.unit, pi.price, pi.created_at AS price_at, SUM(ba.stock) AS stock
        FROM products pr
        JOIN prices pi ON pi.id_product = pr.id_product
        JOIN batches ba ON ba.id_product = pr.id_product
        WHERE
            TO_NUMBER(TO_CHAR(expired_at, 'YYYYMMDDHH24MISS')) - TO_NUMBER(TO_CHAR((CURRENT_TIMESTAMP + INTERVAL '3' DAY), 'YYYYMMDDHH24MISS')) <> 0 AND
            pr.deleted_at IS NULL AND
            pi.created_at = (SELECT pri.created_at FROM prices pri WHERE pri.id_product = pr.id_product ORDER BY pri.created_at DESC FETCH FIRST 1 ROWS ONLY)
        GROUP BY pr.id_product, pr.name, pr.unit, pi.price, pi.created_at
        ORDER BY pi.created_at DESC";
        $stmt = $db->prepare($products);
        $stmt->execute();
        $temp = $stmt->fetchAll ();
        return $temp;
    }
    /**
     * ambil id dan nama produk
     */
    public static function getForAddStock($db, $id_product)
    {
        $sql = "SELECT id_product, name FROM products WHERE deleted_at IS NULL and id_product = :id_product";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id_product", $id_product);
        $stmt->execute();
        $temp = $stmt->fetch();
        return $temp;
    }
    /**
     * tambah stock
     */
    public static function addStock($db, $id_proc, $id_product, $id_employee, $count, $expired_at)
    {
        $sql = "CALL add_stock(:id_proc, :id_product, :id_employee, :count, :expired_at)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id_proc", $id_proc);
        $stmt->bindValue(":id_product", $id_product);
        $stmt->bindValue(":id_employee", $id_employee);
        $stmt->bindValue(":count", $count);
        $stmt->bindValue(":expired_at", $expired_at);
        $stmt->execute();
    }
}
?>