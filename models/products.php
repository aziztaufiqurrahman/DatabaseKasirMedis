<?php

class Products
{
    public static function getAll ($db) 
    {
        $products = "SELECT pr.id_product, pr.name, pr.unit, pi.price, pi.created_at AS price_at, SUM(ba.stock) AS stock
        FROM products pr
        JOIN prices pi ON pi.id_product = pr.id_product
        JOIN batches ba ON ba.id_product = pr.id_product
        WHERE
            pr.id_product = 1 AND
            TO_NUMBER(TO_CHAR(expired_at, 'YYYYMMDDHH24MISS')) - TO_NUMBER(TO_CHAR((CURRENT_TIMESTAMP + INTERVAL '3' DAY), 'YYYYMMDDHH24MISS')) <> 0 AND
            pr.deleted_at IS NULL
        GROUP BY pr.id_product, pr.name, pr.unit, pi.price, pi.created_at
        ORDER BY pi.created_at DESC
        FETCH FIRST 1 ROWS ONLY;";
        $stmt = $db->prepare($products);
        $stmt->execute();
        $temp = $stmt->fetchAll ();
        return $temp;
    }
}
?>