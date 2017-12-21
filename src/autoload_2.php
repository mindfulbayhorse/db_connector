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
                'SingleDBConneciton' => '/var/www/default/manipulation_buttons/db_connector/src/SingleDBConneciton.php',
                'DBconnector' => '/var/www/default/manipulation_buttons/db_connector/src/DBconnector.php',
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