<?php
declare(strict_types=1);
/**
 * @author Olga Zhilkova
 * @copyright 2018
 */

namespace ParamsReady;

interface SetParamsReady
{
  const MYSQL_TYPE='mysql';
  const SQLIGHT_TYPE='sqlite';
  const POSTGRESQL_TYPE='postgresql';
  
  public function __construct($typePDO string): void;
  
}

?>