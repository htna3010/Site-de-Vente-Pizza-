﻿<?php

$hostname = "localhost";
$dbname = "u21716137";
$username = "u21716137";
$password = "Bf5zN3XdOgr5";


$dsn = "mysql:host=$hostname;dbname=$dbname;charset=utf8";
$db = new PDO($dsn, $username, $password);
//$dsn = "sqlite:" . __DIR__ . "/../db/users.sqlite";

/*
 Définition de la BD:
 Pour MySQL:

  CREATE TABLE users
(
    userid INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nom VARCHAR(30),
    prenom VARCHAR(30),
    login VARCHAR(30) NOT NULL UNIQUE,
    mdp VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user' NOT NULL
)

Pour SQLite:

CREATE TABLE users
(
    userid INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    nom VARCHAR(30),
    prenom VARCHAR(30),
    login VARCHAR(30) NOT NULL,
    mdp VARCHAR(255) NOT NULL,
    role CHECK(role in ('user', 'admin')) DEFAULT 'user' NOT NULL
)
CREATE UNIQUE INDEX users_login_uindex ON users (login)

 */
?>