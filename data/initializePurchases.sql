CREATE DATABASE Purchases;
use Purchases;
CREATE TABLE purchases (
	purchaseid INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	movietitle VARCHAR(100) NOT NULL,
	price INT(6) NOT NULL
);