INSERT INTO procurements (id_employee) VALUES (1);
INSERT INTO infoprocurements(id_product, id_procurement, count, expired_at) VALUES (1, 21, 5, TO_TIMESTAMP('2023-12-20 12:00:00', 'YYYY-MM-DD HH24:MI:SS'));
COMMIT;

INSERT INTO orders (id_customer, id_employee, code) VALUES (1,1, DBMS_RANDOM.STRING('X', 10));

INSERT INTO details (id_order, id_product, amount) VALUES (1,1, 10);
INSERT INTO orders (id_customer, id_employee, code) VALUES (1,1, DBMS_RANDOM.STRING('X', 10));
INSERT INTO details (id_order, id_product, amount) VALUES (2,1, 5);
INSERT INTO prices (id_product, price) VALUES (1, 45000);

SELECT * FROM view_types;

INSERT INTO prices (id_product, price) VALUES (1, 45000);
COMMIT;

WITH res AS (
SELECT pro.id_product, pro.name, pt.type, SUM(bat.stock) AS stock, pro.unit, pro.created_at, pri.price, pri.created_at AS price_at, ROW_NUMBER() OVER (
PARTITION BY pro.id_product ORDER BY pri.created_at DESC
) AS parti
FROM products pro
JOIN prices pri ON pri.id_product = pro.id_product
JOIN producttypes pt ON pt.id_type = pro.id_type
JOIN batches bat ON bat.id_product = pro.id_product
WHERE
    TO_NUMBER(TO_CHAR(expired_at, 'YYYYMMDDHH24MISS')) - TO_NUMBER(TO_CHAR((CURRENT_TIMESTAMP + INTERVAL '3' DAY), 'YYYYMMDDHH24MISS')) <> 0 AND
    pro.deleted_at IS NULL
GROUP BY pro.id_product, pro.name, bat.id_product, pt.type, pro.unit, pro.created_at, pri.price, pri.created_at
ORDER BY pro.name ASC, pri.created_at DESC
)
SELECT * FROM res WHERE parti = 1 AND stock > 0;
SELECT * FROM batches WHERE id_product = 1 ORDER BY expired_at ASC;
SELECT * FROM products WHERE upper(name) LIKE upper('INA%');

INSERT INTO details (id_order, id_product, amount) VALUES (51, 1, 3);
