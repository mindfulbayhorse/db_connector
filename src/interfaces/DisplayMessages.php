<?php
declare(strict_types=1);
/**
 * @author Olga Zhilkova
 * @copyright 2018
 */

namespace dbConnector;

interface DisplayMessages{

  
  const INFO='INFO';
  const WARNING='WARNING';
  const ERROR='ERROR';
  const SUCCESS='SUCCESS';
  
  
  private $messSubtypes=[
            'Empty'=>'%s cannot be empty!',
            'Incorrect'=>'%s is incorrect'!,
            'Restricted_symbols'=>'%s contains restricted symbols!',
            'Max_length'=>'%s  must have maximum length of %s symbols'];
  
  public function constractMessage($type);
  
  public function defineMessSubtypes();
  
}

?>