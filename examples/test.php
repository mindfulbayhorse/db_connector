<?php

/**
 * @author Olga Zhilkova
 * @copyright 2018
 */
use factoryDB\DBconnector;

//define the type of the db
const TYPE_DB='mysql';
//create class with MYSQl name to ensure that another foundation calsses are not used and not modified
//$mysql_obj = new DBconnector;
$dsn = 'mysql:host=localhost;dbname=testdb';
$dbname='';
$host='localhost';
$username = 'username';
$password = 'password';
//$mysql->checkParams($username,$password,$host,$dbname);
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
); 

try {
    $dbh = new PDO($dns, $username, $password);
    foreach($dbh->query('SELECT * from WBS') as $row) {
        print_r($row);
    }
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>