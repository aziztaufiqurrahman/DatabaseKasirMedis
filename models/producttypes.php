<?php
class ProductTypes
{
    public static function getAll($db)
    {
        $sql = "SELECT * FROM view_types";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return json_encode($rows, JSON_NUMERIC_CHECK);
    }
}
?>