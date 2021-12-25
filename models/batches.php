<?php
class Batches
{
    public static function view($db, $id_product)
    {
        $sql = "SELECT *
        FROM batches
        WHERE
            -- TO_NUMBER(TO_CHAR(expired_at, 'YYYYMMDDHH24MISS')) - TO_NUMBER(TO_CHAR((CURRENT_TIMESTAMP + INTERVAL '3' DAY), 'YYYYMMDDHH24MISS')) <> 0 AND
            id_product = :id_product
        ORDER BY expired_at ASC";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id_product", $id_product);
        $stmt->execute();
        $row = $stmt->fetchAll();
        return $row;
    }
}

?>