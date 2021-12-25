-- Generated by Oracle SQL Developer Data Modeler 21.2.0.183.1957
--   at:        2021-12-21 13:44:04 ICT
--   site:      Oracle Database 11g
--   type:      Oracle Database 11g

-- predefined type, no DDL - MDSYS.SDO_GEOMETRY
-- predefined type, no DDL - XMLTYPE
CREATE TABLE batches (
    id_batch   INTEGER GENERATED ALWAYS as IDENTITY(START with 1 INCREMENT by 1),
    id_product INTEGER NOT NULL,
    stock      INTEGER NOT NULL CHECK (stock > -1),
    created_at TIMESTAMP DEFAULT systimestamp,
    expired_at TIMESTAMP NOT NULL,
    CONSTRAINT batches_PK PRIMARY KEY (id_batch)
);
/
CREATE TABLE categories (
    id_category INTEGER GENERATED ALWAYS as IDENTITY(START with 1 INCREMENT by 1),
    category    VARCHAR2(50) NOT NULL,
    CONSTRAINT categories_PK PRIMARY KEY (id_category)
);
/
CREATE TABLE customers (
    id_customer INTEGER GENERATED ALWAYS as IDENTITY(START with 1 INCREMENT by 1),
    name        VARCHAR2(50) NOT NULL,
    phone       VARCHAR2(20) NOT NULL,
    address     VARCHAR2(255) NOT NULL,
    created_at  TIMESTAMP DEFAULT systimestamp,
    updated_at  TIMESTAMP DEFAULT systimestamp,
    deleted_at  TIMESTAMP DEFAULT NULL,
    CONSTRAINT customers_PK PRIMARY KEY (id_customer),
    CONSTRAINT customers_UN UNIQUE (phone)
);
/
CREATE TABLE details (
    id_order   INTEGER NOT NULL,
    id_product INTEGER NOT NULL,
    amount     INTEGER NOT NULL CHECK (amount > 0),
    CONSTRAINT details_PK PRIMARY KEY(id_order, id_product)
);
/
CREATE TABLE employees (
    id_employee INTEGER GENERATED ALWAYS as IDENTITY(START with 1 INCREMENT by 1),
    username    VARCHAR2(50) NOT NULL,
    password    VARCHAR2(50) NOT NULL,
    name        VARCHAR2(100) NOT NULL,
    role        VARCHAR2(20) NOT NULL CHECK (role IN ('Administrator', 'Cashier', 'Manager')),
    phone       VARCHAR2(20) NOT NULL,
    address     VARCHAR2(255) NOT NULL,
    photo       BLOB,
    created_at  TIMESTAMP DEFAULT systimestamp,
    updated_at  TIMESTAMP DEFAULT systimestamp,
    deleted_at  TIMESTAMP DEFAULT NULL,
    CONSTRAINT employees_PK PRIMARY KEY (id_employee),
    CONSTRAINT employees_UN UNIQUE(username, phone)
);
/
CREATE TABLE infoprocurements (
    id_procurement INTEGER NOT NULL,
    id_product     INTEGER NOT NULL,
    count          INTEGER NOT NULL CHECK (count > 0),
    expired_at     TIMESTAMP NOT NULL,
    CONSTRAINT infoproc_PK PRIMARY KEY (id_procurement, id_product)
);
/
CREATE TABLE orders (
    id_order    INTEGER GENERATED ALWAYS as IDENTITY(START with 1 INCREMENT by 1),
    id_customer INTEGER NOT NULL,
    id_employee INTEGER NOT NULL,
    code        VARCHAR2(20) NOT NULL,
    created_at  TIMESTAMP DEFAULT systimestamp,
    archived_at TIMESTAMP DEFAULT NULL,
    CONSTRAINT orders_PK PRIMARY KEY (id_order),
    CONSTRAINT orders_UN UNIQUE (code)
);
CREATE TABLE prices (
    id_price   INTEGER GENERATED ALWAYS as IDENTITY(START with 1 INCREMENT by 1),
    id_product INTEGER NOT NULL,
    price      INTEGER NOT NULL CHECK (price > 0),
    created_at TIMESTAMP DEFAULT systimestamp,
    CONSTRAINT prices_PK PRIMARY KEY (id_price)
);
/
CREATE TABLE procurements (
    id_procurement INTEGER GENERATED ALWAYS as IDENTITY(START with 1 INCREMENT by 1),
    id_employee    INTEGER NOT NULL,
    created_at     TIMESTAMP DEFAULT systimestamp,
    CONSTRAINT procurements_PK PRIMARY KEY (id_procurement)
);
/
CREATE TABLE products (
    id_product INTEGER GENERATED ALWAYS as IDENTITY(START with 1 INCREMENT by 1),
    id_type    INTEGER NOT NULL,
    name       VARCHAR2(255) NOT NULL,
    unit       VARCHAR2(20),
    photo      BLOB,
    created_at TIMESTAMP DEFAULT systimestamp,
    updated_at TIMESTAMP DEFAULT systimestamp,
    deleted_at TIMESTAMP DEFAULT NULL,
    CONSTRAINT products_PK PRIMARY KEY (id_product)
);
/
CREATE TABLE producttypes (
    id_type     INTEGER GENERATED ALWAYS as IDENTITY(START with 1 INCREMENT by 1),
    id_category INTEGER NOT NULL,
    type        VARCHAR2(50) NOT NULL,
    CONSTRAINT producttypes_PK PRIMARY KEY (id_type)
);
/
ALTER TABLE batches
ADD CONSTRAINT batches_products_fk FOREIGN KEY (id_product)
REFERENCES products (id_product)
ON DELETE CASCADE;
/
ALTER TABLE details
ADD CONSTRAINT details_orders_fk FOREIGN KEY (id_order)
REFERENCES orders (id_order)
ON DELETE CASCADE;
/
ALTER TABLE details
ADD CONSTRAINT details_products_fk FOREIGN KEY (id_product)
REFERENCES products (id_product)
ON DELETE CASCADE;
/
ALTER TABLE infoprocurements
ADD CONSTRAINT infoproc_procurements_fk FOREIGN KEY (id_procurement)
REFERENCES procurements (id_procurement)
ON DELETE CASCADE;
/
ALTER TABLE infoprocurements
ADD CONSTRAINT infoproc_products_fk FOREIGN KEY (id_product)
REFERENCES products (id_product)
ON DELETE CASCADE;
/
ALTER TABLE orders
ADD CONSTRAINT orders_customers_fk FOREIGN KEY (id_customer)
REFERENCES customers (id_customer)
ON DELETE CASCADE;
/
ALTER TABLE orders
ADD CONSTRAINT orders_employees_fk FOREIGN KEY (id_employee)
REFERENCES employees (id_employee)
ON DELETE CASCADE;
/
ALTER TABLE prices
ADD CONSTRAINT prices_products_fk FOREIGN KEY (id_product)
REFERENCES products (id_product)
ON DELETE CASCADE;
/
ALTER TABLE procurements
ADD CONSTRAINT procurements_employees_fk FOREIGN KEY (id_employee)
REFERENCES employees (id_employee)
ON DELETE CASCADE;
/
ALTER TABLE products
ADD CONSTRAINT products_producttypes_fk FOREIGN KEY (id_type)
REFERENCES producttypes (id_type)
ON DELETE CASCADE;
/
ALTER TABLE producttypes
ADD CONSTRAINT producttypes_categories_fk FOREIGN KEY (id_category)
REFERENCES categories (id_category)
ON DELETE CASCADE;
/
-- Triggers
CREATE OR REPLACE TRIGGER employees_updated_at BEFORE UPDATE ON employees FOR EACH ROW
BEGIN
:new.updated_at := current_timestamp();
EXCEPTION
    WHEN OTHERS THEN
        RAISE;
END;
/
CREATE OR REPLACE TRIGGER customers_updated_at BEFORE UPDATE ON customers FOR EACH ROW
BEGIN
:new.updated_at := current_timestamp();
EXCEPTION
    WHEN OTHERS THEN
        RAISE;
END;
/
CREATE OR REPLACE TRIGGER products_updated_at BEFORE UPDATE ON products FOR EACH ROW
BEGIN
:new.updated_at := current_timestamp();
EXCEPTION
    WHEN OTHERS THEN
        RAISE;
END;
/
CREATE OR REPLACE TRIGGER procurements_id_employee BEFORE INSERT ON procurements FOR EACH ROW
DECLARE
    temp_role VARCHAR2(20);
BEGIN
    SELECT role INTO temp_role FROM employees WHERE id_employee = :new.id_employee;
    IF temp_role NOT IN ('Administrator', 'Manager') THEN
        raise_application_error(-20000, 'Only Administrator or Manager can insert');
    END IF;
EXCEPTION
    WHEN OTHERS THEN
        RAISE;
END;
/
CREATE OR REPLACE TRIGGER infoprocs_count AFTER INSERT ON infoprocurements FOR EACH ROW
DECLARE
    row_count INTEGER;
BEGIN
    SELECT COUNT(*) INTO row_count FROM batches WHERE expired_at = :new.expired_at AND id_product = :new.id_product;
    IF (row_count > 0) THEN
        UPDATE batches SET stock = stock + :new.count WHERE id_product = :new.id_product AND expired_at = :new.expired_at;
    ELSE
        INSERT INTO batches (id_product, stock, expired_at) VALUES (:new.id_product, :new.count, :new.expired_at);
    END IF;
EXCEPTION
    WHEN OTHERS THEN
        RAISE;
END;
/
--CREATE OR REPLACE TRIGGER infoprocs_count2 AFTER UPDATE ON infoprocurements FOR EACH ROW
--BEGIN
--    IF (:old.count > :new.count) THEN
--        UPDATE batches SET stock = stock + (:old.count - :new.count) WHERE id_product = :old.id_product AND expired_at = :old.expired_at;
--    ELSE IF (:old.count < :new.count) THEN
--        UPDATE batches SET stock = stock - (:new.count - :old.count) WHERE id_product = :old.id_product AND expired_at = :old.expired_at;
--    ELSE
--    END;
--END;

CREATE OR REPLACE TRIGGER batches_stock AFTER INSERT ON details
FOR EACH ROW
DECLARE
    temp_id INTEGER;
BEGIN
    SELECT id_batch INTO temp_id FROM batches
    WHERE
        id_product = :new.id_product AND
        TO_NUMBER(TO_CHAR(expired_at, 'YYYYMMDDHH24MISS')) - TO_NUMBER(TO_CHAR((CURRENT_TIMESTAMP + INTERVAL '3' DAY), 'YYYYMMDDHH24MISS')) <> 0 AND
        stock > 0
    ORDER BY expired_at ASC FETCH FIRST 1 ROWS ONLY;
    
    UPDATE batches SET stock = stock - :new.amount WHERE id_batch = temp_id;
EXCEPTION
    WHEN OTHERS THEN
        RAISE;
END;
/

DROP TABLE batches;
DROP TABLE prices;
DROP TABLE details;
DROP TABLE orders;
DROP TABLE infoprocurements;
DROP TABLE procurements;
DROP TABLE products;
DROP TABLE producttypes;
DROP TABLE categories;
DROP TABLE employees;
DROP TABLE customers;
-- Oracle SQL Developer Data Modeler Summary Report: 
-- 
-- CREATE TABLE                            11
-- CREATE INDEX                             0
-- ALTER TABLE                             26
-- CREATE VIEW                              0
-- ALTER VIEW                               0
-- CREATE PACKAGE                           0
-- CREATE PACKAGE BODY                      0
-- CREATE PROCEDURE                         0
-- CREATE FUNCTION                          0
-- CREATE TRIGGER                           0
-- ALTER TRIGGER                            0
-- CREATE COLLECTION TYPE                   0
-- CREATE STRUCTURED TYPE                   0
-- CREATE STRUCTURED TYPE BODY              0
-- CREATE CLUSTER                           0
-- CREATE CONTEXT                           0
-- CREATE DATABASE                          0
-- CREATE DIMENSION                         0
-- CREATE DIRECTORY                         0
-- CREATE DISK GROUP                        0
-- CREATE ROLE                              0
-- CREATE ROLLBACK SEGMENT                  0
-- CREATE SEQUENCE                          0
-- CREATE MATERIALIZED VIEW                 0
-- CREATE MATERIALIZED VIEW LOG             0
-- CREATE SYNONYM                           0
-- CREATE TABLESPACE                        0
-- CREATE USER                              0
-- 
-- DROP TABLESPACE                          0
-- DROP DATABASE                            0
-- 
-- REDACTION POLICY                         0
-- 
-- ORDS DROP SCHEMA                         0
-- ORDS ENABLE SCHEMA                       0
-- ORDS ENABLE OBJECT                       0
-- 
-- ERRORS                                   0
-- WARNINGS                                 0