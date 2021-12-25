<?php
class ProductTypes
{
    public static function getAll($db)
    {
        $sql = "SELECT * FROM view_types ORDER BY type ASC";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
}
?>