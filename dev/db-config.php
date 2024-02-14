<?php

const DB_HOST = "localhost:3306";

const DB_NAME = "db_intro";

const DB_USER = "root";

const DB_PASSWORD = "";

$pdo = new PDO(dsn: "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, username: DB_USER, password: DB_PASSWORD);
