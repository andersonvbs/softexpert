CREATE SCHEMA IF NOT EXISTS softexpert;

-- -----------------------------------------------------
-- Table softexpert.product_type
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS product_type (
  id SERIAL PRIMARY KEY,
  name VARCHAR(200) NOT NULL,
  created_at TIMESTAMP NOT NULL,
  updated_at TIMESTAMP
);

-- -----------------------------------------------------
-- Table softexpert.products
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS products (
  id SERIAL PRIMARY KEY,
  product_type_id INTEGER NOT NULL,
  name VARCHAR(200) NOT NULL,
  value NUMERIC(8,2) NOT NULL,
  created_at TIMESTAMP NOT NULL,
  updated_at TIMESTAMP,
  CONSTRAINT fk_product_product_type
    FOREIGN KEY (product_type_id)
    REFERENCES product_type (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

-- -----------------------------------------------------
-- Table softexpert.taxe
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS taxe (
  id SERIAL PRIMARY KEY,
  name VARCHAR(200) NOT NULL,
  percentage NUMERIC(10,2) NOT NULL,
  created_at TIMESTAMP NOT NULL,
  updated_at TIMESTAMP
);
