<?php
/**
 * Small description of this file:
 * Opens a connection to the MySql database
 *
 *use the tags available in phpdoc.org
 *@author Erika Balarezo <erikabalarezo@yahoo.com>
 *@copyright 2012 Erika Balarezo
 *@license BSD-3-Clause http://opensource.org/licenses/BSD-3-Clause 
 *@version 1.0.0
 *@package ottawaforfamilies 
 */

$user = getenv('MYSQL_USERNAME');
$pass = getenv('MYSQL_PASSWORD');
$host = getenv('MYSQL_DB_HOST');//The MySQL username
$dbname = getenv('MYSQL_DB_NAME');//The MySQL password

$data_source = sprintf('mysql:host=%s;dbname=%s', $host, $dbname);
//PDO: PHP Data Object
$db = new PDO($data_source, $user, $pass);
$db->exec('SET NAMES utf8');
