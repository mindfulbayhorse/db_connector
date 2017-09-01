<?php

/**
 * Class for identifying the basic methods for any DB connection object
 * @author Olga Zhilkova
 * @copyright 2017
 */


abstract class DBconnector
{
    
    private function __construct()
    {

    }
    
    abstract function getDns();
    
    abstract function getUsername();
    
    abstract function getPassword();

}



?>