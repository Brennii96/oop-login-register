# OOP Login and Register
Reusable OOP login and register.

Use the following code to test if you have bcrypt enabled (alternatively check echo phpinfo): <br>
`<?php
if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
    echo "CRYPT_BLOWFISH is enabled!";
}else {
echo "CRYPT_BLOWFISH is not available";
}`


Create the Users table: <br>
``CREATE TABLE `oop_login_register`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(20) NULL,
  `email` VARCHAR(45) NULL,
  `password` VARCHAR(128) NULL,
  `salt` VARCHAR(32) NULL,
  `name` VARCHAR(50) NULL,
  `group` INT NULL,
  `joined` DATETIME NULL,
  PRIMARY KEY (`id`));
``

Create the groups table: <br>
``CREATE TABLE `oop_login_register`.`groups` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) NULL,
  `permissions` TEXT NULL,
  PRIMARY KEY (`id`));``


Create the users sessions table: <br>
``CREATE TABLE `oop_login_register`.`users_sessions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NULL,
  `hash` VARCHAR(50) NULL,
  PRIMARY KEY (`id`));
``
