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