<?php
declare(strict_types=1);
/**
 * @author Olga Zhilkova
 * @copyright 2018
 */

namespace dbConnector;

trait DisplayMessages{

  
  const INFO='INFO';
  const WARNING='WARNING';
  const ERROR='ERROR';
  const SUCCESS='SUCCESS';
  
  
  private $messSubtypes=[
            'Empty'=>'%s cannot be empty!',
            'Incorrect'=>'%s is incorrect'!,
            'Restricted_symbols'=>'%s contains restricted symbols!',
            ''];
  
  public function constractMessage($type)
  {
    
  }
  
  public function defineMessSubtypes(){
    
  }
  
}

?>