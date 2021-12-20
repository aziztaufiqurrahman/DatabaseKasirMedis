<?php

class Products
{
    public static function getAll ($db) 
    {
        $products = "SELECT pr.*, pc.price FROM products pr join prices pc on pc.id_product = pr.id_product";
        $stmt = $db->prepare($products);
        $stmt->execute();
        $temp = $stmt->fetchAll ();
        return $temp;
    }
}
?>