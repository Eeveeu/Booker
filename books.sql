-- LABORATORNAYA RABOTA #1 i #2
-- Magazin "KnigoMaks/Bukvofil"

CREATE DATABASE IF NOT EXISTS books CHARACTER SET utf8 COLLATE utf8_general_ci;
USE books;

CREATE TABLE IF NOT EXISTS customers (
  customerid INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  address VARCHAR(100) NOT NULL,
  city VARCHAR(30) NOT NULL
);

CREATE TABLE IF NOT EXISTS orders (
  orderid INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  customerid INT UNSIGNED NOT NULL,
  amount FLOAT(6,2),
  date DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS books (
  isbn VARCHAR(13) NOT NULL PRIMARY KEY,
  author VARCHAR(50),
  title VARCHAR(100),
  price FLOAT(6,2)
);

CREATE TABLE IF NOT EXISTS order_items (
  orderid INT UNSIGNED NOT NULL,
  isbn VARCHAR(13) NOT NULL,
  quantity TINYINT UNSIGNED,
  PRIMARY KEY (orderid, isbn)
);

CREATE TABLE IF NOT EXISTS book_reviews (
  isbn VARCHAR(13) NOT NULL PRIMARY KEY,
  review TEXT
);

INSERT INTO customers (customerid, name, address, city) VALUES
(1, 'Ivanov Ivan Ivanovich', 'Transportnaya, 23-45', 'Saransk'),
(2, 'Petrov Petr Petrovich', 'Moskovskaya, 12-4', 'Saransk'),
(3, 'Sidorov Sidor Sidorovich', 'Sovetskaya, 7-5', 'Saransk'),
(4, 'Grigoriev Grigoriy Grigorievich', 'Lenina, 84-12', 'Ruzaevka'),
(5, 'Denisov Denis Denisovich', 'Proletarskaya, 90-67', 'Ruzaevka');

INSERT INTO orders (orderid, customerid, amount, date) VALUES
(1, 1, 101.00, '2006-10-02'),
(2, 2, 3000.80, '2006-08-12'),
(3, 3, 4500.40, '2006-08-13'),
(4, 4, 1871.73, '2006-07-23'),
(5, 5, 1500.91, '2006-08-24'),
(6, 1, 3000.00, '2006-07-09'),
(7, 2, 362.70, '2006-10-12'),
(8, 3, 2107.90, '2006-09-15'),
(9, 4, 6001.60, '2006-09-27'),
(10, 5, 20.20, '2006-09-30');

INSERT INTO books (isbn, author, title, price) VALUES
('0-672-31697-8', 'Chaynikov V.', 'MySQL dlya chaynikov', 120.90),
('0-672-89765-6', 'Profi S.', 'MySQL dlya professionalov', 432.70),
('0-672-26743-2', 'Braun D.', 'MySQL dlya studentov kooperativnogo instituta', 1500.00),
('0-672-09876-3', 'Chaynikov V.', 'PHP dlya chaynikov', 100.90),
('0-672-45637-4', 'Profi S.', 'PHP dlya professionalov', 300.50),
('0-672-23456-6', 'Braun D.', 'PHP dlya studentov kooperativnogo instituta', 1500.40),
('0-672-23769-8', 'Aleksandrov L.', 'Zachet po elektronnoy kommercii za 5 minut', 1.01);

INSERT INTO order_items (orderid, isbn, quantity) VALUES
(1, '0-672-23769-8', 100),
(2, '0-672-23456-6', 2),
(2, '0-672-31697-8', 1),
(3, '0-672-26743-2', 3),
(4, '0-672-23769-8', 5),
(4, '0-672-31697-8', 8),
(5, '0-672-45637-4', 3),
(5, '0-672-09876-3', 2),
(6, '0-672-89765-6', 3),
(6, '0-672-23769-8', 1),
(7, '0-672-26743-2', 1),
(8, '0-672-09876-3', 6),
(8, '0-672-45637-4', 5),
(9, '0-672-23456-6', 4),
(9, '0-672-23769-8', 20);

INSERT INTO book_reviews (isbn, review) VALUES
('0-672-31697-8', 'Uvlekatelnoe chtenie garantirovano!'),
('0-672-89765-6', 'Ochen nuzhnaya i poleznaya kniga.'),
('0-672-26743-2', 'Kniga polnostyu raskryla problematiku izucheniya MySQL v kooperativnom institute.'),
('0-672-09876-3', 'Interesno pochti na kazhdoy stranice.'),
('0-672-23456-6', 'Kniga posvyashchena opisaniyu standarta operatora ECHO.');

CREATE OR REPLACE VIEW books_with_sales AS
SELECT 
    b.isbn,
    b.author,
    b.title,
    b.price,
    COALESCE(SUM(oi.quantity), 0) as sum_order_items_quantity
FROM books b
LEFT JOIN order_items oi ON b.isbn = oi.isbn
GROUP BY b.isbn, b.author, b.title, b.price;
