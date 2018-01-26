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
    public $messerror=[];

    
    const HOST='host';
    const DBNAME='dbname';
    const DEFAULT_HOST='localhost';
    
    protected function setMessangesTypes()
    {
      $this->mess_types=array('Error'=>false,
                              'Info'=>false,
                              'Success'=>false);
    }
    
    protected function setMessanges()
    {
      $this->$messerror['Error']['not_found']="Parameter is not found!";
    }
    
    //identifying and storing each param from string
    public function getParamFromString(string $par_type, string $par_val): void
    {
        $result=true;
        
        switch ($par_type)
        {
            case self::HOST:
              try 
              {
                $this->ensureHostIsValid($par_val);
              }
              catch(InvalidArgumentException $e)
              {
                $this->mess_types['Error']=true;
                $this->messerror['Error']['invalid_host']=$e->getMessage();
              }
              $this->params[self::HOST]=$par_val;
              break;
            case self::DBNAME:
                $this->params[self::DBNAME]=$par_val;
                break;
            default:
               $this->messerror='';
        }
    }
    
    //getDb nae function to use it in real DB connection
    public function getDBname(string $dbname): bool
    {
      $this->getParamFromString(self::DBNAME,$dbname);
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