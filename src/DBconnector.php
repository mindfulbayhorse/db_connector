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
    
    public $dbname='';
    public $host='';
    public $params=[];
    
    public $mess_types;
    public $mess=[];

    
    const HOST='host';
    const DBNAME='dbname';
    const DEFAULT_HOST='localhost';
    const ERROR='error';
    const WARNING='warning';
    const INFO='info';
    const SUCCESS='success';
    
    
    protected function setMessegesError($type,$mess)
    {
      $this->$mess[$type][]=$mess;
    }
    
    //identifying and storing each param from string
    public function getParamFromString(string $par_type, string $par_val): void
    {       
        switch ($par_type)
        {
            case self::HOST:
              if($this->checkEmptyParam($par_val)===false)
                try 
                {
                  $this->ensureHostIsValid($par_val);
                }
                catch(InvalidArgumentException $e)
                {                 
                  $this->setMessegesError(self::ERROR,$e->getMessage());
                }
              $this->params[self::HOST]=$par_val;
              break;
            case self::DBNAME:
                $this->checkEmptyParam($par_val);
                $this->params[self::DBNAME]=$par_val;
                break;
            default:
               $this->setMessegesError(self::ERROR,sprintf("Parameter %s is not found!",$par_type));
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
    
    
    //validate host of connection as IP address
    private function ensureHostIsValid(string $host): bool
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
        else
        {
          return true;
        }
    }
    
    private function checkEmptyParam($par_val): bool
    {
      if(empty($par_val))
      {
        $this->$messerror[self::WARNING]=sprintf('Parameter "%s" must not be empty!',$par_val);
        return false;
      }
      
      return true;
    }
    
    //checking out all parameters that needed for connection
    public function checkStringParams($params)
    {
      //get required symbols to check
      foreach($params as $type=>$param)
      {
          //the choice if the first digit is not allowed
          //the choice of minimum length of the param
          //the choice of the maximum length of the param
          //the choice of containing special characters only
      }
    }
    
    //return DNS as string contaning from needed parameters
    public function getDns(): string
    {
        //implement calidation of all params and build DNS string
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