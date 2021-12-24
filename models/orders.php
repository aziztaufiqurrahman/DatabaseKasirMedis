<?php

class Orders
{
    /**
     * ambil saran 10 produk, kalau ada parameter nama, ambil berdasarkan parameter
     */
    public static function getProductSuggestions($db, $name, $isOrder)
    {
        $sql = "WITH res AS (
            SELECT pro.id_product, pro.name, pt.type, SUM(bat.stock) AS stock, pro.unit, pro.created_at, pri.price, pri.created_at AS price_at, ROW_NUMBER() OVER (
            PARTITION BY pro.id_product ORDER BY pri.created_at DESC
        ) AS parti
        FROM products pro
        JOIN prices pri ON pri.id_product = pro.id_product
        JOIN producttypes pt ON pt.id_type = pro.id_type
        JOIN batches bat ON bat.id_product = pro.id_product
        WHERE
            ".(strlen($name) > 0? "UPPER(pro.name) LIKE UPPER(:productname) AND" : "")."
            TO_NUMBER(TO_CHAR(expired_at, 'YYYYMMDDHH24MISS')) - TO_NUMBER(TO_CHAR((CURRENT_TIMESTAMP + INTERVAL '3' DAY), 'YYYYMMDDHH24MISS')) <> 0 AND
            pro.deleted_at IS NULL
        GROUP BY pro.id_product, pro.name, bat.id_product, pt.type, pro.unit, pro.created_at, pri.price, pri.created_at
        ORDER BY ".(strlen($name) > 0? "pro.name ASC," : "")." pri.created_at DESC
        )
        SELECT * FROM res WHERE parti = 1 ".($isOrder? "AND stock > 0" : "")."
        FETCH FIRST 10 ROWS ONLY";
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
        
        $key = ["ID_ORDER", "CODE"];
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
    /**
     * mendapatkan daftar order untuk satu akun
     */
    public static function getAll($db, $id_employee)
    {
        $riwayat = "WITH res AS 
        (
            SELECT o.id_order, d.id_product, o.id_employee, o.code, e.name AS employee_name, c.name as customer_name, pro.name, d.amount, p.price,p.price * d.amount AS subtotal, ROW_NUMBER() OVER (
                PARTITION BY d.id_order, d.id_product ORDER BY p.created_at DESC
            ) AS order_price, p.created_at AS price_at, o.created_at, o.archived_at
            FROM details d
            JOIN orders o ON d.id_order = o.id_order
            JOIN prices p ON d.id_product = p.id_product
            JOIN products pro ON pro.id_product = d.id_product
            JOIN employees e ON o.id_employee = e.id_employee
            JOIN customers c ON c.id_customer = o.id_customer
            WHERE
                o.created_at > p.created_at
        )
        SELECT id_order, id_employee, employee_name, customer_name as name, code, created_at, SUM(subtotal) AS total
        FROM res
        WHERE
            order_price = 1 AND
            archived_at IS NULL AND
            id_employee = :id_employee
        GROUP BY id_order, id_employee, employee_name, customer_name, code, created_at
        ORDER BY created_at DESC";
        $stmt = $db->prepare($riwayat);
        $stmt->bindValue(":id_employee", $id_employee);
        $stmt->execute();
        $temp = $stmt->fetchAll();
        return $temp;
    }
    /**
     * mendapatkan daftar order untuk admin
     */
    public static function getAllAdmin($db)
    {
        $sql = "WITH res AS 
        (
            SELECT o.id_order, d.id_product, o.id_employee, o.code, e.name AS employee_name, c.name as customer_name, pro.name, d.amount, p.price,p.price * d.amount AS subtotal, ROW_NUMBER() OVER (
                PARTITION BY d.id_order, d.id_product ORDER BY p.created_at DESC
            ) AS order_price, p.created_at AS price_at, o.created_at, o.archived_at
            FROM details d
            JOIN orders o ON d.id_order = o.id_order
            JOIN prices p ON d.id_product = p.id_product
            JOIN products pro ON pro.id_product = d.id_product
            JOIN employees e ON o.id_employee = e.id_employee
            JOIN customers c ON c.id_customer = o.id_customer
            WHERE
                o.created_at > p.created_at
        )
        SELECT id_order, id_employee, employee_name, customer_name as name, code, created_at, SUM(subtotal) AS total
        FROM res
        WHERE
            order_price = 1 AND
            archived_at IS NULL
        GROUP BY id_order, id_employee, employee_name, customer_name, code, created_at
        ORDER BY created_at DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $temp = $stmt->fetchAll();
        return $temp;
    }
    /**
     * mendapatkan detail
     */
    public static function getDetail($db, $id_order)
    {
        $sql = "WITH res AS 
        (
            SELECT o.id_order, d.id_product, o.id_employee, o.code, e.name AS employee_name, c.name as customer_name, pro.name, d.amount, p.price,p.price * d.amount AS subtotal, ROW_NUMBER() OVER (
                PARTITION BY d.id_order, d.id_product ORDER BY p.created_at DESC
            ) AS order_price, p.created_at AS price_at, o.created_at, o.archived_at
            FROM details d
            JOIN orders o ON d.id_order = o.id_order
            JOIN prices p ON d.id_product = p.id_product
            JOIN products pro ON pro.id_product = d.id_product
            JOIN employees e ON o.id_employee = e.id_employee
            JOIN customers c ON c.id_customer = o.id_customer
            WHERE
                o.created_at > p.created_at
        )
        SELECT id_order, name, amount, price, subtotal FROM res
        WHERE
            order_price = 1 AND
            archived_at IS NULL AND
            id_order = :id_order
        ORDER BY name ASC";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id_order", $id_order);
        $stmt->execute();
        $temp = $stmt->fetchAll();
        return $temp;
    }
    /**
     * arsipkan order
     */
    public function archive($db, $id_order)
    {
        $sql = "CALL archive_order(:id_order)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id_order", $id_order);
        $stmt->execute();
    }
}
?>