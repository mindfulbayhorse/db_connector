<?php
declare(strict_types=1);
/**
 * @author Olga Zhilkova
 * @copyright 2018
 */

namespace dbConnector;

trait ValidateValue
{
  private $matches=[];
  
  public max_length=10;
  
    /*public $mess_types;
    public $mess=[];
    public $paramNames=[];
    public $errorTypes=[];
    public $allowedSymbols=[];
    public $restrictedWords=[];
    public $restrictedFirstSymbol=[];
    public $restrictedLastSymbol=[];
    public $allowedMinLength=[];
    public $possiblePatterns=[];
    */
    
  function isPatternValid(string $pattern, $value):bool
  {
    if(!empty($value) && strlen($value)<=$this->max_length)
        if(preg_match('/'.$pattern.'/', $value, $this->matches, PREG_OFFSET_CAPTURE))
            return true;
        else
            return false;
  }
  
    /*function __construct() {
        $this->setBeginningParams();
        $this->setTypeError(); 
        $this->setAllowedSymbols();
        $this->setRestrictedFirstSymbolPatterns();
        $this->setRestrictedLastSymbolPatterns();
        $this->setPossiblePatterns();
    }*/
    
    
    /*public function setTypeError(): void
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
        self::DBNAME=>array('([_\$]+[a-zA-Z\d]+)*',//if _ or $ is included to the string, the last symbol can be onlt althabetic or number
                            '([a-zA-z\d]*)'//the last symbols can be as word or digital as many as possible and also without these symbols
                            ),
        self::USERNAME=>array('@','[\w]')
      );
    }
    
    public function setRestrictedFirstSymbolPatterns():void
    {
      $this->restrictedFirstSymbol=array(
        self::DBNAME=>'^'
      );
    }
    
    public function setRestrictedLastSymbolPatterns():void
    {
      $this->restrictedLastSymbol=array(
         self::DBNAME=>'$'
      );
    }
    
    public function setPossiblePatterns():void
    {
      $this->possiblePatterns=array(
        self::DBNAME=>array('[a-zA-Z]+'=>'Alphabetic symbols')
      );
    }
    
    public function buildPattern(string $typePar):string
    {
      $patternString='';
      switch ($typePar)
      {
        case self::DBNAME:
          if(!empty($this->restrictedFirstSymbol[self::DBNAME]))
            $patternString .=$this->restrictedFirstSymbol[self::DBNAME];
          if(!empty($this->possiblePatterns[self::DBNAME]))
            foreach($this->possiblePatterns[self::DBNAME] as $patt=>$expl)
             $patternString .=$patt;
          if(isset($this->allowedSymbols[self::DBNAME]))
            if(is_array($this->allowedSymbols[self::DBNAME]))
               $patternString .='(';
              foreach($this->allowedSymbols[self::DBNAME] as $key=>$altSubPattern)
              {
                $patternString .='('.$altSubPattern.')';
                if($key!==count($this->allowedSymbols[self::DBNAME])-1)
                  $patternString .='|';
              }
              $patternString .=')';
          if(!empty($this->restrictedLastSymbol[self::DBNAME]))
            $patternString .=$this->restrictedLastSymbol[self::DBNAME];
        break;
        case self::USERNAME:
          break;
        default:
          return '';
      }
      
      return $patternString;
    }
    
  
}

?>