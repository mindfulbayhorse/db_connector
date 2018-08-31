<?php
class includingFiles extends Exception{
  
  function __construct($message, $code = 0, Exception $previous = null)
  {
    $this->message='File doesn\'t exist: '.$message;
    parent::__construct($message, $code, $previous);
    
  }
}


function checkFilesForClasses($file_name)
{
  if(!file_exists($file_name.".php"))
  {
    throw new includingFiles($file_name);
  }
    require_once($file_name.".php");
}


//spl_autoload_register('checkFilesForClasses');
spl_autoload_register('checkFilesForClasses');

try {
    $obj = new DBconnector();
    try {
      $obj->dbname='test_dbname';
      if($obj->dbname3===null)
        echo 'DBname: <br />';
      echo 'DBname: '.$obj->dbname.'<br />';
      echo $obj;
    }
    catch (Exception $e)
    {
      echo $e->getMessage(), "<br />";
    }
} catch (Exception $e) {
    echo $e->getMessage(), "<br />";
}

/**
 * @author Olga Zhilkova
 * @copyright 2018
 */
//try{
    
//} catch (Exception $e) {
//    echo $e->getMessage(), "\n";
//}

//define the type of the db
const TYPE_DB='mysql';
//create class with MYSQl name to ensure that another foundation calsses are not used and not modified
//$mysql_obj = new DBconnector;
$dns = 'mysql:host=localhost;dbname=testdb';
$dbname='';
$host='localhost';
$username = 'username';
$password = 'password';
//$mysql->checkParams($username,$password,$host,$dbname);
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
); 

try {
    $dbh = new PDO($dns, $username, $password);
    foreach($dbh->query('SELECT * from WBS') as $row) {
        print_r($row);
    }
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>