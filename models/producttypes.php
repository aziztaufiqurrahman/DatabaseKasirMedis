<?php
class ProductTypes
{
    public static function getAll($db)
    {
        $sql = "SELECT t.id_type, CONCAT(c.category, CONCAT(' - ', t.type))
        FROM producttypes t
        JOIN categories c ON t.id_category = c.id_category;";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return json_encode($rows, JSON_NUMERIC_CHECK);
    }
}
?>