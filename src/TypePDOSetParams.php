<?php
declare(strict_types=1);
/**
 * @author Olga Zhilkova
 * @copyright 2018
 */
namespace TypePDOSetParams;
use DBCoonector; 

class TypePDOSetParams implements SetParamsReady
{ 
  public function __construct($typePDO string): void
  {
    switch ($typePDO)
    {
      //create separate class according to type of PDO
      case self::MYSQL_TYPE:
        break;
      default:
        //show exeption message
    }
  }
  
  //get DB name function to use it in real DB connection
  public function getDB(string $dbname): bool
  {
    $this->getParamFromString(self::DBNAME,$dbname);
  }
  
  //get host name function to use it in real DB connection
  public function getHost(string $hostname): bool
  {
    $this->getParamFromString(self::HOST,$hostname);
  }
  
  //validate user name to ensure that it doesn't contain any inapropriate values and start from the digit numbers
  //according to Unix and Windows rules for user name
  private function getUsername(string $usename): string
  {
      $this->username=$username;
  }
  
  //validate password to make sure that it has the minimum and maxsimum length
  private function getPassword(string $password): string
  {
      $this->password=$password;
  }
  
  //return DNS as string contaning from needed parameters
  public function getDns(): string
  {
      //implement validation of all params and build DNS string
      //construct DNS string with all gotten before parameters
      //$this->params[self::DBNAME];
      //$this->params[self::HOST];
      //$this->params[self::PASSWORD];
      //$this->params[self::USERNAME];
      //DNS string must be written depending on type of PDO  
  }
    
    
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