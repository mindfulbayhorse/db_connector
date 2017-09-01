<?php

/**
 * @author Olga Zhilkova
 * @copyright 2017
 */

function my_autoloader($class) {
    include 'classes/' . $class . '.class.php';
}

spl_autoload_register('MysqlConnector');


?>