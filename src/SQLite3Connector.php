<?php
declare(strict_types=1);
namespace dbConnector;
/**
 * Class for implementing validation parameters for database connection
 * @author Olga Zhilkova
 * @copyright 2017
 */
class SQLite3Connector implement MakeDBConnected
{
    
    public $dbPath='';
    
    private $tableFields=[];
    
    private $_db;
    
    const SQL_TYPES_PARAMS=array(
        'int'=>SQLITE3_INTEGER,
        'string'=>SQLITE3_TEXT,
        );
        
    const SQL_FIELDS_TYPES=array(
        'int'=>'INTEGER',
        'string'=>'TEXT',
        );
        
    const PRIMARY_KEY='PRIMARY KEY';
    const AUTO_INCREMENT='AUTOINCREMENT';
    const REQUIRED='NOT NULL';
    const SEPARATOR_SPACE=' ';
    const COLON_SPACE=':';
    const COMMA_SPACE=',';
    
    public function __construct(string $dbPath):void
    {
        $this->setSQLTemplates();
        $this->$dbPath=rtrim($dbPath);
        if(!$this->validateParams())
            throw new InvalidArgumentException(
                sprintf('"%s" is not a valid IP address',
                $host
                )
            );
            
       if(!$this->dbConnect())
            throw new InvalidArgumentException(
                    sprintf('"%s" is not a valid IP address',
                    $host
                    )
                );
    }
    
    
    private function validateParams(): bool
    {
        if(empty($this->$dbPath))
            return false;
            
        if(!file_exists($this->dbPath))
            return false;
            
       return true;
    }
  
    
    public function dbConnect():bool
    {   
		try
		{
			$this->_db=new \SQLite3($this->dbPath);
            return true;
		}	
		catch(Exception $e)
		{
			$this->messages["ERROR"]["code"] = $e->getMessage()."<br />";
			$this->messages["ERROR"]["code"] .= $e->getFile()."<br />";
			$this->messages["ERROR"]["code"] .= $e->getLine()."<br />";
            return false;
		}
        
    }
    
    
    public function dbCreate(array $dbStructure):bool
    {

        $this->tableFields=$dbStructure;
        if($this->_db->exec($this->buildCreateSQL('feeds')))
            return true;
        else
            return false;        
    }
    
    
    public function setSQLTemplates()
    {
      $this->sqlTempls=array(
                        'create_table'=>'CREATE TABLE IF NOT EXISTS %s (%s);',
                        'delete_from_table'=>'DELETE FROM %s WHERE id=%s',
                        'insert_into_table'=>'INSERT INTO %s (%s) VALUES (%s);',
                        'select_from_table'=>'SELECT %s FROM %s %s %s',
                        );
    }
    
    
    public function buildSQLFieldList(string $table, array $sqlUniques=array()): array
    {
        foreach($this->structure[$table]['fields'] as $fieldName=>$fieldsTable)
        {
             if(!isset($sqlUniques[$fieldName]))
             {
                $sqlUniques[$fieldName]=$table.'.'.$fieldName;
             }
             else
             {
                $i=1;
                while(isset($sqlUniques[$fieldName.'_'.$i]))
                {
                    $i++;   
                }
                $sqlUniques[$fieldName.'_'.$i]=$table.'.'.$fieldName;
             }
        }
        return $sqlUniques;
    }
    
    
    public function buildSelectSQL(string $tableName,string $relationName=''): string
	{  
       $sqlFrom =$tableName;
       $sqlFields='';
       $fields=$this->buildSQLFieldList($sqlFrom);
       $i=1;
       foreach($fields as $aliasField=>$tableField)
       {
            $sqlFields .=$tableField.' as '.$aliasField;
            if($i<count($fields))
                $sqlFields .=','; 
            $i++;
       }

       $sqlSelect=sprintf($this->sqlTempls['select_from_table'], $sqlFields, $sqlFrom, $sqlJoin, $sqlWhereCondition);

       return $sqlSelect;
	}
    
    
    public function listFieldsTypes(array $fieldsSet): array
	{  
       $sqlFields=[];
       foreach($fieldsSet as $aliasField=>$typeField)
       {
            $field=array();
            $field[]=$aliasField;
            if(isset(self::SQL_FIELDS_TYPES[$typeField['type']]))
                $field[]=self::SQL_FIELDS_TYPES[$typeField['type']];
            
            if(isset($typeField['required']) &&
                 $typeField['required']===true)
                $field[]=self::REQUIRED;
            
            if(isset($typeField['key']) &&
                 $typeField['key']===true)
                $field[]=self::PRIMARY_KEY;   
                
            if(isset($typeField['auto']) &&
                 $typeField['auto']===true)
                $field[]=self::AUTO_INCREMENT;  
            
            $sqlFields[]=implode($field,self::SEPARATOR_SPACE);
        }

       return $sqlFields;
	}
    

    
    
    public function buildCreateSQL(string $tableName): string
	{  
       $fieldsSql=implode($this->listFieldsTypes($this->tableFields[$tableName]['fields']),', ');
       $sqlCreate=sprintf($this->sqlTempls['create_table'], $tableName, $fieldsSql); 
       
       return $sqlCreate;
    }
    
    
    public function buildInsertSQL(string $tableName, array $fields): string
	{  
	   $fields=array_keys($fields);
       $params=[];
       foreach($fields as $val) {
            $params[]=self::COLON_SPACE.$val;
        }
       $sqlInsert=sprintf($this->sqlTempls['insert_into_table'], $tableName, 
            implode($fields,self::COMMA_SPACE.self::SEPARATOR_SPACE),
            implode($params,self::COMMA_SPACE.self::SEPARATOR_SPACE)); 
       
       return $sqlInsert;
    }
    
    
    public function insertEntry(string $tableName, array $fields):bool
    {
        $stmt = $this->_db->prepare($this->buildInsertSQL($tableName, $fields));
        foreach($fields as $key=>$val)
        {          
            if(isset($this->tableFields[$tableName]['fields'][$key]['type']) && 
                isset(self::SQL_TYPES_PARAMS[$this->tableFields[$tableName]['fields'][$key]['type']]) &&
                !empty(self::SQL_TYPES_PARAMS[$this->tableFields[$tableName]['fields'][$key]['type']]))
                 if(!$stmt->bindParam($key,$fields[$key],self::SQL_TYPES_PARAMS[$this->tableFields[$tableName]['fields'][$key]['type']]))
                   return false;
                 else
                    if(!$stmt->bindParam($key,$fields[$key]))
                   return false;
        }
            	
        
        $resNewMsgs=$stmt->execute();
       	if($resNewMsgs!==false)
        {
            $resNewMsgs->finalize();
            $stmt->close();
        }
        else
         return false;
         
    	if($this->_db->lastErrorCode()>0)
    	{
    		echo $this->_db->lastErrorMsg().'<br />';
            return false;
    	}
        else
            return true;
     }
    

    public function __destruct()
	{
		if ($this->_db instanceOf \SQLite3) {
				$this->_db->close();
		}
	}
    
    
}




?>