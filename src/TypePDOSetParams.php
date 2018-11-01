<?php
declare(strict_types=1);
/**
 * @author Olga Zhilkova
 * @copyright 2018
 */
namespace dbConnctor;

class TypePDOSetParams implements SetParamsReady
{
    const MYSQL_TYPE='mysql';
    const SQLIGHT_TYPE='sqlite';
    const POSTGRESQL_TYPE='postgresql';
    const SQLITE3='sqlite3';
    
    private $classDB;

    public function __construct(string $typePDO, string $dns):void
    {
        switch ($typePDO)
        {
          //create separate class according to type of PDO
          case self::SQLITE3:
            try{
                $this->classDB = new SQLite3Connector($dns);
            }
            catch(Exception $e)
    		{
    			$this->messages["ERROR"]["code"] = $e->getMessage()."<br />";
    			$this->messages["ERROR"]["code"] .= $e->getFile()."<br />";
    			$this->messages["ERROR"]["code"] .= $e->getLine()."<br />";
    		}
          default:
            //show exeption message
            break;
        }
    }
    
    public function buildDBStructure(array $fields):bool
    {
        if($this->classDB->dbConnect($dns))
            return $this->classDB->dbCreate($fields);
        else
            return false;
    }
}

?>