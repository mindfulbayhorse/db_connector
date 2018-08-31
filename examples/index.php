<?php

/**
 * @author Olga Zhilkova
 * @copyright 2018
 */

function my_autoloader($class_name) {
		
	require $class_name.'.class.php';		
}
	
spl_autoload_register('my_autoloader');


?>