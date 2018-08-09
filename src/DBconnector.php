<?php
declare(strict_types=1);
//namespace dbConnector;
/**
 * Class for implementing validation parameters for database connection
 * @author Olga Zhilkova
 * @copyright 2017
 */
class DBconnector extends SingleDBConnection
{
    
    protected $username='';
    protected $password='';
    protected $dns='';
    
    public $dbname='';
    public $host='';
    public $params=[];
    
    public $mess_types;
    public $mess=[];
    public $paramNames=[];
    public $errorTypes=[];
    public $allowedSymbols=[];
    public $restrictedWords=[];
    public $restrictedFirstSymbol=[];
    public $restrictedLastSymbol=[];
    public $allowedMinLength=[];

    
    const HOST='host';
    const DBNAME='dbname';
    const USERNAME='username';
    const PASSWORD='password';
    const DEFAULT_HOST='localhost';
    
    function __construct() {
     $this->setBeginningParams();
     $this->setTypeError(); 
     $this->setAllowedSymbols();
     $this->setRestrictedFirstSymbolPatterns();
     $this->setRestrictedLastSymbolPatterns();
    }
    
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
    
    public function setTypeError(): void
    {
      $this->errorTypes=array(
        'restricted_first_symbol'=>'starts from restricted symbol %s',
        'allowed_symbols'=>'must include digits only',
        'minimum_legth'=>'must have minimum legth of %d symbols',
        'restricted_symbols'=>'must not consists of restricted symbols %s',
        'allowed_pattern'=>'must only follow the pattern %s',
        'restricted_last_symbol'=>'cannot end with %s character',
        'restricted_words'=>'Credentials must be changed before connecting!'
      );
    }
    
    public function setAllowedSymbols(): void
    {
      $this->allowedSymbols=array(
        self::DBNAME=>array('[a-zA-Z_\$\d]*'),
        self::USERNAME=>array('@','[\w]')
      );
    }
    
    public function setRestrictedWordPatterns():void
    {
      $this->restrictedWords=array('root');
    }
    
    public function setRestrictedFirstSymbolPatterns():void
    {
      $this->restrictedFirstSymbol=array(
        self::DBNAME=>'[a-zA-Z]+'
      );
    }
    
    public function setRestrictedLastSymbolPatterns():void
    {
      $this->restrictedLastSymbol=array(
         self::DBNAME=>''
      );
    }
    
    public function setPossiblePatterns():void
    {
      $this->possiblePatterns=array(
        $this->errorTypes['allowed_first_symbol']=>array('pattern'=>'^\d'),
        $this->errorTypes['allowed_pattern']=>'\d*'
      );
    }
    
    public function buildPattern($typePar):string
    {
      $patternString='';
      switch ($typePar)
      {
        case self::DBNAME:
          if(!empty($this->restrictedFirstSymbol[self::DBNAME]))
            $patternString .='^'.$this->restrictedFirstSymbol[self::DBNAME];
          if(!empty($this->allowedSymbols[self::DBNAME]))
            foreach($this->allowedSymbols[self::DBNAME] as $symbols)
            {
              $patternString .=$symbols;
            }
          if(isset($this->restrictedLastSymbol[self::DBNAME]))
            $patternString .=$this->restrictedLastSymbol[self::DBNAME].'$';
        break;
        case self::USERNAME:
          break;
        default:
          return '';
      }
      
      return $patternString;
    }
    
    public function setAllowedLength():void
    {
      $this->allowedMinLength=array(
        self::USERNAME=>1
      );
      
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