<?php
/**
 * @author Olga Zhilkova
 * @copyright 2018
 */
namespace DB_Params; 

class MySQLParams extends DBconnector 
{
  const DSN_PREFIX="mysql";
  
  protected $host='';
  protected $user='';
  protected $password='';
  protected $dns='';

  protected $requiredParams=[self::DBNAME,self::HOST];

  public function checkParams()
  {
    foreach($requiredParams as $param)
    {
      if(!empty($this->params[$param]))
      {
        //check each params for type and value
      }
    }
    return true;
  }
  
}

?>