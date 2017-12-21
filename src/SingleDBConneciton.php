<?php
namespace factoryDB;

/**
 * @author Olga Zhilkova
 * @copyright 2017
 */
abstract class SingleDBConnection
{

    protected $host='';
    protected $user='';
    protected $password='';
    protected $dns='';
    protected $dbname='';

    public function checkParams()
    {
      
    }
}


?>