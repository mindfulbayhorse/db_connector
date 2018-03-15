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
    const USERNAME='username';
    const PASSWORD='password';
    const DEFAULT_HOST='localhost';
    
    const ERROR='error';
    const WARNING='warning';
    const INFO='info';
    const SUCCESS='success';
    
    //all messeges found during validation of needed parameters are collected in one array
    protected function setMessegesError($type,$mess)
    {
      $this->$mess[$type][]=$mess;
    }
    
    //identifying and storing each param from string
    public function getParamFromString(string $par_type, string $par_val): void
    {   
        //catch the error if the param value if not string
        switch ($par_type)
        {
            case self::HOST:
              try 
              {
                $this->ensureHostIsValid($par_val);
                $this->params[self::HOST]=$par_val;
              }
              catch(InvalidArgumentException $e)
              {                 
                $this->setMessegesError(self::ERROR,$e->getMessage());
              }
              break;
            case self::DBNAME:
                //neede improved validating for string like length and restricted symbols
                $this->params[self::DBNAME]=$par_val;
                break;
            default:
               $this->setMessegesError(self::ERROR,sprintf("Parameter %s is not found!",$par_type));
        }
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
    
    private function checkEmptyParam($par_type,$par_val): bool
    {
      if(empty($par_val))
      {
        $this->$messerror[self::WARNING]=sprintf('Parameter "%s" must not be empty!',$par_type);
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
    

    //get DB name function to use it in real DB connection
    public function getDB(string $dbname): bool
    {
      if($this->checkEmptyParam(self::DBNAME,$dbname)===false)
        return false; 
      if(!empty($this->params[self::DBNAME]))
        return true;
      else
        return false;
    }
    
    //get host name function to use it in real DB connection
    public function getHost(string $hostname): bool
    {
      //implement method of another class
      if($this->checkEmptyParam(self::HOST,$par_val)===false)
        return false;
      if(!empty($this->params[self::HOST]))
        return true;
      else
        return false;
    }
    
    

}




?>