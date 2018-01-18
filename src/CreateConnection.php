<?php

/**
 * @author Olga Zhilkova
 * @copyright 2018
 */
use ParamsReady/SetParamsReady;
namespace CreateConnType;

class CreateConnection implement SetParamsReady
{
  
  function __construct($type_db)
  {
    switch($type_db)
    {
      case MYSQL_TYPE:
       break;       
    }
  }
}

?>