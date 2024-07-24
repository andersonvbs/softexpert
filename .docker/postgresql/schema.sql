CREATE SCHEMA IF NOT EXISTS softexpert;

-- -----------------------------------------------------
-- Table softexpert.product_type
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS softexpert.product_type (
  id SERIAL PRIMARY KEY,
  name VARCHAR(200) NOT NULL,
  tax_percentage DECIMAL(5, 2) DEFAULT 0,
  created_at TIMESTAMP NOT NULL,
  updated_at TIMESTAMP
);

-- -----------------------------------------------------
-- Table softexpert.products
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS softexpert.products (
  id SERIAL PRIMARY KEY,
  product_type_id INTEGER NOT NULL,
  name VARCHAR(200) NOT NULL,
  price NUMERIC(8,2) NOT NULL,
  created_at TIMESTAMP NOT NULL,
  updated_at TIMESTAMP,
  CONSTRAINT fk_product_product_type
    FOREIGN KEY (product_type_id)
    REFERENCES softexpert.product_type (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

-- -- -----------------------------------------------------
-- -- Table softexpert.taxe
-- -- -----------------------------------------------------
-- CREATE TABLE IF NOT EXISTS taxe (
--   id SERIAL PRIMARY KEY,
--   name VARCHAR(200) NOT NULL,
--   percentage NUMERIC(10,2) NOT NULL,
--   created_at TIMESTAMP NOT NULL,
--   updated_at TIMESTAMP
-- );

-- -----------------------------------------------------
-- Table softexpert.sales
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS softexpert.sales (
  id SERIAL PRIMARY KEY,
  total_value DECIMAL(10, 2) NOT NULL,
  total_tax DECIMAL(10,2) NOT NULL,
  created_at TIMESTAMP NOT NULL,
  updated_at TIMESTAMP
);

-- -----------------------------------------------------
-- Table softexpert.sales_products
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS softexpert.sales_products (
  sale_id INTEGER NOT NULL,
  product_id INTEGER NOT NULL,
  quantity INTEGER NOT NULL,
  product_value DECIMAL(10, 2) NOT NULL,
  tax_value DECIMAL(10, 2) NOT NULL,
  PRIMARY KEY (sale_id, product_id),
  FOREIGN KEY (sale_id) REFERENCES softexpert.sales(id),
  FOREIGN KEY (product_id) REFERENCES softexpert.products(id)
);