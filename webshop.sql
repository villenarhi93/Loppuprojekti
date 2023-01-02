drop DATABASE if EXISTS webshop;
CREATE DATABASE webshop;
use webshop;
CREATE TABLE category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

INSERT INTO category (name) VALUES ('GROUP 1');
INSERT INTO category (name) VALUES ('GROUP 2');
INSERT INTO category (name) VALUES ('GROUP 3');

CREATE TABLE product (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DOUBLE (10,2) NOT NULL,
    image LONGBOB,
    category_id INT NOT NULL,
    INDEX category_id(category_id),
    FOREIGN KEY (category_id) REFERENCES category(id),
    ON DELETE RESTRICT
);

INSERT INTO product (name, price, category_id) VALUES ('PRODUCT 1', 10, 1);
INSERT INTO product (name, price, category_id) VALUES ('PRODUCT 2', 15, 1);
INSERT INTO product (name, price, category_id) VALUES ('PRODUCT 3', 12, 2);

CREATE TABLE customer (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    address VARCHAR(50) NOT NULL,
    zip VARCHAR(6) NOT NULL,
    city VARCHAR(30) NOT NULL
);

CREATE TABLE order (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    customer_id INT NOT NULL,
    INDEX customer_id(customer_id)  FOREIGN KEY (customer_id) REFERENCES customer(id)
    ON DELETE RESTRICT
);

CREATE TABLE order_row (
    order_id INT NOT NULL,
    INDEX order_id(order_id),
    FOREIGN KEY (order_id) REFERENCES order_id
    ON DELETE RESTRICT,
    product_id INT NOT NULL,
    INDEX product_id(product_id),
    FOREIGN KEY (product_id) REFERENCES product(id)
    ON DELETE RESTRICT
);

CREATE TABLE user (
    username VARCHAR(255) NOT NULL PRIMARY KEY,
    passwd VARCHAR(255) NOT NULL
);

CREATE TABLE admin (
    username VARCHAR(255) NOT NULL PRIMARY KEY,
    passwd VARCHAR(255) NOT NULL
);
