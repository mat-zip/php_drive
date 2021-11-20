CREATE DATABASE php_drive COLLATE 'utf8_unicode_ci';

CREATE TABLE usuarios (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  surname VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  profilePhoto VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
)

ENGINE = InnoDB;