CREATE TABLE IF NOT EXISTS product_types (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    tax_rate DECIMAL(5, 2) NOT NULL
);

CREATE TABLE IF NOT EXISTS products (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    product_type_id INT NOT NULL,
    FOREIGN KEY (product_type_id) REFERENCES product_types (id)
);

CREATE TABLE IF NOT EXISTS sales (
    id SERIAL PRIMARY KEY,
    total_price DECIMAL(10, 2) NOT NULL,
    total_tax DECIMAL(10, 2) NOT NULL
);

CREATE TABLE IF NOT EXISTS items_sale (
    id SERIAL PRIMARY KEY,
    product_id INT NOT NULL,
    sale_id INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    quantity DECIMAL(10, 2) NOT NULL,
    total_tax DECIMAL(10, 2) NOT NULL,
    total_item DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products (id),
    FOREIGN KEY (sale_id) REFERENCES sales (id)
);