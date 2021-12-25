CREATE OR REPLACE PROCEDURE upsert_customer (
    inout_id_customer IN OUT NUMBER,
    in_name IN VARCHAR2,
    in_phone IN VARCHAR2,
    in_address IN VARCHAR2
)
IS
BEGIN
    SAVEPOINT update_customer;
    UPDATE customers
    SET name=in_name, address=in_address, phone=in_phone
    WHERE id_customer = inout_id_customer;
    IF (sql%rowcount = 0) THEN
        INSERT INTO customers (name, phone, address) VALUES (in_name, in_phone, in_address) RETURNING id_customer INTO inout_id_customer;
    END IF;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
    ROLLBACK TO update_customer;
    RAISE;
END;
/
CREATE OR REPLACE PROCEDURE new_order (
    in_id_customer IN NUMBER,
    in_id_employee IN NUMBER,
    out_id_order OUT NUMBER,
    out_code OUT VARCHAR2
)
IS
    codex VARCHAR2(10);
    matchval NUMBER;
BEGIN
    SAVEPOINT new_order;
    <<find_available>>
    SELECT DBMS_RANDOM.STRING('X', 10) INTO codex FROM DUAL;
    SELECT COUNT(*) INTO matchval FROM orders WHERE code = codex;
    IF (matchval = 0) THEN
        INSERT INTO orders (code, id_customer, id_employee) VALUES (codex, in_id_customer, in_id_employee) RETURNING id_order INTO out_id_order;
    ELSE
        GOTO find_available;
    END IF;
    out_code := codex;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
    ROLLBACK TO new_order;
    RAISE;
END;
/
CREATE OR REPLACE PROCEDURE detail_order(
    in_id_order IN NUMBER,
    in_id_product IN NUMBER,
    in_amount IN NUMBER
)
IS
    temp_id NUMBER;
BEGIN
    SAVEPOINT detail_order;
    
    INSERT INTO details(id_order, id_product, amount) VALUES (in_id_order, temp_id, in_amount);
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
    ROLLBACK TO detail_order;
    RAISE;
END;
/
CREATE OR REPLACE PROCEDURE softdelete_customer (
    in_id_customer IN NUMBER
)
IS
BEGIN
    SAVEPOINT softdelete_customer;
    UPDATE customers SET deleted_at = CURRENT_TIMESTAMP WHERE id_customer = in_id_customer;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
    ROLLBACK TO softdelete_customer;
    RAISE;
END;
/
COMMIT;
/
CREATE OR REPLACE PROCEDURE insert_employee(
    in_username IN VARCHAR2,
    in_password IN VARCHAR2,
    in_name IN VARCHAR2,
    in_role IN VARCHAR2,
    in_phone IN VARCHAR2,
    in_address IN VARCHAR2
)
IS
BEGIN
    SAVEPOINT save1;
    INSERT INTO employees(username, password, name, role, phone, address) VALUES (in_username, in_password, in_name, in_role, in_phone, in_address);
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
    ROLLBACK TO save1;
    RAISE;
END;
/
CREATE OR REPLACE PROCEDURE update_employee(
    in_id_employee IN NUMBER,
    in_password IN VARCHAR2,
    in_name IN VARCHAR2,
    in_address IN VARCHAR2
)
IS
BEGIN
    SAVEPOINT save1;
    UPDATE employees SET password = STANDARD_HASH(in_password, 'MD5'), name = in_name, address = in_address WHERE id_employee = in_id_employee;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
    ROLLBACK TO save1;
    RAISE;
END;
/
CREATE OR REPLACE PROCEDURE softdelete_employee(
    in_id_employee IN NUMBER
)
IS
BEGIN
    SAVEPOINT save1;
    UPDATE employees SET deleted_at = CURRENT_TIMESTAMP WHERE id_employee = in_id_employee;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
    ROLLBACK TO save1;
    RAISE;
END;
/
CREATE OR REPLACE PROCEDURE insert_product(
    in_id_employee IN NUMBER,
    in_id_type IN NUMBER,
    in_name IN VARCHAR2,
    in_unit IN VARCHAR2,
    in_price IN NUMBER,
    in_count IN NUMBER,
    in_expired_at IN VARCHAR2
)
IS
    temp_id_proc NUMBER;
    temp_id_product NUMBER;
BEGIN
    SAVEPOINT save1;
    INSERT INTO procurements(id_employee) VALUES (in_id_employee) RETURNING id_procurement INTO temp_id_proc;
    INSERT INTO products(id_type, name, unit) VALUES (in_id_type, in_name, in_unit) RETURNING id_product INTO temp_id_product;
    INSERT INTO infoprocurements(id_procurement, id_product, count, expired_at) VALUES (temp_id_proc, temp_id_product, in_count, TO_TIMESTAMP(in_expired_at, 'YYYY-MM-DD HH24:MI:SS'));
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
    ROLLBACK TO save1;
    RAISE;
END;
/
CREATE OR REPLACE PROCEDURE update_product(
    in_id_product IN NUMBER,
    in_name IN VARCHAR2,
    in_unit IN VARCHAR2,
    in_price IN NUMBER    
)
IS
    matchval INTEGER;
BEGIN
    SAVEPOINT save1;
    SELECT COUNT(*) INTO matchval FROM prices WHERE id_product = in_id_product AND price = in_price;
    IF (matchval = 0) THEN
        INSERT INTO prices (price) VALUES (in_price);
    END IF;
    UPDATE products SET name = in_name, unit = in_unit WHERE id_product = in_id_product;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
    ROLLBACK TO save1;
    RAISE;
END;
/
CREATE OR REPLACE PROCEDURE softdelete_product(
    in_id_product IN NUMBER
)
IS
BEGIN
    SAVEPOINT save1;
    UPDATE products SET deleted_at = CURRENT_TIMESTAMP WHERE id_product = in_id_product;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
    ROLLBACK TO save1;
    RAISE;
END;
/
CREATE OR REPLACE PROCEDURE add_stock(
    in_id_product IN NUMBER,
    in_id_employee IN NUMBER,
    in_count IN NUMBER,
    in_expired_at IN VARCHAR2
)
IS
    temp_id INTEGER;
BEGIN
    SAVEPOINT save1;
    INSERT INTO procurements (id_employee) VALUES (in_id_employee) RETURNING id_procurement INTO temp_id;
    INSERT INTO infoprocurements(id_procurement, id_product, count, expired_at) VALUES (temp_id, in_id_product, in_count, TO_TIMESTAMP(in_expired_at,'YYYY-MM-DD HH24:MI:SS'));
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
    ROLLBACK TO save1;
    RAISE;
END;
/
CREATE OR REPLACE PROCEDURE add_proc(
    in_id_employee IN NUMBER,
    out_id_procurement OUT NUMBER
)
IS
BEGIN
    SAVEPOINT save1;
    INSERT INTO procurements (id_employee) VALUES (in_id_employee) RETURNING id_procurement INTO out_id_procurement;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
    ROLLBACK TO save1;
END;
/
CREATE OR REPLACE PROCEDURE archive_order (
    in_id_order IN NUMBER
)
IS
BEGIN
    SAVEPOINT save1;
    UPDATE orders SET archived_at = CURRENT_TIMESTAMP WHERE id_order = in_id_order;
    COMMIT;
EXCEPTION
    WHEN OTHERS THEN
    ROLLBACK TO save1;
    RAISE; 
END;
-- VIEW
CREATE OR REPLACE VIEW product_suggestions AS
SELECT pro.id_product, pro.name, pt.type, SUM(bat.stock) AS stock, pro.unit, pro.created_at, pri.price, pri.created_at AS price_at, pro.deleted_at, bat.expired_at
FROM products pro
JOIN prices pri ON pri.id_product = pro.id_product
JOIN producttypes pt ON pt.id_type = pro.id_type
JOIN batches bat ON bat.id_product = pro.id_product
GROUP BY pro.id_product, pro.name, bat.id_product, pt.type, pro.unit, pro.created_at, pri.price, pri.created_at, pro.deleted_at, bat.expired_at;
/
CREATE OR REPLACE VIEW view_types AS
SELECT t.id_type, CONCAT(c.category, CONCAT(' - ', t.type)) AS typetext
FROM producttypes t
JOIN categories c ON t.id_category = c.id_category;
/
CREATE OR REPLACE VIEW view_order_all AS
WITH res AS 
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
ORDER BY created_at DESC;
/
CREATE OR REPLACE VIEW view_order_detail AS
WITH res AS 
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
    archived_at IS NULL
ORDER BY name ASC;
/
CREATE OR REPLACE VIEW view_totalproducts AS
SELECT COUNT(*) AS total_products FROM products WHERE deleted_at IS NULL;
/
CREATE OR REPLACE VIEW view_totalorders AS
SELECT COUNT(*) AS total_orders FROM orders WHERE archived_at IS NULL;
/
CREATE OR REPLACE VIEW view_totalincome AS
WITH res AS 
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
        o.created_at > p.created_at AND
        EXTRACT(MONTH FROM o.created_at) = EXTRACT(MONTH FROM CURRENT_TIMESTAMP)
)
SELECT SUM(subtotal) AS total
FROM res
WHERE
    archived_at IS NULL;
/
CREATE OR REPLACE VIEW view_totalcustomers AS
SELECT COUNT(*) AS total_customers FROM customers WHERE deleted_at IS NULL