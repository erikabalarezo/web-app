<?php
//Opens a dconnection to the MYSQL databse
//Shared beteween all the pHP files in our application

$user = getenv('MYSQL_USERNAME');
$pass = getenv('MYSQL_PASSWORD');
$host = getenv('MYSQL_DB_HOST');//The MySQL username
$dbname = getenv('MYSQL_DB_NAME');//The MySQL password

$data_source = sprintf('mysql:host=%s;dbname=%s', $host, $dbname);
//PDO: PHP Data Object
$db = new PDO($data_source, $user, $pass);
$db->exec('SET NAMES utf8');
