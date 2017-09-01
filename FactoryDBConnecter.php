<?php
/**
 * @author Olga Zhilkova
 * @copyright 2017
 */

declare(strict_types=1);

final class FactoryDBConnecter
{
    public static function build(string $driver)
    {
        $connectore_type=$driver."Connector";
        if(class_exists($connectore_type))
        {
            return new $connectore_type();
        }
        else
        {
            throw new Exception("Invalid driver is given.");
        }
    }
    
    
}

?>