<?php
declare(strict_types=1);
namespace factoryDB;
/**
 * Class for implementing validation parameters for database connection
 * @author Olga Zhilkova
 * @copyright 2017
 */
class DBconnector extends SingleDBConnection
{
    
    protected $user='';
    protected $password='';
    protected $dns='';
    
    public $params=[];
    public $mess_types;
    public $messerror='';

    
    const HOST='host';
    const DBNAME='dbname';
    const DEFAULT_HOST='localhost';
    
    protected function setTypesMessanges()
    {
      $this->mess_types=array('not_found'=>"Parameter is not found!");
    }
    
    //identifying and storing each param from string
    public function getParamFromString(string $par_type, string $par_val): bool
    {
        $result=true;
        
        switch ($par_type)
        {
            case self::HOST:
                $this->ensureHostIsValid($par_val);
                $this->params[self::HOST]=$par_val;
                break;
            case self::DBNAME:
                $this->params[self::DBNAME]=$par_val;
                break;
            default:
               return false;
        }
        return true;
    }
    
    
    //validate host of connection as IP address
    private function ensureHostIsValid(string $host): void
    {
        if($host!==self::DEFAULT_HOST)
        {
            if (!filter_var($host, FILTER_VALIDATE_IP))
            {
                throw new InvalidArgumentException(
                    sprintf('"%s" is not a valid IP address',
                    $host
                    )
                );
            }
        }

    }
    
    //checking out all parameters that needed for connection
    public function checkParams($params)
    {
      foreach($params as $type=>$param)
      {
        //if($this->getParamFromString($type,$param)!==false)
        //{

        //}
      }
    }
    
    //return DNS as string contaning from needed parameters
    public function getDns(): string
    {
        
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
    
    //returning each params for further validation
    /*public function getParam(string $par_type): void
    {
        switch ($par_type)
        {
            case self::HOST:
                $this->params[self::HOST];
                break;
            case self::DBNAME:
                $this->params[self::DBNAME];
                break;
            default:
                return false;
        }
        
        return true;
    }*/
    
    

}




?>