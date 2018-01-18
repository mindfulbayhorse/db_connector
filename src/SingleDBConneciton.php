<?php
declare(strict_types=1);
namespace factoryDB;

/**
 * @author Olga Zhilkova
 * @copyright 2017
 */
abstract class SingleDBConnection
{

    protected $user='';
    protected $password='';
    protected $dns='';
    
    public $params=[];

    public function checkParams($params)
    {
      
    }
    
    public function getDns():string
    {
      
    }
}


?>