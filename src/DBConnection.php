<?php
declare(strict_types=1);
namespace dbConnector;

/**
 * @author Olga Zhilkova
 * @copyright 2017
 */
abstract class DBConnection
{
     const DEFAULT_HOST='localhost';
     const DEFAULT_HOST_IP='127.0.0.1';
     
    abstract public function checkParams($params);
    
    abstract public function getDns():string;
    
    
    function __sleep()
    {
      return array('dsn', 'username', 'password');
    }
    
    
        
    public function __toString()
    {
      return 'Username '.$this->username.'<br />';
    }
    
    public function __set($name, $value)
    {
        echo "Setting '$name' to '$value'\n";
    }
    
    public function __get($name)
    {
        return null;
      
    }
}


?>