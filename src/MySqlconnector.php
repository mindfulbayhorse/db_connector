<?php
declare(strict_types=1);
namespace dbConnector;
/**
 * Class for implementing validation parameters for database connection
 * @author Olga Zhilkova
 * @copyright 2017
 */
class MySqlConnector extends DBConnection
{
    
    protected $username='';
    protected $password='';
    protected $dns='';
    
    public $dbname='';
    public $host='';
    public $params=[];
    
    

    const DNS_PREFIX='mysql:';
    const HOST='host';
    const DBNAME='dbname';
    const USERNAME='username';
    const PASSWORD='password';
    const DEFAULT_HOST='localhost';
    

    
    public function checkParams($params)
    {
      
    }
    
    public function getDns():string
    {
      
    }
    
    
    public function setBeginningParams():void
    {
      $this->params=array(
        self::HOST=>'localhost',
        self::DBNAME=>'',
        self::PASSWORD=>'',
        self::USERNAME=>''
      );
      
    }
    
    
    
    public function setRestrictedWordPatterns():void
    {
      $this->restrictedWords=array('root');
    }
    
    
    
    
    protected function setParamNames(): void
    {
      $this->paramNames=[
        self::HOST=>'host',
        self::DBNAME=>'database',
        self::POST=>'port',
        self::USERNAME=>'user name',
        self::PASSWARD=>'password'
      ];
      
    }
    
    //all messeges found during validation of needed parameters are collected in one array
    public function setMessegesError($type,$mess)
    {
      $this->$mess[$type][]=$mess;
    }
    
    public function setMessage($name_par,$val_par):string
    {
      $mess="Parameter '$name_par' %s $val_par!";
      return $mess;
    }
    
   
    
    //identifying and storing each param from string
    public function getParamFromString(string $par_type, string $par_val): void
    {   
        //catch the error if the param value if not string
        switch ($par_type)
        {
            case self::HOST:
              if(empty($par_val))
                  $strMess=$this->setMessage($this->paramsNames[self::HOST],$par_val);
              else
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
                //need to be improved validating for string like length and restricted symbols
                if(empty($par_val))
                  $strMess=$this->setMessage($this->paramsNames[self::DBNAME],$par_val);
                  $pattern=$this->buildPattern(self::DBNAME);
                if(preg_match('#'.$pattern.'#',$par_val))
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
    
    /*private function checkEmptyParam($par_type,$par_val): bool
    {
      if(empty($par_val))
      {
        $this->$messerror[self::WARNING]=sprintf('Parameter "%s" must not be empty!',$par_type);
        return false;
      }
      
      return true;
    }*/
    
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