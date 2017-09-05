<?php

/**
 * @author Olga Zhilkova
 * @copyright 2017
 */

spl_autoload_register(
    function($class) {
        static $classes = null;
        if ($classes === null) {
            $classes = array(
                'MysqlConnector' => 'MysqlConnector.php',
            );
        }
        $cn = strtolower($class);
        if (isset($classes[$cn])) {
            require __DIR__ . $classes[$cn];
        }
    },
    true,
    false
);

?>