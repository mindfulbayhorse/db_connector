<?php

/**
 * @author Olga Zhilkova
 * @copyright 2018
 */

namespace ParamsReady;

interface SetParamsReady
{
  const MYSQL_TYPE='mysql';
  
  function __construct($type_db);
}

?>