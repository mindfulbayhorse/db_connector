<?php
declare(strict_types=1);
/**
 * @author Olga Zhilkova
 * @copyright 2018
 */

namespace DBParams;

interface SetParamsReady
{
  
  public function __construct($typePDO string): void;
  
  public function buildDBStructure(): bool;
  
}

?>